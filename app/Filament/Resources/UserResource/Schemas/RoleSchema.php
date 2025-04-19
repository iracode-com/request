<?php

namespace App\Filament\Resources\UserResource\Schemas;

use Filament\Forms;
use Illuminate\Database\Eloquent\Model;
use Novadaemon\FilamentCombobox\Combobox;
use function App\Support\translate;

class RoleSchema
{
    public static function schema(): array
    {
        return [
            Forms\Components\Section::make(__('Roles'))->schema([
                Combobox::make('role_id')
                    ->label(__('Roles'))
                    ->relationship(name: 'roles', titleAttribute: 'name')
                    ->boxSearchs()
                    ->getOptionLabelFromRecordUsing(
                        fn(Model $record) => $record->nick_name ?? translate($record->name)
                    )

                // Forms\Components\Select::make('role_id')
                //     ->label(__('Roles'))
                //     ->relationship(name: 'roles', titleAttribute: 'name')
                //     ->getOptionLabelFromRecordUsing(
                //         fn(Model $record) => is_string($record->name) ?
                //             $record->name :
                //             $record->name->getLabel() ??
                //             $record->name->value
                //     )
                //     ->inlineLabel()
                //     ->multiple()
                //     ->searchable()
                //     ->preload()
                //     ->reactive()
                //     ->suffixAction(
                //         Forms\Components\Actions\Action::make('create')
                //             ->icon('heroicon-o-plus')
                //             ->color('gray')
                //             ->url(CreateRole::getUrl())
                //     )
                //     ->hintActions([
                //         Forms\Components\Actions\Action::make('select_all')
                //             ->hidden(fn(Forms\Components\Component $component) => count($component->getState()) == Role::count())
                //             ->action(fn(Forms\Components\Component $component) => $component->state(Role::pluck('id')->toArray())),
                //         Forms\Components\Actions\Action::make('delete_selected')
                //             ->hidden(fn(Forms\Components\Component $component) => empty($component->getState()))
                //             ->action(fn(Forms\Components\Component $component) => $component->state([]))
                //     ])
            ])
        ];
    }
}
