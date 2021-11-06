<?php

namespace App\Models;

use App\Scopes\TagScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'description',
        'layer_id',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new TagScope);
    }


    public function layer()
    {
        return $this->belongsTo(Layer::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function setEasy()
    {
        $tag = Tag::where('name', 'Easy')->first();
        $this->tags()->save($tag);
    }

    public function setMedium()
    {
        $tag = Tag::where('name', 'Medium')->first();
        $this->tags()->attach($tag);
    }

    public function setHard()
    {
        $tag = Tag::where('name', 'Hard')->first();
        $this->tags()->attach($tag);
    }

    public function setTag($tag_data)
    {
        $tag = Tag::where('name', $tag_data)->first();
        $this->tags()->attach($tag);
    }

}
