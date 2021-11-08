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
        $tags = ['Medium', 'Auditory'];

        $builder->whereHas('tags', function ($query) {
            $query->where('tags.name', Auth::user()->tags->pluck('name')->last());
        });
        
        $videos = Video::with('tags')->get();
        $videos->each(function ($item, $key) use ($videos, $tags) {
            if (!($item->tags->pluck('name')->diff($tags)->isEmpty())) {
                $videos->forget($key);
            }
        });
    }
}
