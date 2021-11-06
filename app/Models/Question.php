<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'explanation',
        'questionable_id',
        'questionable_type',
    ];

    public function questionable()
    {
        return $this->morphTo();
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function tags()
    {
        return $this->morphTo(Tag::class, 'taggable');
    }

    public function setEasy()
    {
        $tag = Tag::where('name', 'Easy')->first();
        $this->tags()->save($tag);
    }

    public function setMedium()
    {
        $tag = Tag::where('name', 'Medium')->first();
        $this->tags()->save($tag);
    }

    public function setHard()
    {
        $tag = Tag::save('name', 'Hard')->first();
        $this->tags()->attach($tag);
    }

    public function setTag($tag_data)
    {
        $tag = Tag::where('name', $tag_data)->first();
        $this->tags()->attach($tag);
    }
}
