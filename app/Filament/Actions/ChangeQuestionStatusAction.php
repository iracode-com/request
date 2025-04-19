<?php

namespace App\Filament\Actions;

use App\Enums\CustomerStatus;
use App\Enums\QuestionAction;
use App\Enums\QuestionStatus;
use App\Enums\RoleEnum;
use Arr;
use Closure;
use CodeWithDennis\SimpleAlert\Components\Forms\SimpleAlert;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Support\Enums\MaxWidth;
use Filament\Support\Exceptions\Halt;
use Filament\Support\Facades\FilamentIcon;
use Filament\Tables\Actions\Action;
use function App\Support\formComponentsConfiguration;
use function App\Support\saved;

class ChangeQuestionStatusAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'changeQuestionStatusAction';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->icon('heroicon-o-arrow-path-rounded-square')
            ->label('تعیین وضعیت')
            ->slideOver()
            ->modalWidth(MaxWidth::ThreeExtraLarge)
            ->color('warning')
            ->button()
            ->form($this->actionForm())
            ->fillForm(fn($record) => Arr::except($record->toArray(), 'status'))
            ->action($this->save());
    }

    private function actionForm(): array
    {
        formComponentsConfiguration();

        return [
            SimpleAlert::make('danger')
                ->columnSpanFull()
                ->hidden(
                    fn($record) => $record->action
                        ? $record->action->performed($record)
                        : true
                )
                ->warning()
                ->color('danger')
                ->title(__('هشدار!'))
                ->description('شما عملیات موردنیاز در این مرحله را تکمیل نکرده اید.')
                ->actions([
                    Forms\Components\Actions\Action::make('action')
                        ->label('انجام عملیات')
                        ->url(fn($record) => $record->action
                            ? $record->action->getActionUrl($record)
                            : '#'
                        )
                        ->openUrlInNewTab()
                        ->link()
                        ->icon('heroicon-m-arrow-long-left')
                        ->iconPosition('after')
                        ->color('info'),
                ]),

            SimpleAlert::make('success')
                ->columnSpanFull()
                ->visible(
                    fn($record) => $record->action
                        ? $record->action->performed($record)
                        : false
                )
                ->success()
                ->title(__('تکمیل شده!'))
                ->description('عملیات این مرحله با موفقیت تکمیل شده است.'),

            Forms\Components\Fieldset::make(__('قدم کنونی'))->schema([
                Forms\Components\Select::make('status')
                    ->options(fn($record) => $record->status->getNextEnabledOptions($record->type, true))
                    ->afterStateUpdated(function (Forms\Set $set, Forms\Get $get, $record) {
                        $status = QuestionStatus::getBy($get('status'));
                        $set('referred_to', $status?->getReferrer());
                        $set('pending', $status?->getPending($record->type));
                        $set('referrer', $status?->getPending($record->type)?->getReferrer());
                        $set('action', $status?->getAction());
                    })
                    ->disableOptionWhen(fn(int $value, $record) => $value == $record->status->value)
                    ->required()
                    ->searchable()
                    ->preload()
                    ->live(),

                Forms\Components\Select::make('referred_to')
                    ->options(RoleEnum::class)
                    ->hidden(auth()->user()->isCustomer())
                    ->dehydratedWhenHidden()
                    ->searchable()
                    ->preload()
                    ->live(),
            ])->columns(1),

            Forms\Components\Fieldset::make(__('قدم بعدی'))->schema([
                Forms\Components\Select::make('pending')
                    ->options(QuestionStatus::class)
                    ->searchable()
                    ->preload()
                    ->live(),

                Forms\Components\Select::make('referrer')
                    ->options(RoleEnum::class)
                    ->searchable()
                    ->preload()
                    ->live(),
            ])
                ->hidden(auth()->user()->isCustomer())
                ->dehydratedWhenHidden()
                ->columns(1),

            Forms\Components\Select::make('action')
                ->options(QuestionAction::class)
                ->searchable()
                ->hidden(auth()->user()->isCustomer())
                ->dehydratedWhenHidden()
                ->preload()
                ->disabled(fn($record) => $record->status->finished($record->type))
                ->live(),

            Forms\Components\Checkbox::make('needs_correction')
                ->nullable()
                ->label('نیاز به اصلاح دارد؟')
                ->hidden(auth()->user()->isCustomer())
                ->disabled(fn($record) => $record->status->finished($record->type))
                ->live(),

            Forms\Components\Textarea::make('comment')
                ->label(__('Description'))
                ->disabled(fn($record) => $record->status->finished($record->type))
                ->dehydratedWhenHidden()
                ->visible(fn(Forms\Get $get) => $get('needsCorrection') || QuestionStatus::hasToComment($get('status')))
        ];
    }

    public function save(): Closure
    {
        return function ($record, $data) {
            if ($record->action && ! $record->action->performed($record)) {
                $this->actionNotPerformed($record);
                return new Halt();
            }

            $this->createCustomer($record, $data['status']);

            $record->update([
                'status'      => $data['status'],
                'referred_to' => $data['referred_to'],
                'pending'     => $data['pending'],
                'referrer'    => $data['referrer'],
                'action'      => $data['action'],
                'comment'     => $data['comment'],
            ]);

            saved();
        };
    }

    public function actionNotPerformed($record): void
    {
        Notification::make()
            ->danger()
            ->title($record->action->getLabel())
            ->icon(FilamentIcon::resolve('actions::modal.confirmation'))
            ->body(__('شما عملیات موردنظر را تکمیل نکرده اید. آیا میخواهید ادامه دهید؟'))
            ->duration(5000)
            ->actions([
                \Filament\Notifications\Actions\Action::make(__('Yes'))
                    ->button()
                    ->color('primary')
                    ->url($record->action->getActionUrl($record), shouldOpenInNewTab: true),

                \Filament\Notifications\Actions\Action::make(__('No'))
                    ->button()
                    ->color('gray')
                    ->close(),
            ])
            ->send();
    }

    public function createCustomer($record, $status): void
    {
        $customerStatus = match (QuestionStatus::getBy($status)) {
            QuestionStatus::REJECTED_BY_TECHNICAL_MANAGER                               => CustomerStatus::DISQUALIFIED,
            QuestionStatus::REJECTED_AUDIT_FORM_BY_CUSTOMER                             => CustomerStatus::UNSUCCESSFUL,
            QuestionStatus::REGISTERED_IN_SUCCESSFUL_CUSTOMERS_LIST                     => CustomerStatus::SUCCESSFUL,
            QuestionStatus::REGISTERED_IN_WAITING_FOR_FIRST_LEVEL_AUDIT_CUSTOMERS_LIST  => CustomerStatus::WAITING_FOR_FIRST_LEVEL_AUDIT,
            QuestionStatus::REGISTERED_IN_WAITING_FOR_SECOND_LEVEL_AUDIT_CUSTOMERS_LIST => CustomerStatus::WAITING_FOR_SECOND_LEVEL_AUDIT,
            QuestionStatus::REGISTER_CUSTOMER_IN_WAITING_LIST_FOR_FIRST_CARE_AUDIT      => CustomerStatus::WAITING_FOR_FIRST_LEVEL_CARE,
            default                                                                     => null,
        };

        if ($customerStatus) {
            $record->user->customer()->updateOrCreate(
                ['user_id' => $record->user_id],
                ['status' => $customerStatus->value]
            );
        }
    }
}
