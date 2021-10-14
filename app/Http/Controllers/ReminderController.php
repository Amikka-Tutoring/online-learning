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
//        $next_practice_exam = $user->practice_exam_dates->where('date_time', '>', $date_now)->first()->date_time ?? null;
//        dd(Carbon::parse($user->lesson_dates->last()->time)->subHour(1)->format('h:i') == Carbon::now()->format('h:i'));
        foreach (User::all() as $user) {
            foreach ($user->lesson_dates as $lesson_date) {
                if ($lesson_date->day == $date_now->isoFormat('dddd') && Carbon::parse($lesson_date->time)->subHour(1)->format('h:i') == $date_now->format('h:i')) {
                    $details = [
                        'name' => $user->name,
                    ];
                    Mail::to('edin.vllaco@gmail.com')->send(new ReminderMail($details));
                }
            }
        }

        dd('test');
////        dd($next_lesson);
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
