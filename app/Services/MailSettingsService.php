<?php

namespace App\Services;

class MailSettingsService
{
    public function __construct(private readonly SettingService $settingService) { }

    public function loadToConfig($data = null): array
    {
        if (is_null($data)) {
            $settings = $this->settingService->get();

            $data = [
                'default_email_provider' => $settings?->email_settings['default_email_provider'],
                'smtp_host'              => $settings?->email_settings['smtp_host'],
                'smtp_port'              => $settings?->email_settings['smtp_port'],
                'smtp_encryption'        => $settings?->email_settings['smtp_encryption'],
                'smtp_username'          => $settings?->email_settings['smtp_username'],
                'smtp_password'          => $settings?->email_settings['smtp_password'],
                'email_from_address'     => $settings?->email_from_address,
                'email_from_name'        => $settings?->email_from_name,
            ];
        }

        config([
            'mail.mailers.smtp.host'       => $data['smtp_host'] ?? null,
            'mail.mailers.smtp.port'       => $data['smtp_port'] ?? null,
            'mail.mailers.smtp.encryption' => $data['smtp_encryption'] ?? null,
            'mail.mailers.smtp.username'   => $data['smtp_username'] ?? null,
            'mail.mailers.smtp.password'   => $data['smtp_password'] ?? null,
            'mail.from.address'            => $data['email_from_address'] ?? null,
            'mail.from.name'               => $data['email_from_name'] ?? null,
        ]);

        return $data;
    }
}