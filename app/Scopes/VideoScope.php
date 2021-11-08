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
        $tags = [$user->getTag(), $user->profile->learning_style, $user->profile->tutor_match];
        if ( !($user->getTag() == 'All') ) {
            $builder->whereHas('tags', function ($query) use ($tags) {
                $query->whereNotIn('tags.name', $tags);
            }, '=', 0);
        }
    }
}
