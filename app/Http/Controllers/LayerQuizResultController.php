<?php

namespace App\Http\Controllers;

use App\Models\LayerQuizResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LayerQuizResultController extends Controller
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
    public function store(Request $request, $layer_id)
    {
        $answers = $request->all();
        $sum = count($answers);
        $correct = 0;
        foreach ($answers as $answer) {
            if ($answer['is_correct'] == 1) {
                $correct++;
            }
        }
        $score = $correct / $sum * 100;
        LayerQuizResult::updateOrCreate([
            'user_id' => Auth::user()->id,
            'layer_id' => $layer_id
        ], [
            'user_id' => Auth::user()->id,
            'layer_id' => $layer_id,
            'score' => $score
        ]);
        return ['message' => 'Submited Successfully', 'score' => 'Your score is: ' . $score];
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\LayerQuizResult $layerQuizResult
     * @return \Illuminate\Http\Response
     */
    public function show(LayerQuizResult $layerQuizResult)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\LayerQuizResult $layerQuizResult
     * @return \Illuminate\Http\Response
     */
    public function edit(LayerQuizResult $layerQuizResult)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\LayerQuizResult $layerQuizResult
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LayerQuizResult $layerQuizResult)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\LayerQuizResult $layerQuizResult
     * @return \Illuminate\Http\Response
     */
    public function destroy(LayerQuizResult $layerQuizResult)
    {
        //
    }
}
