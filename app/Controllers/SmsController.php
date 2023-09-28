<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Twilio\Rest\Client;
use Config\Twilio;
class SmsController extends BaseController
{
    public function send()
    {
        $phoneNumberTo ='+16106348883';
        // Initialize the Twilio client
        $config = new Twilio();
        $twilio = new Client($config->accountSid, $config->authToken);

        try {
            $options = [
                'countryCode' => '+1', // Replace 'US' with the desired country code
                'type' => 'carrier',   // Replace 'carrier' with the desired type ('carrier' or 'national')
            ];
            // Use Twilio's Lookup API to validate the phone number
            $lookup = $twilio->lookups->v1->phoneNumbers($phoneNumberTo)->fetch($options);

            // Check if the phone number is valid
            print_r($lookup->phoneNumber);
            if ($lookup->carrier && $lookup->phoneNumber) {
                // Phone number is valid, proceed to send notification
                try {
                    // Send an SMS notification
                    $twilio->messages->create(
                        $phoneNumberTo, // Recipient's phone number
                        [
                            'from' => $config->phoneNumber, // Your Twilio phone number
                            'body' => 'Hello i am hassan ', // Message content
                        ]
                    );
        
                    return 'Notification sent successfully.';
                } catch (\Exception $e) {
                    return 'Error: ' . $e->getMessage();
                }
            } 
            else {
                return 'Invalid phone number.';
            }
        } catch (\Exception $e) {
            return 'Error show: ' . $e->getMessage();
        }
    }

    // private function sendNotification($phoneNumberTo, $message)
    // {
    //     // Initialize the Twilio client (same as in validation method)
    //     $config = new Twilio();
    //     $twilio = new Client($config->accountSid, $config->authToken);
    //     try {
    //         // Send an SMS notification
    //         $twilio->messages->create(
    //             $phoneNumberTo, // Recipient's phone number
    //             [
    //                 'from' => $config->phoneNumber, // Your Twilio phone number
    //                 'body' => $message, // Message content
    //             ]
    //         );

    //         return 'Notification sent successfully.';
    //     } catch (\Exception $e) {
    //         return 'Error: ' . $e->getMessage();
    //     }
    // }
    // public function send()
    // {
    //     $phoneNumberTo ='+923227063038';
    //     try {
    //         // Initialize the Twilio client
           
    //         $config = new Twilio();
    //         $twilio = new Client($config->accountSid, $config->authToken);

    //         // Use Twilio's Lookup API to validate the phone number
            // $options = [
            //     'countryCode' => '+92', // Replace 'US' with the desired country code
            //     'type' => 'national',   // Replace 'carrier' with the desired type ('carrier' or 'national')
            // ];
    //         $lookup = $twilio->lookups->v1->phoneNumbers($phoneNumberTo)->fetch($options);

    //         // Check if the phone number is valid
    //         //log_message('debug', print_r($lookup, true));
           
    //         if ($lookup->carrier && $lookup->phoneNumberTo) {
    //             $twilio->messages->create(
    //             $phoneNumberTo,
    //             [
    //                 'from' => $config->phoneNumber,
    //                 'body' => 'Hello, this is a test SMS from CodeIgniter 4.'
    //             ]
    //         );
    //         echo 'sms send successfully';
    //         } else {
    //             print_r($lookup->carrier );
    //             echo 'false ', exit;
    //         }
          
    //         // // if ($lookup->valid) {
          
    //         // // Send an SMS
            
    //         // $twilio->messages->create(
    //         //     $phoneNumberTo,
    //         //     [
    //         //         'from' => $config->phoneNumber,
    //         //         'body' => 'Hello, this is a test SMS from CodeIgniter 4.'
    //         //     ]
    //         // );

    //         // return 'SMS sent successfully.';
    //         // } else {
    //         //    return false;
    //         // }
 

    //     } catch (\Exception $e) {
        
    //         return 'Error this: ' . $e->getMessage();
    //     }
    // }
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
