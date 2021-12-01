<?php

namespace App\Http\Controllers;

use App\Models\Layer;
use App\Models\LayerContent;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LayerContentController extends Controller
{
    public function index()
    {
        $contents = LayerContent::with('layer')->get();
        return Inertia::render('Admin/QuizContent', ['contents' => $contents]);
    }

    public function store(Request $request, LayerContent $content)
    {
        $request->validate([
            'layer_id' => 'required|exists:layers,id',
            'link' => 'required|url'
        ]);

        $content->update([
            'link' => $request->link
        ]);

        return ['message' => 'Updated Successfully'];
    }

    public function destroy(LayerContent $content)
    {
        $content->delete();
        return ['message' => 'Deleted Successfully', 'contents' => LayerContent::with('layer')->get()];
    }
}
