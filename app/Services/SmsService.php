<?php

namespace App\Services;

use App\Enums\SmsEnum;
use App\Jobs\SendSMSJob;
use App\Models\User;
use App\Notifications\SendSMSNotification;
use Exception;
use Illuminate\Support\Facades\Log;

class SmsService
{
    public User|string $receptor;
    public string      $pattern;
    public array       $tokens;

    public function send() // : PendingDispatch
    {
        // return SendSMSJob::dispatch($this->receptor, $this->pattern, $this->tokens);

        try {
            $this->receptor->notify(
                new SendSMSNotification($this->pattern, $this->tokens)
            );

            // Log::channel('user')->info(
            //     sprintf('Send  %s to: %s', $this->pattern, $this->receptor->mobile)
            // );

        } catch (Exception $e) {
            $message = sprintf(
                'Error on send sms pattern %s to: %s because: %s',
                $this->pattern,
                $this->receptor->mobile,
                $e->getMessage()
            );

            Log::channel('user')->emergency($message);

            throw new Exception($e->getMessage());
        }
    }

    public function sendSms(string $pattern, array $data = []): void
    {
        $this->receptor ??= User::query()->find($data['user_id']);

        $this->receptor($this->receptor)
            ->pattern($pattern)
            ->tokens($this->getTokens($pattern, $data))
            ->send();
    }

    public function getTokens(string $pattern, array $data): array
    {
        if ($pattern == SmsEnum::OTP->value) {
            return $data;
        }

        return [];
    }

    public function receptor(User $receptor): SmsService
    {
        $this->receptor = $receptor;

        return $this;
    }

    public function pattern(string $pattern): SmsService
    {
        $this->pattern = $pattern;

        return $this;
    }

    public function tokens(array $tokens): SmsService
    {
        $this->tokens = $tokens;

        return $this;
    }
}
