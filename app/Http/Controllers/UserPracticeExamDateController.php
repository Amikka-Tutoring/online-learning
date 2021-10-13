<?php

namespace App\Http\Controllers;

use App\Models\PracticeExam;
use App\Models\UserPracticeExamDate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPracticeExamDateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'date_time' => 'required',
            'exam_id' => 'required|exists:practice_exams,id',
        ]);
        UserPracticeExamDate::updateOrCreate([
            'exam_id' => $id
        ], [
            'date_time' => $request->date_time,
            'user_id' => Auth::id(),
            'exam_id' => $id
        ]);
        $user = Auth::user();
        $scheduled = $user->practice_exam_dates->pluck('exam_id');
        $exams = PracticeExam::whereNotIn('id', $scheduled)->get();

        $calendar_exams = $user->practice_exam_dates->map(function ($item, $index) {
            return [
                'start' => Carbon::parse($item['date_time'])->toDateString()
            ];
        });
        return ['message' => 'Saved Successfully', 'exams' => $exams, 'calendar_exams' => $calendar_exams];
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\UserPracticeExamDate $userPracticeExamDate
     * @return \Illuminate\Http\Response
     */
    public function show(UserPracticeExamDate $userPracticeExamDate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\UserPracticeExamDate $userPracticeExamDate
     * @return \Illuminate\Http\Response
     */
    public function edit(UserPracticeExamDate $userPracticeExamDate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\UserPracticeExamDate $userPracticeExamDate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserPracticeExamDate $userPracticeExamDate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\UserPracticeExamDate $userPracticeExamDate
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPracticeExamDate $userPracticeExamDate)
    {
        //
    }
}
