<?php

namespace App\Enums;

enum SmsEnum: string
{
    case     OTP = 'CbihaOTPCode';

    public function label(): string
    {
        return match ($this) {
            self::OTP => 'کد یکبار مصرف',
        };
    }
}
