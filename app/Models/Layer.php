<?php

namespace App\Models;

use App\Scopes\LayerScope;
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

    protected static function booted()
    {
        static::addGlobalScope(new LayerScope);
    }

    public function children()
    {
        return $this->hasMany(Layer::class, 'parent_id');
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

    public function setEasy()
    {
        $tag = Tag::where('name', 'easy')->first();
        $this->tags()->save($tag);
    }

    public function setMedium()
    {
        $tag = Tag::where('name', 'medium')->first();
        $this->tags()->save($tag);
    }

    public function setHard()
    {
        $tag = Tag::where('name', 'hard')->first();
        $this->tags()->save($tag);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function studentQuestions()
    {
        return $this->hasMany(StudentLayerQuestion::class);
    }
}
