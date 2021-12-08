<?php

namespace App\Http\Controllers;

use App\Models\DiagnosticContent;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DiagnosticContentController extends Controller
{
    public function index(): \Inertia\Response
    {
        $contents = DiagnosticContent::with('quiz')->get();
        return Inertia::render('Admin/DiagnosticContent', ['contents' => $contents]);
    }

    public function store(Request $request, DiagnosticContent $content): array
    {
        $request->validate([
            'diagnostic_quiz_id' => 'required|exists:layers,id',
            'link' => 'required|url'
        ]);

        $content->update([
            'link' => $request->link
        ]);

        return ['message' => 'Updated Successfully'];
    }

    public function destroy(DiagnosticContent $content): array
    {
        $content->link = null;
        $content->save();
        return ['message' => 'Deleted Successfully', 'contents' => DiagnosticContent::with('quiz')->get()];
    }
}
