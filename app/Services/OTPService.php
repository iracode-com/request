<?php

namespace App\Services;

use App\Enums\OtpType;
use App\Enums\OtpAuthType;
use App\Enums\SmsEnum;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use App\Interfaces\ISmsHandler;

class OtpService
{
    public function allowRequestOtp(User $user, OtpAuthType $authType = OtpAuthType::LOGIN): bool
    {
        $lastOtp = $user->otps()->where('auth_type', $authType)->latest()->first();

        if (! $lastOtp) {
            return true;
        }

        return $lastOtp->created_at->addMinutes(2)->isPast();
    }

    public function create(User|null $user, ?array $info = null): HasMany|Otp
    {
        $code = rand(111111, 999999);

        $token = Str::random(60);

        $data = $info ?? [
            'login_id'  => $user->mobile,
            'type'      => OtpType::MOBILE,
            'auth_type' => $user->wasRecentlyCreated ? OtpAuthType::REGISTER : OtpAuthType::LOGIN,
            'ip'        => request()->ip(),
            'agent'     => request()->userAgent(),
        ];

        if($user){
            $otp = $user->otps()->create([
                'code'  => $code,
                'token' => $token,
                ...$data
            ]);
        }
        else{
            $otp = Otp::create([
                'code'  => $code,
                'token' => $token,
                ...$data
            ]);
        }

        return $otp;
    }

    public function isValid(User $user, string $code, bool $markAsUsed = true, OtpAuthType $authType = OtpAuthType::LOGIN): bool
    {
        $otp = $user->otps()
            ->where('auth_type', $authType)
            ->where('code', $code)
            ->first();

        if (! $otp) {
            return false;
        }

        if ($otp->used_at) {
            return false;
        }

        if ($otp->created_at->addMinutes(2)->isPast()) {
            return false;
        }

        if ($markAsUsed) {
            $this->markCodeAsUsed($otp);
        }

        return true;
    }

    public function sendOtp($code, string|array $to, string|int $pattern = null): void
    {
        $smsHandler = app(ISmsHandler::class);
        $smsHandler->sendSms(null, $to, "کد تایید شما {$code} میباشد");
        
        // app(SmsService::class)
        //     ->receptor(User::query()->where('mobile', $to)->firstOrFail())
        //     ->sendSms(
        //         pattern: $pattern ?? SmsEnum::OTP->value,
        //         data   : [$code]
        //     );
    }

    public function markCodeAsUsed(Otp $otp, User|null $user = null): bool
    {
        $otp->update([
            'expired' => true,
            'used_at' => now()
        ]);

        if($otp->user){
            $otp->user->update([
                'mobile_verified_at' => $otp->user->mobile_verified_at ?? now()
            ]);
        }
        else if($user){
            $user->mobile_verified_at = $otp->user->mobile_verified_at ?? now();
            $user->save();
        }

        return true;
    }
}
