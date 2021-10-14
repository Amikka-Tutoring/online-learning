<?php

namespace App\Console\Commands;

use App\Mail\ReminderMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class StudentReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remind:student';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remind student for next lesson/practice exam';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date_now = Carbon::now();
        foreach (User::all() as $user) {
            foreach ($user->lesson_dates as $lesson_date) {
                if ($lesson_date->day == $date_now->isoFormat('dddd') && Carbon::parse($lesson_date->time)->subHour(1)->format('h:i') == $date_now->format('h:i')) {
                    $details = [
                        'title' => 'Lesson Reminder',
                        'name' => $user->name,
                        'lesson_text' => 'Hello <strong>' . $user->name . '</strong>, do not forget you have a lesson today at: <strong>' . Carbon::parse($lesson_date->time)->format('h:i') . '</strong>'
                    ];
                    Mail::to($user->email)->send(new ReminderMail($details));
                }
            }
            foreach ($user->practice_exam_dates as $practice_exam) {
                if (Carbon::parse($practice_exam->date_time)->subHour(1)->format('Y-m-d h:i') == $date_now->format('Y-m-d h:i')) {
                    $details = [
                        'title' => 'Practice Exam Reminder',
                        'name' => $user->name,
                        'lesson_text' => 'Hello <strong>' . $user->name . '</strong>, do not forget you have a practice exam today at: <strong>' . Carbon::parse($practice_exam->date_time)->format('h:i') . '</strong>'
                    ];
                    Mail::to($user->email)->send(new ReminderMail($details));
                }
            }
        }
    }
}
