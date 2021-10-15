<?php

namespace App\Http\Controllers;

use App\Console\Commands\StudentReminder;
use App\Mail\ReminderMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;

class ReminderController extends Controller
{

    public function sendEmail()
    {

        $date_now = Carbon::now();
        foreach (User::all() as $user) {
            foreach ($user->practice_exam_dates as $practice_exam) {
                dd(Carbon::parse($practice_exam->date_time)->subHour(1)->format('Y-m-d h:i'), $date_now->format('Y-m-d h:i'));
                if ( Carbon::parse($practice_exam->date_time)->format('Y-m-d h:i') == $date_now->format('Y-m-d h:i') ) {
                }
            }
        }
        Mail::to('edin.vllaco@gmail.com')->send(new ReminderMail($details));
    }

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
