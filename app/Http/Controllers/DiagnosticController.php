<?php

namespace App\Http\Controllers;

use App\Models\Diagnostic;
use App\Models\DiagnosticQuiz;
use App\Models\DiagnosticUserTag;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DiagnosticController extends Controller
{
    public function show($slug)
    {
        $diagnostic = DiagnosticQuiz::where('slug', $slug)->with('questions', 'diagnostic', 'questions.answers')->first();
        return Inertia::render('Diagnostic/Index', ['diagnostic' => $diagnostic]);
    }

    public function createLearningStyle()
    {
        return Inertia::render('Admin/Diagnostics/Personality/LearningStyle');
    }

    public function createTutorMatch()
    {

    }

    public function result(Request $request)
    {
        $user = Auth::user();
        $answers = $request->answer_list[0];
        if ($request->diagnostic_name == 'perfect-tutor-match') {
            $introvert = 0;
            $intuition = 0;
            $feeling = 0;
            $judging = 0;
            foreach ($answers as $answer) {
                $question = Question::findOrFail($answer['question_id']);
                if ($question['explanation'] == 'Extrovert/Introvert' && $answer['is_correct'] == 1) {
                    $introvert++;
                }
                if ($question['explanation'] == 'Sensing/Intuition' && $answer['is_correct'] == 1) {
                    $intuition++;
                }
                if ($question['explanation'] == 'Thinking/Feeling' && $answer['is_correct'] == 1) {
                    $feeling++;
                }
                if ($question['explanation'] == 'Judging/Percieving' && $answer['is_correct'] == 1) {
                    $judging++;
                }
            }
            $total_result = [$introvert, $intuition, $feeling, $judging];
            if (in_array($introvert, [0, 1]) && in_array($intuition, [2, 3]) && in_array($feeling, [2, 3]) && in_array($judging, [2, 3]))
                $user->profile->tutor_match = 'ISTJ';
            else if (in_array($introvert, [0, 1]) && in_array($intuition, [2, 3]) && in_array($feeling, [2, 3]) && in_array($judging, [0, 1]))
                $user->profile->tutor_match = 'ISFJ';
            else if (in_array($introvert, [0, 1]) && in_array($intuition, [2, 3]) && in_array($feeling, [0, 1]) && in_array($judging, [0, 1]))
                $user->profile->tutor_match = 'INFJ';
            else if (in_array($introvert, [0, 1]) && in_array($intuition, [0, 1]) && in_array($feeling, [0, 1]) && in_array($judging, [2, 3]))
                $user->profile->tutor_match = 'INTJ';
            else if (in_array($introvert, [0, 1]) && in_array($intuition, [0, 1]) && in_array($feeling, [2, 3]) && in_array($judging, [2, 3]))
                $user->profile->tutor_match = 'ISTP';
            else if (in_array($introvert, [0, 1]) && in_array($intuition, [0, 1]) && in_array($feeling, [2, 3]) && in_array($judging, [0, 1]))
                $user->profile->tutor_match = 'ISFP';
            else if (in_array($introvert, [0, 1]) && in_array($intuition, [0, 1]) && in_array($feeling, [0, 1]) && in_array($judging, [0, 1]))
                $user->profile->tutor_match = 'INFP';
            else if (in_array($introvert, [0, 1]) && in_array($intuition, [0, 1]) && in_array($feeling, [0, 1]) && in_array($judging, [2, 3]))
                $user->profile->tutor_match = 'INTP';
            else if (in_array($introvert, [2, 3]) && in_array($intuition, [0, 1]) && in_array($feeling, [2, 3]) && in_array($judging, [2, 3]))
                $user->profile->tutor_match = 'ESTP';
            else if (in_array($introvert, [2, 3]) && in_array($intuition, [0, 1]) && in_array($feeling, [2, 3]) && in_array($judging, [0, 1]))
                $user->profile->tutor_match = 'ESFP';
            else if (in_array($introvert, [2, 3]) && in_array($intuition, [0, 1]) && in_array($feeling, [0, 1]) && in_array($judging, [2, 3]))
                $user->profile->tutor_match = 'ENTP';
            else if (in_array($introvert, [2, 3]) && in_array($intuition, [2, 3]) && in_array($feeling, [2, 3]) && in_array($judging, [2, 3]))
                $user->profile->tutor_match = 'ESTJ';
            else if (in_array($introvert, [2, 3]) && in_array($intuition, [2, 3]) && in_array($feeling, [2, 3]) && in_array($judging, [0, 1]))
                $user->profile->tutor_match = 'ESFJ';
            else if (in_array($introvert, [2, 3]) && in_array($intuition, [2, 3]) && in_array($feeling, [0, 1]) && in_array($judging, [0, 1]))
                $user->profile->tutor_match = 'ENFJ';
            else if (in_array($introvert, [0, 1]) && in_array($intuition, [2, 3]) && in_array($feeling, [0, 1]) && in_array($judging, [2, 3]))
                $user->profile->tutor_match = 'ENTJ';
            else if (in_array($introvert, [2, 3]) && in_array($intuition, [0, 1]) && in_array($feeling, [0, 1]) && in_array($judging, [0, 1]))
                $user->profile->tutor_match = 'ENFP';
            $user->profile->save();
            $results = DiagnosticUserTag::where('title', $user->profile->tutor_match)->first();
        } else {
            $sum = count($answers);
            $points = 0;
            $correct = 0;
            foreach ($answers as $answer) {
                $points += $answer['explanation'];
            }
            $score = $points / $sum;
            $user->profile->learning_style = $score;
            $results = DiagnosticUserTag::where('title', $user->profile->learning_style)->first();
        }
        $learned = unserialize($results->learned);
        $tips = unserialize($results->tips);
        $plan = unserialize($results->plan);
        return Inertia::render('DiagnosticResults', ['results' => $results, 'learned' => $learned, 'plan' => $plan, 'tips' => $tips]);
    }

    public function updateQuiz(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $quiz = DiagnosticQuiz::findOrFail($id);
        $quiz->update([
            'name' => $request->name
        ]);
        return ['message' => 'Updated Successfully'];

    }

    public function deleteQuiz($id)
    {
        DiagnosticQuiz::findOrFail($id)->delete();
        return ['message' => 'Deleted Successfully'];
    }

    public function getAcademicQuizzes()
    {
        return Diagnostic::where('name', 'Academic')->first()->quizzes;
    }

    public function getPersonalityQuizzes()
    {
        return Diagnostic::where('name', 'Personality')->first()->quizzes;
    }

    public function storeAcademic(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:1024',
        ]);

        $file = $request->file('file');
        // File Details
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath();
        $fileSize = $file->getSize();
        $mimeType = $file->getMimeType();

        $location = 'storage/uploads';
        // Upload file
        $file->move($location, $filename);
        // Import CSV to Database
        $filepath = public_path($location . "/" . $filename);
        // Reading file
        $file = fopen($filepath, "r");
        $importData_arr = array();
        $i = 0;

        while (($filedata = fgetcsv($file, 20000, ";", '"')) !== FALSE) {
            $num = count($filedata);
            //Skip first row(Remove below comment if you want to skip the first row)
            if ($i == 0) {
                $i++;
                continue;
            }
            for ($c = 0; $c < $num; $c++) {
                $importData_arr[$i][] = $filedata[$c];
            }
            $i++;
        }
        fclose($file);

        foreach ($importData_arr as $row) {


            if (count($row) != 3) {
                return ['error' => 'Wrong format'];
            }
            if ($row[0] != '' && $row[1] != '' && $row[2] != '') {
                PracticeExam::create([
                    'title' => $row[0],
                    'url' => $row[1],
                    'subject' => $row[2],
                ]);
            } else {
                return ['error' => 'Empty fields detected'];
            }
        }
        return ['message' => 'Saved Successfully'];
    }
}
