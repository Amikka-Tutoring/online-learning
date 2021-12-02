<?php

namespace App\Models;

use App\Scopes\TagScope;
use App\Scopes\VideoScope;
use Dflydev\DotAccessData\Data;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'description',
        'layer_id',
        'duration'
    ];

    protected $appends = ['viewed'];

    protected static function booted()
    {
        static::addGlobalScope(new VideoScope);
    }

    public function layer()
    {
        return $this->belongsTo(Layer::class);
    }

    public function user_viewed_videos()
    {
        return $this->belongsToMany(User::class, 'user_viewed_videos')->where('user_id', auth()->user()->id);
    }

    public function getViewedAttribute()
    {
        if ( $this->user_viewed_videos->count() )
            return true;
        return false;
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function responses()
    {
        return $this->hasMany(VideoResponse::class);
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
        $tag = Tag::where('name', ucfirst($tag_data))->first();
        $this->tags()->attach($tag);
    }
}
