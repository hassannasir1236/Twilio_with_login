<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Twilio\Rest\Client;
use Config\Twilio;
class SmsController extends BaseController
{
    public function send()
    {
        $twilioConfig = new Twilio();
        $twilio = new Client($twilioConfig->accountSid, $twilioConfig->authToken);

        // Replace 'to_phone_number' with the recipient's phone number
        $message = $twilio->messages->create(
            '+923227063038',
            [
                'from' => $twilioConfig->phoneNumber,
                'body' => 'Hello,MR.Hassan welcome to the twilio:) if you want to check your email so please click here https://mail.google.com/mail/u/0/#inbox',
            ]
        );

        echo 'Message sent with SID: ' . $message->sid;
    }
}
