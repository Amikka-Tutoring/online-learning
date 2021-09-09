<?php

namespace App\Models;

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


    public function layer()
    {
        return $this->belongsTo(Layer::class);
    }

    public function tags()
    {
        return $this->morphMany(Tag::class, 'taggable');
    }
}
