<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RejectReason extends Model
{
    public const TYPES = [
        1 => 'درخواست ها'
    ];
}
