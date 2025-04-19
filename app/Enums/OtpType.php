<?php

namespace App\Enums;

enum OtpType: string
{
    case MOBILE = 'mobile';
    case EMAIL  = 'email';
}
