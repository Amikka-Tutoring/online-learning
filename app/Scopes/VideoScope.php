<?php

namespace App\Scopes;

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
        $builder->whereHas('tags', function ($query) {
            $query->where('tags.name', Auth::user()->tags->pluck('name')->last());
        });
    }
}
