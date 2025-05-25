<?php

namespace App\Interfaces;

interface ISmsHandler{
    public function sendSms(string $from=null,string $to, string $message);
    public function sendSmsByPattern(string $to, array $params, string $bodyId);
}