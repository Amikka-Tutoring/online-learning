<?php

namespace App\Http\Controllers;

use App\Models\PracticeExam;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PracticeExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = PracticeExam::all();
        return Inertia::render('Admin/Exams/Create', ['exams' => $exams]);
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

    /**
     * Display the specified resource.
     *
     * @param \App\Models\PracticeExam $practiceExam
     * @return \Illuminate\Http\Response
     */
    public function show(PracticeExam $practiceExam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\PracticeExam $practiceExam
     * @return \Illuminate\Http\Response
     */
    public function edit(PracticeExam $practiceExam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PracticeExam $practiceExam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required|url',
            'subject' => 'required'
        ]);
        $exam = PracticeExam::findOrFail($id);
        $exam->update([
            'title' => $request->title,
            'url' => $request->url,
            'subject' => $request->subject,
        ]);
        return ['message' => 'Updated Successfully'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\PracticeExam $practiceExam
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PracticeExam::findOrFail($id)->delete();
        return ['message' => 'Deleted successfully'];
    }
}
