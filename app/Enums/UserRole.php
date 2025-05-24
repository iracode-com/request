<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum UserRole: string implements HasLabel, HasColor, HasIcon, HasDescription
{
    case SUPERADMIN = 'superadmin';
    case ADMIN = 'admin';
    case USER  = 'user';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::SUPERADMIN => __('Superadmin'),
            self::ADMIN => __('Admin'),
            self::USER  => __('User'),
            default     => '-'
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::SUPERADMIN => 'info',
            self::ADMIN => 'info',
            self::USER  => 'gray',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::SUPERADMIN => 'heroicon-o-finger-print',
            self::ADMIN => 'heroicon-o-finger-print',
            self::USER  => 'heroicon-o-user',
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::SUPERADMIN => __('User can login as superadmin'),
            self::ADMIN => __('User can login as admin'),
            self::USER  => __('User does not have access to admin panel'),
        };
    }
}
