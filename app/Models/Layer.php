<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Layer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id',
        'course_id'
    ];

    public function children()
    {
        return $this->hasMany(Layer::class, 'parent_id');
//        dd($this->tags()->first()->name);
//        dd(Auth::user()->tags()->first()->name == $this->tags()->first()->name);
    }

    public function parent()
    {
        return $this->belongsTo(Layer::class, 'parent_id');
    }

    public function questions()
    {
        return $this->morphMany(Question::class, 'questionable');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

}
