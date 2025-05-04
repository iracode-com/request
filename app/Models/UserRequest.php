<?php

namespace App\Models;

use App\Enums\UserRequestState;
use App\Traits\HandleSendNotificationTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRequest extends Model
{
    use SoftDeletes, HandleSendNotificationTrait;
    protected function casts(): array
    {
        return [
            'status' => UserRequestState::class,
        ];
    }
    function user()
    {
        return $this->belongsTo(User::class);
    }
    function admin_user()
    {
        return $this->belongsTo(User::class);
    }
    function reject_reason()
    {
        return $this->belongsTo(RejectReason::class);
    }
    function responses()
    {
        return $this->hasMany(UserRequestResponse::class);
    }
}
