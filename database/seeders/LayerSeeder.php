<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Course;
use App\Models\Layer;
use App\Models\Question;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Stripe\Plan;
use Stripe\Stripe;

class LayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $course = Course::create([
            'name' => 'SAT Grammar',
            'slug' => Str::slug('Grammar'),
        ]);
        $course2 = Course::create([
            'name' => 'SAT Reading',
            'slug' => Str::slug('Reading'),
        ]);
        $course3 = Course::create([
            'name' => 'SAT Maths',
            'slug' => Str::slug('Reading'),
        ]);
        $parent_1 = Layer::create([
            'name' => 'English Strategy',
            'course_id' => $course->id,
        ]);
        $parent_1->setEasy();
        $parent_2 = Layer::create([
            'name' => 'About the SAT English',
            'course_id' => $course->id,
        ]);
        $parent_1->setMedium();

        $video_parent = Video::create([
            'title' => 'New video',
            'url' => 'https://www.youtube.com/watch?v=Ey_YfYZ1Ta8',
            'description' => 'Mr. Bean video of english strategy layer',
            'layer_id' => $parent_1->id,
        ]);
        $question_parent_1 = new Question;
        $question_parent_1->title = "First Question of top layer - English Strategy";
//        $top_layer_english = Layer::find($parent->id);
        $parent_1->questions()->save($question_parent_1);
        Answer::create([
            'title' => 'First Answer - FALSE',
            'is_correct' => 0,
            'question_id' => $question_parent_1->id,
        ]);
        Answer::create([
            'title' => 'Second Answer - true',
            'is_correct' => 1,
            'question_id' => $question_parent_1->id,
        ]);

        $children_1 = Layer::create([
            'name' => 'Concision',
            'parent_id' => $parent_1->id,
            'course_id' => $course->id,
        ]);
        $children_1->setEasy();

        $video_children = Video::create([
            'title' => 'New video 1',
            'url' => 'https://www.youtube.com/watch?v=Ey_YfYZ1Ta8',
            'description' => 'Mr. Bean video of Concision layer',
            'layer_id' => $children_1->id,
        ]);
        $question_children_1 = new Question;
        $question_children_1->title = "First Question of middle layer - Concision";
//        $top_layer_english = Layer::find($parent->id);
        $children_1->questions()->save($question_children_1);
        Answer::create([
            'title' => 'First Answer - false',
            'is_correct' => 0,
            'question_id' => $question_children_1->id,
        ]);
        Answer::create([
            'title' => 'Second Answer - true',
            'is_correct' => 1,
            'question_id' => $question_children_1->id,
        ]);


        $children_2 = Layer::create([
            'name' => 'Transition Words',
            'parent_id' => $parent_1->id,
            'course_id' => $course->id,
        ]);
        $children_2->setMedium();

        $grand_children = Layer::create([
            'name' => 'Wordy Phrases',
            'parent_id' => $children_1->id,
            'course_id' => $course->id,
        ]);
        $children_2->setEasy();

        $video_grand_children = Video::create([
            'title' => 'New video 2',
            'url' => 'https://www.youtube.com/watch?v=Ey_YfYZ1Ta8',
            'description' => 'Mr. Bean video of Wordy Phrases layer',
            'layer_id' => $children_1->id,
        ]);
        $question_grand_children_1 = new Question;
        $question_grand_children_1->title = "First Question of middle layer - Concision";
//        $top_layer_english = Layer::find($parent->id);
        $grand_children->questions()->save($question_grand_children_1);
        Answer::create([
            'title' => 'First Answer - False',
            'is_correct' => 0,
            'question_id' => $question_grand_children_1->id,
        ]);
        Answer::create([
            'title' => 'Second Answer - true',
            'is_correct' => 1,
            'question_id' => $question_grand_children_1->id,
        ]);

        $grand_children_1 = Layer::create([
            'name' => 'Redundancy',
            'parent_id' => $children_1->id,
            'course_id' => $course->id,
        ]);
    }
}
