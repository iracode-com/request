<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Driver
    |--------------------------------------------------------------------------
    |
    | This value determines which of the following gateway to use.
    | You can switch to a different driver at runtime.
    |
    */
    'default' => env('SMS_DRIVER', 'textlocal'),

    /*
    |--------------------------------------------------------------------------
    | List of Drivers
    |--------------------------------------------------------------------------
    |
    | These are the list of drivers to use for this package.
    | You can change the name. Then you'll have to change
    | it in the map array too.
    |
    */
    'drivers' => [
        // Install: composer require aws/aws-sdk-php
        'sns'                => [
            'key'    => 'Your AWS SNS Access Key',
            'secret' => 'Your AWS SNS Secret Key',
            'region' => 'Your AWS SNS Region',
            'from'   => 'Your AWS SNS Sender ID', // sender
            'type'   => 'Transactional',          // Or: 'Promotional'
        ],
        'textlocal'          => [
            'url'      => 'http://api.textlocal.in/send/', // Country Wise this may change.
            'username' => 'Your Username',
            'hash'     => 'Your Hash',
            'from'     => 'Sender Name', // sender
        ],
        // Install: composer require twilio/sdk
        'twilio'             => [
            'sid'   => 'Your SID',
            'token' => 'Your Token',
            'from'  => 'Your Default From Number',
        ],
        // Install: composer require mediaburst/clockworksms
        'clockwork'          => [
            'key' => 'Your clockwork API Key',
        ],
        'linkmobility'       => [
            'url'      => 'http://simple.pswin.com', // Country Wise this may change.
            'username' => 'Your Username',
            'password' => 'Your Password',
            'from'     => 'Sender name', // sender
        ],
        // Install: composer require melipayamak/php
        'melipayamak'        => [
            'username' => env('MELI_PAYAMAK_USERNAME'),
            'password' => env('MELI_PAYAMAK_PASSWORD'),
            'from'     => env('MELI_PAYAMAK_NUMBER'),
            'serviceUrlForPatternMode' => 'http://api.payamak-panel.com/post/Send.asmx?wsdl',
            'patternIds' => [
                // 'forgotPassword' => '324831',
                'forgotPassword' => '332811',
                'requestApproved' => '324511',
                'verifyCode' => '324509',
                'requestInserted' => '324512',
                'requestRejected' => '324513',
                'requestClosed' => '324515',
                'newResponseForRequest' => '324832',
            ],
            'flash'    => false,
        ],
        'melipayamakpattern' => [
            'username' => 'Your Username',
            'password' => 'Your Password',
        ],
        // Install: composer require kavenegar/php
        'kavenegar'          => [
            'apiKey' => 'Your Api Key',
            'from'   => 'Your Default From Number',
        ],
        'smsir'              => [
            'url'        => 'https://ws.sms.ir/',
            'apiKey'     => env('SMS_IR_APIKEY'),
            'secretKey'  => env('SMS_IR_SECRET_KEY'),
            'from'       => env('SMS_IR_FROM'),
            'otpPattern' => env('SMS_IR_OTP_PATTERN'),
        ],
        'tsms'               => [
            'url'      => 'http://www.tsms.ir/soapWSDL/?wsdl',
            'username' => 'Your Username',
            'password' => 'Your Password',
            'from'     => 'Your Default From Number',
        ],
        'farazsms'           => [
            'url'      => '188.0.240.110/services.jspd',
            'username' => 'Your Username',
            'password' => 'Your Password',
            'from'     => 'Your Default From Number',
        ],
        'farazsmspattern'    => [
            'url'      => 'http://ippanel.com/patterns/pattern',
            'username' => 'Your Username',
            'password' => 'Your Password',
            'from'     => 'Your Default From Number',
        ],
        'smsgatewayme'       => [
            'apiToken' => 'Your Api Token',
            'from'     => 'Your Default Device ID',
        ],
        'smsgateway24'       => [
            'url'      => 'https://smsgateway24.com/getdata/addsms',
            'token'    => 'Your Api Token',
            'deviceid' => 'Your Default Device ID',
            'from'     => 'Device SIM Slot.  0 or 1', // sim
        ],
        'ghasedak'           => [
            'url'    => 'http://api.iransmsservice.com',
            'apiKey' => 'Your api key',
            'from'   => 'Your Default From Number',
        ],
        // Install: composer require sms77/api
        'sms77'              => [
            'apiKey' => 'Your API Key',
            'flash'  => false,
            'from'   => 'Sender name',
        ],
        'sabapayamak'        => [
            'url'             => 'https://api.SabaPayamak.com',
            'username'        => 'Your Sabapayamak Username',
            'password'        => 'Your Sabapayamak Password',
            'from'            => 'Your Default From Number',
            'token_valid_day' => 30,
        ],
        'lsim'               => [
            'username' => 'Your LSIM login',
            'password' => 'Your LSIM password',
            'from'     => 'Your LSIM Sender ID', // sender
        ],
        'rahyabcp'           => [
            'url'      => 'https://p.1000sms.ir/Post/Send.asmx?wsdl',
            'username' => 'Your Rahyabcp login',
            'password' => 'Your Rahyabcp password',
            'from'     => 'Your Default From Number',
            'flash'    => false,
        ],
        'rahyabir'           => [
            'url'             => 'https://api.rahyab.ir',
            'username'        => 'Your Rahyabir Username',
            'password'        => 'Your Rahyabir Password',
            'company'         => 'Your Rahyabir Company',
            'from'            => 'Your Default From Number',
            'token_valid_day' => 1,
        ],
        'd7networks'         => [
            'url'             => 'https://api.d7networks.com',
            'username'        => 'Your D7networks ClientId',
            'password'        => 'Your D7networks clientSecret',
            'originator'      => 'SignOTP',
            'report_url'      => '',
            'token_valid_day' => 1,
        ],
        'hamyarsms'          => [
            'url'      => 'http://payamakapi.ir/SendService.svc?singleWsdl',
            'username' => 'Your Hamyarsms Username',
            'password' => 'Your Hamyarsms Password',
            'from'     => 'Your Default From Number',
            'flash'    => false,
        ],
        'smsapi'             => [
            'url'      => 'http://www.smsapi.si/poslji-sms',
            'username' => 'Your SMSApi Username',
            'password' => 'Your SMSApi Password',
            'from'     => 'Your Default From Number',
            'cc'       => 'Your Default Country Code',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Class Maps
    |--------------------------------------------------------------------------
    |
    | This is the array of Classes that maps to Drivers above.
    | You can create your own driver if you like and add the
    | config in the drivers array and the class to use for
    | here with the same name. You will have to extend
    | Tzsk\Sms\Abstracts\Driver in your driver.
    |
    */
    'map'     => [
        'sns'                => \Tzsk\Sms\Drivers\Sns::class,
        'textlocal'          => \Tzsk\Sms\Drivers\Textlocal::class,
        'twilio'             => \Tzsk\Sms\Drivers\Twilio::class,
        'smsgateway24'       => \Tzsk\Sms\Drivers\SmsGateway24::class,
        'clockwork'          => \Tzsk\Sms\Drivers\Clockwork::class,
        'linkmobility'       => \Tzsk\Sms\Drivers\Linkmobility::class,
        'melipayamak'        => \Tzsk\Sms\Drivers\Melipayamak::class,
        'melipayamakpattern' => \Tzsk\Sms\Drivers\Melipayamakpattern::class,
        'kavenegar'          => \Tzsk\Sms\Drivers\Kavenegar::class,
        'smsir'              => \Tzsk\Sms\Drivers\Smsir::class,
        'tsms'               => \Tzsk\Sms\Drivers\Tsms::class,
        'farazsms'           => \Tzsk\Sms\Drivers\Farazsms::class,
        'farazsmspattern'    => \Tzsk\Sms\Drivers\Farazsmspattern::class,
        'ghasedak'           => \Tzsk\Sms\Drivers\Ghasedak::class,
        'sms77'              => \Tzsk\Sms\Drivers\Sms77::class,
        'sabapayamak'        => \Tzsk\Sms\Drivers\SabaPayamak::class,
        'lsim'               => \Tzsk\Sms\Drivers\LSim::class,
        'rahyabcp'           => \Tzsk\Sms\Drivers\Rahyabcp::class,
        'rahyabir'           => \Tzsk\Sms\Drivers\Rahyabir::class,
        'd7networks'         => \Tzsk\Sms\Drivers\D7networks::class,
        'hamyarsms'          => \Tzsk\Sms\Drivers\Hamyarsms::class,
        'smsapi'             => \Tzsk\Sms\Drivers\SmsApi::class,
    ],
];
