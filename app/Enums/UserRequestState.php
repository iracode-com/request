<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum UserRequestState: string implements HasLabel, HasColor, HasIcon
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
    case CLOSED = 'closed';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PENDING => __('pending'),
            self::APPROVED => __('approved'),
            self::REJECTED => __('rejected'),
            self::CLOSED => __('closed'),
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::REJECTED => 'danger',
            self::PENDING => 'warning',
            self::CLOSED => 'gray',
            self::APPROVED => 'success',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::REJECTED => 'heroicon-c-x-circle',
            self::PENDING => 'heroicon-s-exclamation-circle',
            self::CLOSED => 'heroicon-s-lock-closed',
            self::APPROVED => 'heroicon-c-check-circle',
        };
    }
}