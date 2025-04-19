<?php

namespace App\Livewire;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Joaopaulolndev\FilamentEditProfile\Concerns\HasSort;
use Filament\Notifications\Notification;
use Filament\Support\Exceptions\Halt;
use Joaopaulolndev\FilamentEditProfile\Concerns\HasUser;

class CustomEditProfileComponent extends Component implements HasForms
{
    use InteractsWithForms;
    use HasSort;
    use HasUser;

    public ?array $data = [];
    public $userClass;
    protected static int $sort = 0;

    public function mount(): void
    {
        $this->user = $this->getUser();

        $this->userClass = get_class($this->user);

        $fields = [
            'name',
            'family',
            'email',
        ];
        if (filament('filament-edit-profile')->getShouldShowAvatarForm()) {
            $fields[] = config('filament-edit-profile.avatar_column', 'avatar_url');
        }

        $this->form->fill($this->user->only($fields));
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('filament-edit-profile::default.profile_information'))
                    ->aside()
                    ->description(__('filament-edit-profile::default.profile_information_description'))
                    ->schema([
                        TextInput::make('name')
                            ->label(__('filament-edit-profile::default.name'))
                            ->required(),
                        TextInput::make('family')
                            ->label(__('Family'))
                            ->required(),
                        TextInput::make('email')
                            ->label(__('filament-edit-profile::default.email'))
                            ->email()
                            ->required()
                            ->unique($this->userClass, ignorable: $this->user),
                        FileUpload::make(config('filament-edit-profile.avatar_column', 'avatar_url'))
                            ->label(__('filament-edit-profile::default.avatar'))
                            ->avatar()
                            ->imageEditor()
                            ->hidden(!filament('filament-edit-profile')->getShouldShowAvatarForm())
                            ->disk(config('filament-edit-profile.disk', 'local'))
                            ->visibility(config('filament-edit-profile.visibility', 'public'))
                            // ->directory(filament('filament-edit-profile')->getAvatarDirectory())
                            ->rules(filament('filament-edit-profile')->getAvatarRules()),
                    ]),
            ])
            ->statePath('data');
    }

    public function updateProfile(): void
    {
        try {
            $data = $this->form->getState();

            $this->user->update($data);
        } catch (Halt $exception) {
            return;
        }

        Notification::make()
            ->success()
            ->title(__('filament-edit-profile::default.saved_successfully'))
            ->send();
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();

            $this->user->update($data);
        } catch (Halt $exception) {
            return;
        }

        Notification::make()
            ->success()
            ->title(__('filament-edit-profile::default.saved_successfully'))
            ->send();
    }

    public function render(): View
    {
        return view('livewire.custom-edit-profile-component');
    }
}
