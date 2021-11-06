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


            if (count($row) != 64) {
                return ['error' => 'Wrong format'];
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
                $top_layer = $course->layers->where('name', $row[1])->first();
                if ($top_layer == null) {
                    //Top Layer
                    $top_layer = Layer::create([
                        'name' => $row[1],
                        'course_id' => $course->id,
                    ]);
                    array_push($topLayersArray, $top_layer->course->name . ' / ' . $top_layer->name);
                }

                //Top Layer Video
                if ($row[2] != '') {
                    $top_layer_video = Video::create([
                        'title' => $row[2],
                        'url' => $row[3],
                        'description' => $row[4],
                        'layer_id' => $top_layer->id,
                    ]);
                    foreach (explode(', ', $row[5]) as $tag) {
                        $top_layer_video->setTag($tag);
                    }
                }
                //Top Layer Question
                if ($row[6] != '') {
                    $top_layer_question = new Question;
                    $top_layer_question->title = $row[6];

                    foreach (explode(', ', $row[7]) as $tag) {
                        $top_layer_question->setTag($tag);
                    }

                    $top_layer_question->image = $row[8];
                    $top_layer_question->explanation = $row[9];
                    $top_layer->questions()->save($top_layer_question);

                    //Top Layer Question Answers
                    if ($row[11] != '') {
                        Answer::create([
                            'title' => $row[10],
                            'explanation' => $row[11],
                            'is_correct' => $row[12],
                            'question_id' => $top_layer_question->id,
                        ]);
                    }
                    if ($row[13] != '') {
                        Answer::create([
                            'title' => $row[13],
                            'explanation' => $row[14],
                            'is_correct' => $row[15],
                            'question_id' => $top_layer_question->id,
                        ]);
                    }
                    if ($row[16] != '') {
                        Answer::create([
                            'title' => $row[16],
                            'explanation' => $row[17],
                            'is_correct' => $row[18],
                            'question_id' => $top_layer_question->id,
                        ]);
                    }
                    if ($row[19] != '') {
                        Answer::create([
                            'title' => $row[19],
                            'explanation' => $row[20],
                            'is_correct' => $row[21],
                            'question_id' => $top_layer_question->id,
                        ]);
                    }
                }
            }


            //MidLayer
            if ($row[22] != '') {
                $mid_layer = $course->layers->where('name', $row[22])->where('parent_id', $top_layer->id)->first();
                if ($mid_layer == null) {
                    //Top Layer
                    $mid_layer = Layer::create([
                        'name' => $row[22],
                        'course_id' => $course->id,
                        'parent_id' => $top_layer->id,
                    ]);
                    array_push($midLayersArray, $course->name . ' / ' . $top_layer->name . ' / ' . $mid_layer->name);
                }


                //Mid Layer Video
                if ($row[23] != '') {
                    $mid_layer_video = Video::create([
                        'title' => $row[23],
                        'url' => $row[24],
                        'description' => $row[25],
                        'layer_id' => $mid_layer->id,
                    ]);
                    foreach (explode(', ', $row[26]) as $tag) {
                        $mid_layer_video->setTag($tag);
                    }
                }

                if ($row[27] != '') {
                    //Top Layer Question
                    $mid_layer_question = new Question;
                    $mid_layer_question->title = $row[27];

                    foreach (explode(', ', $row[28]) as $tag) {
                        $mid_layer_question->setTag($tag);
                    }

                    if ($row[29] != '') {
                        $mid_layer_question->image = $row[29];
                        $mid_layer_question->explanation = $row[30];
                        $mid_layer->questions()->save($mid_layer_question);

                        //Top Layer Question Answers
                        if ($row[31] != '') {
                            Answer::create([
                                'title' => $row[31],
                                'explanation' => $row[32],
                                'is_correct' => $row[33],
                                'question_id' => $mid_layer_question->id,
                            ]);
                        }
                        if ($row[34] != '') {
                            Answer::create([
                                'title' => $row[34],
                                'explanation' => $row[35],
                                'is_correct' => $row[36],
                                'question_id' => $mid_layer_question->id,
                            ]);
                        }
                        if ($row[37] != '') {
                            Answer::create([
                                'title' => $row[37],
                                'explanation' => $row[38],
                                'is_correct' => $row[39],
                                'question_id' => $mid_layer_question->id,
                            ]);
                        }
                        if ($row[40] != '') {
                            Answer::create([
                                'title' => $row[40],
                                'explanation' => $row[41],
                                'is_correct' => $row[42],
                                'question_id' => $mid_layer_question->id,
                            ]);
                        }
                    }
                }
                //Lesson
                if ($row[43] != '') {
                    $lesson = $course->layers->where('name', $row[43])->where('parent_id', $mid_layer->id)->first();
                    if ($lesson == null) {
                        //Top Layer
                        $lesson = Layer::create([
                            'name' => $row[43],
                            'course_id' => $course->id,
                            'parent_id' => $mid_layer->id,
                        ]);
                        array_push($lessLayersArray, $course->name . ' / ' . $top_layer->name . ' / ' . $mid_layer->name . ' / ' . $lesson->name);
                    }

                    //Top Layer Video
                    if ($row[44] != '') {
                        $lesson_video = Video::create([
                            'title' => $row[44],
                            'url' => $row[45],
                            'description' => $row[46],
                            'layer_id' => $lesson->id,
                        ]);
                        foreach (explode(', ', $row[47]) as $tag) {
                            $lesson_video->setTag($tag);
                        }
                    }
                    //Top Layer Question
                    if ($row[48] != '') {
                        $lesson_question = new Question;
                        $lesson_question->title = $row[48];

                        foreach (explode(', ', $row[49]) as $tag) {
                            $lesson_question->setTag($tag);
                        }

                        $lesson_question->image = $row[50];
                        $lesson_question->explanation = $row[51];
                        $lesson->questions()->save($lesson_question);
                        //Top Layer Question Answers
                        if ($row[52] != '') {
                            Answer::create([
                                'title' => $row[52],
                                'explanation' => $row[53],
                                'is_correct' => $row[54],
                                'question_id' => $lesson_question->id,
                            ]);
                        }
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
