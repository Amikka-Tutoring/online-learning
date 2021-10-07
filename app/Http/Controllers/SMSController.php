<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class SMSController extends Controller
{
    public function sendSMS()
    {
        $client = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));
        $message = $client->messages->create(
            '+15614528513', // Text this number
            [
                'from' => '+17578445037', // From a valid Twilio number
                'body' => 'SMS from LARAVEL'
            ]
        );
        print $message->sid;
    }
}
