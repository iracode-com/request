<?php

namespace App\Models;

use App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    protected $table = 'profiles';
    protected $fillable = [
        'user_id',
        'fullname',
        'mobile',
        'national_code',
        'birthdate',
        'fathername',
        'tel',
        'internal_tel',
        'personnel_code',
        'address',
        'receive_email',
        'receive_sms',
        'receive_messenger'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
