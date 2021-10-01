<?php

namespace App\Models;

use App\Http\Controllers\UserController;
use App\Scopes\LayerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function layers()
    {
        return $this->hasMany(Layer::class);
    }

    public function topLayers()
    {
        return Layer::withoutGlobalScope(LayerScope::class)->whereNull('parent_id')->get();
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'course_id', 'id');
    }


    public function count_quizzes()
    {
        $quizzes_count = 0;
        foreach ($this->topLayers() as $topLayer) {
            if ($topLayer->questions) {
                $quizzes_count++;
                foreach ($topLayer->children as $mid) {
                    if ($mid->questions) {
                        $quizzes_count++;
                        foreach ($mid->children as $less) {
                            if ($less->questions) {
                                $quizzes_count++;
                            }
                        }
                    }
                }
            }
        }
        return $quizzes_count;
    }

}
