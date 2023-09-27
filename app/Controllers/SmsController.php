<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Twilio\Rest\Client;
use Config\Twilio;
class SmsController extends BaseController
{
    public function send()
    {
        $phoneNumberTo ='+923227063038';
        try {
            // Initialize the Twilio client
           
            $config = new Twilio();
            $twilio = new Client($config->accountSid, $config->authToken);

            // Use Twilio's Lookup API to validate the phone number
            $options = [
                'countryCode' => '+92', // Replace 'US' with the desired country code
                'type' => 'carrier',   // Replace 'carrier' with the desired type ('carrier' or 'national')
            ];
            $lookup = $twilio->lookups->v1->phoneNumbers($phoneNumberTo)->fetch($options);

            // Check if the phone number is valid
            //log_message('debug', print_r($lookup, true));
            if ($lookup->carrier && $lookup->phoneNumber) {
                $twilio->messages->create(
                $phoneNumberTo,
                [
                    'from' => $config->phoneNumber,
                    'body' => 'Hello, this is a test SMS from CodeIgniter 4.'
                ]
            );
            echo 'SMS sent successfully.';
            } else {
                echo 'false ', exit;
            }
          
            // // if ($lookup->valid) {
          
            // // Send an SMS
            
            // $twilio->messages->create(
            //     $phoneNumberTo,
            //     [
            //         'from' => $config->phoneNumber,
            //         'body' => 'Hello, this is a test SMS from CodeIgniter 4.'
            //     ]
            // );

            // return 'SMS sent successfully.';
            // } else {
            //    return false;
            // }
 

        } catch (\Exception $e) {
        
            return 'Error this: ' . $e->getMessage();
        }
    }
    // public function send() 
    // {
    //     $twilioConfig = new Twilio();
    //     $twilio = new Client($twilioConfig->accountSid, $twilioConfig->authToken);

    //     // Replace 'to_phone_number' with the recipient's phone number
    //     $message = $twilio->messages->create(
    //         '+923227063038',
    //         [
    //             'from' => $twilioConfig->phoneNumber,
    //             'body' => 'Hello,MR.Hassan welcome to the twilio:) if you want to check your email so please click here https://mail.google.com/mail/u/0/#inbox',
    //         ]
    //     );

    //     echo 'Message sent with SID: ' . $message->sid;
        
    // }
}
