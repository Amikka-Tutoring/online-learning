<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Course;
use App\Models\Layer;
use App\Models\Question;
use App\Models\Video;
use App\Scopes\LayerScope;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function getLayers()
    {
        $courses = Course::with('topLayers');
        dd($courses);
    }

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

        // Insert to MySQL database
        $coursesArray = array();
        $topLayersArray = array();
        $midLayersArray = array();
        $lessLayersArray = array();
        foreach ($importData_arr as $row) {
            if (count($row) != 67) {
                return back()->with('error', 'Wrong format');
            }

            //Course
            $course = Course::where('name', $row[0])->first();
            if ($course == null) {
                $course = Course::create([
                    'name' => $row[0],
                    'slug' => Str::slug($row[0]),
                ]);
                array_push($coursesArray, $course->name);
            }
            if ($row[1] != '') {
                $top_layer = Layer::withoutGlobalScope(LayerScope::class)->where('name', $row[1])->first();
                if ($top_layer == null) {
                    //Top Layer
                    $top_layer = Layer::create([
                        'name' => $row[1],
                        'course_id' => $course->id,
                    ]);
                    array_push($topLayersArray, $top_layer->course->name . '/' . $top_layer->name);
                }
                switch ($row[2]) {
                    case 'Hard':
                        $top_layer->setHard();
                        break;
                    case 'Medium':
                        $top_layer->setMedium();
                        break;
                    default:
                        $top_layer->setEasy();
                }

                //Top Layer Video
                if ($row[3] != '') {
                    $top_layer_video = Video::create([
                        'title' => $row[3],
                        'url' => $row[4],
                        'description' => $row[5],
                        'layer_id' => $top_layer->id,
                    ]);
                    switch ($row[6]) {
                        case 'Hard':
                            $top_layer_video->setHard();
                            break;
                        case 'Medium':
                            $top_layer_video->setMedium();
                            break;
                        default:
                            $top_layer_video->setEasy();
                    }
                }
                //Top Layer Question
                if ($row[7] != '') {
                    $top_layer_question = new Question;
                    $top_layer_question->title = $row[7];

                    switch ($row[8]) {
                        case 'Hard':
                            $top_layer_question->setHard();
                            break;
                        case 'Medium':
                            $top_layer_question->setMedium();
                            break;
                        default:
                            $top_layer_question->setEasy();
                    }
                    $top_layer_question->image = $row[9];
                    $top_layer_question->explanation = $row[10];
                    $top_layer->questions()->save($top_layer_question);

                    //Top Layer Question Answers
                    if ($row[11] != '') {
                        Answer::create([
                            'title' => $row[11],
                            'explanation' => $row[12],
                            'is_correct' => $row[13],
                            'question_id' => $top_layer_question->id,
                        ]);
                    }
                    if ($row[14] != '') {
                        Answer::create([
                            'title' => $row[14],
                            'explanation' => $row[15],
                            'is_correct' => $row[16],
                            'question_id' => $top_layer_question->id,
                        ]);
                    }
                    if ($row[17] != '') {
                        Answer::create([
                            'title' => $row[17],
                            'explanation' => $row[18],
                            'is_correct' => $row[19],
                            'question_id' => $top_layer_question->id,
                        ]);
                    }
                    if ($row[20] != '') {
                        Answer::create([
                            'title' => $row[20],
                            'explanation' => $row[21],
                            'is_correct' => $row[22],
                            'question_id' => $top_layer_question->id,
                        ]);
                    }
                }
            }


            //MidLayer
            if ($row[23] != '') {
                $mid_layer = Layer::withoutGlobalScope(LayerScope::class)->where('name', $row[23])->where('parent_id', $top_layer->id)->first();
                if ($mid_layer == null) {
                    //Top Layer
                    $mid_layer = Layer::create([
                        'name' => $row[23],
                        'course_id' => $course->id,
                        'parent_id' => $top_layer->id,
                    ]);
                    array_push($midLayersArray, $mid_layer->name);
                }
                switch ($row[24]) {
                    case 'Hard':
                        $mid_layer->setHard();
                        break;
                    case 'Medium':
                        $mid_layer->setMedium();
                        break;
                    default:
                        $mid_layer->setEasy();
                }

                //Top Layer Video
                if ($row[25] != '') {
                    $mid_layer_video = Video::create([
                        'title' => $row[25],
                        'url' => $row[26],
                        'description' => $row[27],
                        'layer_id' => $mid_layer->id,
                    ]);
                    switch ($row[28]) {
                        case 'Hard':
                            $mid_layer_video->setHard();
                            break;
                        case 'Medium':
                            $mid_layer_video->setMedium();
                            break;
                        default:
                            $mid_layer_video->setEasy();
                    }
                }

                if ($row[29] != '') {
                    //Top Layer Question
                    $mid_layer_question = new Question;
                    $mid_layer_question->title = $row[29];

                    switch ($row[30]) {
                        case 'Hard':
                            $mid_layer_question->setHard();
                            break;
                        case 'Medium':
                            $mid_layer_question->setMedium();
                            break;
                        default:
                            $mid_layer_question->setEasy();
                    }
                    if ($row[31] != '') {
                        $mid_layer_question->image = $row[31];
                        $mid_layer_question->explanation = $row[32];
                        $mid_layer->questions()->save($mid_layer_question);

                        //Top Layer Question Answers
                        if ($row[33] != '') {
                            Answer::create([
                                'title' => $row[33],
                                'explanation' => $row[34],
                                'is_correct' => $row[35],
                                'question_id' => $mid_layer_question->id,
                            ]);
                        }
                        if ($row[36] != '') {
                            Answer::create([
                                'title' => $row[36],
                                'explanation' => $row[37],
                                'is_correct' => $row[38],
                                'question_id' => $mid_layer_question->id,
                            ]);
                        }
                        if ($row[39] != '') {
                            Answer::create([
                                'title' => $row[39],
                                'explanation' => $row[40],
                                'is_correct' => $row[41],
                                'question_id' => $mid_layer_question->id,
                            ]);
                        }
                        if ($row[42] != '') {
                            Answer::create([
                                'title' => $row[42],
                                'explanation' => $row[43],
                                'is_correct' => $row[44],
                                'question_id' => $mid_layer_question->id,
                            ]);
                        }
                    }
                }
                //Lesson
                if ($row[45] != '') {
                    $lesson = Layer::withoutGlobalScope(LayerScope::class)->where('name', $row[45])->where('parent_id', $mid_layer->id)->first();
                    if ($lesson == null) {
                        //Top Layer
                        $lesson = Layer::create([
                            'name' => $row[45],
                            'course_id' => $course->id,
                            'parent_id' => $mid_layer->id,
                        ]);
                        array_push($lessLayersArray, $lesson->name);
                    }
                    switch ($row[46]) {
                        case 'Hard':
                            $lesson->setHard();
                            break;
                        case 'Medium':
                            $lesson->setMedium();
                            break;
                        default:
                            $lesson->setEasy();
                    }

                    //Top Layer Video
                    if ($row[47] != '') {
                        $lesson_video = Video::create([
                            'title' => $row[47],
                            'url' => $row[48],
                            'description' => $row[49],
                            'layer_id' => $lesson->id,
                        ]);
                        switch ($row[50]) {
                            case 'Hard':
                                $lesson_video->setHard();
                                break;
                            case 'Medium':
                                $lesson_video->setMedium();
                                break;
                            default:
                                $lesson_video->setEasy();
                        }
                    }
                    //Top Layer Question
                    if ($row[51] != '') {
                        $lesson_question = new Question;
                        $lesson_question->title = $row[51];

                        switch ($row[52]) {
                            case 'Hard':
                                $lesson_question->setHard();
                                break;
                            case 'Medium':
                                $lesson_question->setMedium();
                                break;
                            default:
                                $lesson_question->setEasy();
                        }
                        $lesson_question->image = $row[53];
                        $lesson_question->explanation = $row[54];
                        $lesson->questions()->save($lesson_question);
                        //Top Layer Question Answers
                        if ($row[55] != '') {
                            Answer::create([
                                'title' => $row[55],
                                'explanation' => $row[56],
                                'is_correct' => $row[57],
                                'question_id' => $lesson_question->id,
                            ]);
                        }
                        if ($row[58] != '') {
                            Answer::create([
                                'title' => $row[58],
                                'explanation' => $row[59],
                                'is_correct' => $row[60],
                                'question_id' => $lesson_question->id,
                            ]);
                        }
                        if ($row[61] != '') {
                            Answer::create([
                                'title' => $row[61],
                                'explanation' => $row[62],
                                'is_correct' => $row[63],
                                'question_id' => $lesson_question->id,
                            ]);
                        }
                        if ($row[64] != '') {
                            Answer::create([
                                'title' => $row[64],
                                'explanation' => $row[65],
                                'is_correct' => $row[66],
                                'question_id' => $lesson_question->id,
                            ]);
                        }
                    }
                }
            }
        }
        return ['courses' => $coursesArray, 'top_layers' => $topLayersArray, 'mid_layers' => $midLayersArray, 'less_layers' => $lessLayersArray, 'message' => 'Uploaded Successfully'];
    }

    public function updateCourse(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $course = Course::findOrFail($id);
        $course->update([
            'name' => $request->name
        ]);
        return ['message' => 'Updated Successfully'];
    }

    public function getCourses()
    {
        return Course::all();
    }

    public function deleteCourse($id)
    {
        Course::findOrFail($id)->delete();
        return ['message' => 'Deleted successfully'];
    }
}
