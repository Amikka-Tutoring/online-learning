<?php

namespace App\Models;

use App\Scopes\LayerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentLayerQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'video_id',
        'question_text'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function layer()
    {
        return $this->belongsTo(Layer::class, 'layer_id')->withoutGlobalScope(LayerScope::class);
    }
}
