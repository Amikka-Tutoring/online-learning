<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    public function store(Request $request)
    {
        dd($request->all());

        $notes = Note::updateOrCreate(
            [
                'layer_id' => $request->lesson_id,
                'user_id' => Auth::id()
            ], [
            'topic' => 'test',
            'written_notes' => $request->note,
            'user_id' => Auth::id(),
            'layer_id' => $request->lesson_id
        ]);
        dd('Saved successfully');
    }
}
