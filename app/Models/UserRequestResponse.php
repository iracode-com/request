<?php

namespace App\Models;

use App\Traits\HandleSendNotificationTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRequestResponse extends Model
{
    use SoftDeletes, HandleSendNotificationTrait;

    public function userRequest(){
        return $this->belongsTo(UserRequest::class);
    }
}
