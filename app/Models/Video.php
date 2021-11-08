<?php

namespace App\Models;

use App\Scopes\TagScope;
use App\Scopes\VideoScope;
use Dflydev\DotAccessData\Data;
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
        'duration'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new VideoScope);
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
        $tag = Tag::where('name', $tag_data)->first();
        $this->tags()->attach($tag);
    }

    public static function getFiltered()
    {
        $user = auth()->user()->load('profile', 'tags');
        $tags = [$user->getTag(), $user->profile->learning_style, $user->profile->tutor_match];
        $videos = Video::with('tags')->get();
        if (!($user->getTag() == 'All')) {
            $videos->each(function ($item, $key) use ($videos, $tags) {
                $video_tags = $item->tags->pluck('name');
                if (!($video_tags->diff($tags)->isEmpty()) && !in_array($video_tags, ['All'])) {
                    $videos->forget($key);
                }
            });
        }
        return $videos;
    }
}
