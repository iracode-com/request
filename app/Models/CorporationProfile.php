<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CorporationProfile extends Model
{
    protected $fillable = [
        "user_id",
        "company_code",
        "company_name",
        "company_owner_name",
        "company_owner_birthdate",
        "company_owner_mobile",
        "company_owner_national_code",
        "phone",
        "address",
        "receive_email",
        "receive_sms",
        "receive_messenger",
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
