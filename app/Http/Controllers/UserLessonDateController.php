<?php

namespace App\Http\Controllers;

use App\Models\UserLessonDate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLessonDateController extends Controller
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
    public function store(Request $request)
    {
        $request->validate([
            'day' => 'required',
            'time' => 'required',
        ]);
        UserLessonDate::updateOrCreate([
            'day' => $request->day
        ], [
            'day' => $request->day,
            'time' => $request->time,
            'user_id' => Auth::id()
        ]);

        return ['message' => 'Saved Successfully'];
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\UserLessonDate $userLessonDate
     * @return \Illuminate\Http\Response
     */
    public function show(UserLessonDate $userLessonDate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\UserLessonDate $userLessonDate
     * @return \Illuminate\Http\Response
     */
    public function edit(UserLessonDate $userLessonDate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\UserLessonDate $userLessonDate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'day' => 'required',
            'time' => 'required',
        ]);
        $lesson_dates = UserLessonDate::find($request->id);
        $lesson_dates->update([
            'time' => $request->time
        ]);
        return ['message' => 'Updated Successfully'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\UserLessonDate $userLessonDate
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserLessonDate $userLessonDate)
    {
        //
    }
}
