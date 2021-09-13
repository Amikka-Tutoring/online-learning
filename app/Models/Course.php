<?php

namespace App\Models;

use App\Http\Controllers\UserController;
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
        return Layer::where('parent_id', null)->where('course_id', $this->id)->get();
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'course_id', 'id');
    }

}