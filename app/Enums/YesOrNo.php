<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum YesOrNo: int implements HasLabel, HasColor, HasIcon
{
    case NO  = 0;
    case YES = 1;

    public function getLabel(): ?string
    {
        return match ($this) {
            self::NO  => __('No'),
            self::YES => __('Yes'),
            default   => '-'
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::NO  => 'danger',
            self::YES => 'success',
            default   => 'gray'
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::NO  => 'heroicon-o-x-circle',
            self::YES => 'heroicon-o-check-circle',
            default   => null
        };
    }
}