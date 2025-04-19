<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum OtpAuthType: string implements HasLabel, HasColor
{
    case REGISTER = 'register';
    case LOGIN    = 'login';
    case RECOVERY = 'recovery';


    public function getColor(): string|array|null
    {
        return match ($this) {
            self::REGISTER => 'info',
            self::LOGIN    => 'success',
            self::RECOVERY => 'warning',
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::REGISTER => __('Register'),
            self::LOGIN    => __('Login'),
            self::RECOVERY => __('Recovery Code'),
        };
    }
}
