<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum CustomerStatus: int implements HasLabel, HasColor
{
    case DISQUALIFIED                   = 0;
    case SUCCESSFUL                     = 1;
    case UNSUCCESSFUL                   = 2;
    case WAITING_FOR_FIRST_LEVEL_AUDIT  = 3;
    case WAITING_FOR_SECOND_LEVEL_AUDIT = 4;
    case WAITING_FOR_FIRST_LEVEL_CARE   = 5;
    case WAITING_FOR_SECOND_LEVEL_CARE  = 6;

    public function getLabel(): ?string
    {
        return match ($this) {
            self::DISQUALIFIED                   => 'خارج از دامنه صلاحیت',
            self::SUCCESSFUL                     => 'موفق',
            self::UNSUCCESSFUL                   => 'ناموفق',
            self::WAITING_FOR_FIRST_LEVEL_AUDIT  => 'در انتظار ممیزي اول',
            self::WAITING_FOR_SECOND_LEVEL_AUDIT => 'در انتظار ممیزي دوم',
            self::WAITING_FOR_FIRST_LEVEL_CARE   => 'در انتظار مراقبتی اول',
            self::WAITING_FOR_SECOND_LEVEL_CARE  => 'در انتظار مراقبتی دوم',
        };
    }


    public function getColor(): string|array|null
    {
        return match ($this) {
            self::DISQUALIFIED                   => 'danger',
            self::SUCCESSFUL                     => 'success',
            self::UNSUCCESSFUL                   => 'danger',
            self::WAITING_FOR_FIRST_LEVEL_AUDIT  => 'fuchsia',
            self::WAITING_FOR_SECOND_LEVEL_AUDIT => 'purple',
            self::WAITING_FOR_FIRST_LEVEL_CARE   => 'warning',
            self::WAITING_FOR_SECOND_LEVEL_CARE  => 'yellow',
        };
    }
}