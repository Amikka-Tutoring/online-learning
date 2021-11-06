<?php

namespace App\Scopes;

use App\Models\Video;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class TagScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
//        $user = \Auth::user();
//        $user_tags = [$user->tutor_match, $user->learning_style, $user->tags->pluck('name')];
//        $builder->join('taggables', 'id', '=', 'taggables.taggable_id')
//            ->join('tags', 'taggables.tag_id', '=', 'tags.id')
//            ->whereIn('tags.id', $user_tags);

//        $builder->whereHasMorph('tags', 'App\Models\Video', function ($query) use ($user_tags) {
//            $query->pluck('name');
//        });
//        $builder->joinWhere('taggables', 'id', '=', 'taggables.taggable_id');
//        $builder->with('tags');
    }
}
