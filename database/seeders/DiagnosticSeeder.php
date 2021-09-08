<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Diagnostic;
use App\Models\DiagnosticQuiz;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DiagnosticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $question1 = new Question;
        $question2 = new Question;
        $question3 = new Question;
        $personality = Diagnostic::create([
            'name' => 'Personality',
        ]);

        $learning_style = DiagnosticQuiz::create([
            'name' => 'Learning Style',
            'slug' => Str::slug('Learning Style'),
            'diagnostic_id' => $personality->id
        ]);
        $diagnostic_quiz = DiagnosticQuiz::find($learning_style->id);
        $question1->title = "Test Question";
        $diagnostic_quiz->questions()->save($question1);
        Answer::create([
            'title' => 'First Answer - false',
            'is_correct' => 0,
            'question_id' => $question1->id,
        ]);
        Answer::create([
            'title' => 'Second Answer - true',
            'is_correct' => 1,
            'question_id' => $question1->id,
        ]);
        $question2->title = "Test Question 2";
        $diagnostic_quiz->questions()->save($question2);


        $tutor_match = DiagnosticQuiz::create([
            'name' => 'Perfect Tutor Match',
            'slug' => Str::slug('Perfect Tutor Match'),
            'diagnostic_id' => $personality->id
        ]);
        $diagnostic_quiz = DiagnosticQuiz::find($tutor_match->id);
        $question3->title = "Test Question";
        $diagnostic_quiz->questions()->save($question3);


        $academic = Diagnostic::create([
            'name' => 'Academic',
        ]);

        DiagnosticQuiz::create([
            'name' => 'Mathematics',
            'slug' => Str::slug('Mathematics'),
            'diagnostic_id' => $academic->id
        ]);
        DiagnosticQuiz::create([
            'name' => 'Reading',
            'slug' => Str::slug('Reading'),
            'diagnostic_id' => $academic->id
        ]);
        DiagnosticQuiz::create([
            'name' => 'Grammar',
            'slug' => Str::slug('Grammar'),
            'diagnostic_id' => $academic->id
        ]);
    }
}
