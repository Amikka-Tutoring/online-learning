<?php

namespace App\Scopes;

use App\Models\Layer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class TagsScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $user = Auth::user();
//        $user->tags()->save($tag);
//        dd($user->tags->pluck('name'));
        $userTag = $user->tags->last();
        $userTag->layers->first()->$userTag->children->$userTag->children;
        $builder->whereHasMorph('taggable', [Layer::class,]);
    }
}
