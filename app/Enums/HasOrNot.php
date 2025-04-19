<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum HasOrNot: int implements HasLabel, HasColor, HasIcon
{
    case DOES_NOT_HAVE = 0;
    case HAS           = 1;

    public function getLabel(): ?string
    {
        return match ($this) {
            self::DOES_NOT_HAVE => __('Does not have'),
            self::HAS           => __('Has'),
             default            => '-'
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::DOES_NOT_HAVE => 'danger',
            self::HAS           => 'success',
             default            => 'gray'
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::DOES_NOT_HAVE => 'heroicon-o-x-circle',
            self::HAS           => 'heroicon-o-check-circle',
        };
    }
}