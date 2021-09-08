<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id',
        'course_id'
    ];

    public function children()
    {
        return $this->hasMany(Layer::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Layer::class, 'parent_id');
    }

    public function questions()
    {
        return $this->morphMany(Question::class, 'questionable');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
