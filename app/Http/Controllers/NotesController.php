<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    public function store(Request $request)
    {

        $notes = Note::create([
            'topic' => 'test',
            'written_notes' => $request->written_notes,
            'user_id' => Auth::id(),
            'layer_id' => $request->lesson_id
        ]);
        dd('Saved successfully');
    }
}
