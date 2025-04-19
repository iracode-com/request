<?php

namespace App\Services;

use App\Interfaces\ISmsHandler;
use Melipayamak\MelipayamakApi;

class MeliPayamakSmsHandlerService implements ISmsHandler
{
    public function sendSms(string $from = null, string $to, string $message)
    {
        info("otp sent to {$to} from {$from}", ['message'=>$message]);
        try {
            $username = config('sms.drivers.melipayamak.username');
            $password = config('sms.drivers.melipayamak.password');
            $api = new MelipayamakApi($username, $password);
            $sms = $api->sms();
            $from = $from ?? config('sms.drivers.melipayamak.from');
            $response = $sms->send($to, $from, $message);
            $json = json_decode($response);
        } catch (\Exception $e) {
            info(__CLASS__, [$e->getMessage()]);
        }
    }
}