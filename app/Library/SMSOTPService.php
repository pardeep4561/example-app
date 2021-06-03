<?php

namespace App\Library;

use Twilio\Rest\Client;

class SMSOTPService
{
    public $otp;

    function client()
    {
        return new Client(config('services.twilio.sid'), config('services.twilio.token'));
    }

    function sendOTP($number)
    {
        $client = $this->client();
        $otp = rand(1000, 9999);
        $this->otp = $otp;
        $message = $client->messages->create(
            $number,
            [
                'from' => '+1 860 264 4033', // From a valid Twilio number
                'body' => "Your OTP is ".$this->otp
            ]
        );
        echo $message;
    }

    function varifyOTP($otp){
        echo $otp."<br>";
        echo gettype($this->otp);
        //return ($otp == $this->otp)? true: false;
    }
}
