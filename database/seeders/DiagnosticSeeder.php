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
        $question4 = new Question;
        $question5 = new Question;
        $question6 = new Question;
        $question7 = new Question;
        $question8 = new Question;
        $question9 = new Question;
        $question10 = new Question;
        $question11 = new Question;
        $question12 = new Question;

        $personality = Diagnostic::create([
            'name' => 'Personality',
            'slug' => Str::slug('Personality')
        ]);

        $learning_style = DiagnosticQuiz::create([
            'name' => 'Learning Style',
            'slug' => Str::slug('Learning Style'),
            'diagnostic_id' => $personality->id
        ]);
        $diagnostic_quiz = DiagnosticQuiz::find($learning_style->id);
        $question1->title = "When you don't know how to spell a word what would be your immediate approach?";
        $diagnostic_quiz->questions()->save($question1);
        Answer::create([
            'title' => 'Write it down',
            'is_correct' => 0,
            'explanation' => '3',
            'question_id' => $question1->id,
        ]);
        Answer::create([
            'title' => 'Spell it out loud ',
            'is_correct' => 0,
            'explanation' => '3',
            'question_id' => $question1->id,
        ]);
        Answer::create([
            'title' => 'Trace the letters in the air ',
            'is_correct' => 0,
            'explanation' => '2',
            'question_id' => $question1->id,
        ]);
        $question2->title = "How do you like to study?";
        $diagnostic_quiz->questions()->save($question2);
        Answer::create([
            'title' => 'Index cards',
            'is_correct' => 0,
            'explanation' => '3',
            'question_id' => $question2->id,
        ]);
        Answer::create([
            'title' => 'Answer questions out loud ',
            'is_correct' => 0,
            'explanation' => '1',
            'question_id' => $question2->id,
        ]);
        Answer::create([
            'title' => 'Read books or notes and look at pictures',
            'is_correct' => 0,
            'explanation' => '2',
            'question_id' => $question2->id,
        ]);

        $question3->title = "If you didn't know how to fix a computer what would be your immediate approach?";
        $question4->title = "If you went to a party what would you remember most the next day?";
        $question5->title = "What distracts you the most when you are studying?";
        $question6->title = "Which class would you choose?";
        $question7->title = "When you hear a good song what is your initial reaction?";
        $question8->title = "What would distract you the most in class?";
        $question9->title = "How do you relax?";
        $question10->title = "When you meet someone new what are you most likely to remember?";
        $question11->title = "What method of studying do you think would work best for you?";

        $diagnostic_quiz->questions()->save($question3);
        $diagnostic_quiz->questions()->save($question4);
        $diagnostic_quiz->questions()->save($question5);
        $diagnostic_quiz->questions()->save($question6);
        $diagnostic_quiz->questions()->save($question7);
        $diagnostic_quiz->questions()->save($question8);
        $diagnostic_quiz->questions()->save($question9);
        $diagnostic_quiz->questions()->save($question10);
        $diagnostic_quiz->questions()->save($question11);

        Answer::create([
            'title' => 'Get someone to show you ',
            'is_correct' => 0,
            'explanation' => '1',
            'question_id' => $question3->id,
        ]);
        Answer::create([
            'title' => 'Read about it or have someone explain it to you',
            'is_correct' => 0,
            'explanation' => '2',
            'question_id' => $question3->id,
        ]);
        Answer::create([
            'title' => 'Figure it out on your own',
            'is_correct' => 0,
            'explanation' => '3',
            'question_id' => $question3->id,
        ]);


        Answer::create([
            'title' => 'The music at the party',
            'is_correct' => 0,
            'explanation' => '1',
            'question_id' => $question4->id,
        ]);
        Answer::create([
            'title' => 'The faces of the people at the party ',
            'is_correct' => 0,
            'explanation' => '2',
            'question_id' => $question4->id,
        ]);
        Answer::create([
            'title' => 'The food you ate',
            'is_correct' => 0,
            'explanation' => '3',
            'question_id' => $question4->id,
        ]);

        Answer::create([
            'title' => 'An uncomfortable chair',
            'is_correct' => 0,
            'explanation' => '3',
            'question_id' => $question5->id,
        ]);
        Answer::create([
            'title' => 'People walking past you',
            'is_correct' => 0,
            'explanation' => '2',
            'question_id' => $question5->id,
        ]);
        Answer::create([
            'title' => 'Loud noises',
            'is_correct' => 0,
            'explanation' => '1',
            'question_id' => $question5->id,
        ]);

        Answer::create([
            'title' => 'Art class',
            'is_correct' => 0,
            'explanation' => '2',
            'question_id' => $question6->id,
        ]);
        Answer::create([
            'title' => 'Gym class',
            'is_correct' => 0,
            'explanation' => '3',
            'question_id' => $question6->id,
        ]);
        Answer::create([
            'title' => 'Music class',
            'is_correct' => 0,
            'explanation' => '1',
            'question_id' => $question6->id,
        ]);

        Answer::create([
            'title' => 'Sing out loud',
            'is_correct' => 0,
            'explanation' => '1',
            'question_id' => $question7->id,
        ]);
        Answer::create([
            'title' => 'Picture the music video',
            'is_correct' => 0,
            'explanation' => '2',
            'question_id' => $question7->id,
        ]);
        Answer::create([
            'title' => 'Start dancing, tapping, or humming',
            'is_correct' => 0,
            'explanation' => '3',
            'question_id' => $question7->id,
        ]);

        Answer::create([
            'title' => 'Lights that are flickering',
            'is_correct' => 0,
            'explanation' => '2',
            'question_id' => $question8->id,
        ]);
        Answer::create([
            'title' => 'Noises from outside',
            'is_correct' => 0,
            'explanation' => '1',
            'question_id' => $question8->id,
        ]);
        Answer::create([
            'title' => 'The temperature being too cold or hot',
            'is_correct' => 0,
            'explanation' => '3',
            'question_id' => $question8->id,
        ]);

        Answer::create([
            'title' => 'Read',
            'is_correct' => 0,
            'explanation' => '2',
            'question_id' => $question9->id,
        ]);
        Answer::create([
            'title' => 'Listen to music',
            'is_correct' => 0,
            'explanation' => '1',
            'question_id' => $question9->id,
        ]);
        Answer::create([
            'title' => 'Exercise',
            'is_correct' => 0,
            'explanation' => '3',
            'question_id' => $question9->id,
        ]);

        Answer::create([
            'title' => 'Their face but not their name',
            'is_correct' => 0,
            'explanation' => '2',
            'question_id' => $question10->id,
        ]);
        Answer::create([
            'title' => 'Their name but not their face',
            'is_correct' => 0,
            'explanation' => '1',
            'question_id' => $question10->id,
        ]);
        Answer::create([
            'title' => 'What you talked about with them',
            'is_correct' => 0,
            'explanation' => '3',
            'question_id' => $question10->id,
        ]);

        Answer::create([
            'title' => 'Create index cards that you can review',
            'is_correct' => 0,
            'explanation' => '3',
            'question_id' => $question11->id,
        ]);
        Answer::create([
            'title' => 'Have someone ask you questions that you can respond to outloud',
            'is_correct' => 0,
            'explanation' => '1',
            'question_id' => $question11->id,
        ]);
        Answer::create([
            'title' => 'Read the book or your notes',
            'is_correct' => 0,
            'explanation' => '2',
            'question_id' => $question11->id,
        ]);


        $tutor_match = DiagnosticQuiz::create([
            'name' => 'Perfect Tutor Match',
            'slug' => Str::slug('Perfect Tutor Match'),
            'diagnostic_id' => $personality->id
        ]);

        $diagnostic_quiz = DiagnosticQuiz::find($tutor_match->id);
        $question12->title = "Test Question";
        $question12->image = "https://i.insider.com/5a4bdcc6cb9df434008b4577?width=1000&format=jpeg&auto=webp";
        $diagnostic_quiz->questions()->save($question12);

        Answer::create([
            'title' => 'First Answer - false',
            'is_correct' => 0,
            'question_id' => $question12->id,
        ]);
        Answer::create([
            'title' => 'Second Answer - false',
            'is_correct' => 0,
            'question_id' => $question12->id,
        ]);
        Answer::create([
            'title' => 'Third Answer - false',
            'is_correct' => 0,
            'question_id' => $question12->id,
        ]);
        Answer::create([
            'title' => 'Fourth Answer - true',
            'is_correct' => 1,
            'question_id' => $question12->id,
        ]);

        $academic = Diagnostic::create([
            'name' => 'Academic',
            'slug' => Str::slug('Academic')
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
