<?php

namespace App\Console\Commands;

use App\Mail\ReminderMail;
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
        $details = [
            'name' => 'Test Name'
        ];
        Mail::to('edin.vllaco@gmail.com')->send(new ReminderMail($details));
    }
}
