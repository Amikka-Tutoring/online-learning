<?php

namespace Database\Seeders;

use App\Models\PracticeExam;
use Illuminate\Database\Seeder;

class PracticeExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PracticeExam::create([
            'title' => 'First Exam',
            'url' => 'https://www.google.com',
            'subject' => 'MATH'
        ]);
        PracticeExam::create([
            'title' => 'Second Exam',
            'url' => 'https://www.google.com',
            'subject' => 'SAT'
        ]);
        PracticeExam::create([
            'title' => 'Third Exam',
            'url' => 'https://www.google.com',
            'subject' => 'ALG'
        ]);
    }
}
