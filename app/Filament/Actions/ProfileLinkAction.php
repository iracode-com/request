<?php

namespace App\Filament\Actions;

use App\Models\User;
use Filament\Forms\Components\Actions\Action;
use Filament\Pages\Auth\EditProfile;

class ProfileLinkAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'profile-link';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->url(route('filament.admin.pages.my-profile'))
            ->link()
            ->label(__('Forgot your password?'))
            ->icon('heroicon-o-arrow-path')
            ->color('danger')
            ->button()
            ->outlined()
            ->visible(
                fn(string $operation, ?User $record) => (
                    $operation == 'edit'
                    && $record->is(auth()->user())
                )
            );
    }
}
