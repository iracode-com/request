<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Kavenegar\Laravel\Message\KavenegarMessage;
use Kavenegar\Laravel\Notification\KavenegarBaseNotification;

class SendSMSNotification extends KavenegarBaseNotification
{
    use Queueable;

    public function __construct(
        private readonly string $pattern,
        private readonly array $tokens,
    ) {
        //
    }

    public function via($notifiable): array
    {
        $channels[] = 'kavenegar';

        return $channels;
    }

    public function toKavenegar($notifiable): KavenegarMessage
    {
        return (new KavenegarMessage())
            ->verifyLookup($this->pattern, $this->tokens)
            ->to($notifiable->mobile);
    }
}
