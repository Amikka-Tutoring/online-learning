<?php

namespace App\Http\Controllers;

use App\Models\UserExamVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserExamVisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
    public function visit(Request $request, $id)
    {
        UserExamVisit::create([
            'user_id' => Auth::id(),
            'exam_id' => $id,
            'visited' => '1'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\UserExamVisit $userExamVisit
     * @return \Illuminate\Http\Response
     */
    public function show(UserExamVisit $userExamVisit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\UserExamVisit $userExamVisit
     * @return \Illuminate\Http\Response
     */
    public function edit(UserExamVisit $userExamVisit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\UserExamVisit $userExamVisit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserExamVisit $userExamVisit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\UserExamVisit $userExamVisit
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserExamVisit $userExamVisit)
    {
        //
    }
}
