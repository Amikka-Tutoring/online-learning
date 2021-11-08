<?php

namespace App\Scopes;

use App\Models\Video;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class VideoScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    // protected const $user_tag = Auth::user()->tags->last();

    public function apply(Builder $builder, Model $model)
    {
        $user = auth()->user()->load('profile', 'tags');
        $tags = ['Medium', 'Auditory', 'ISTJ'];

        $builder->whereHas('tags', function ($query) use ($tags) {
            $query->whereNotIn('tags.name', $tags);
        }, '=', 0);
//
//
//        if (!($user->getTag() == 'All')) {
//            $video_tags = $video->tags->pluck('name');
//            if (!($video_tags->diff($tags)->isEmpty()) && !in_array($video_tags, ['All'])) {
//                return [];
//            }
//        }
//        return $video;
    }
}
