<?php

namespace App\Models;

use App\Scopes\LayerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayerQuizResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'layer_id',
        'score'
    ];

    public function layer()
    {
        return $this->belongsTo(Layer::class, 'layer_id')->withoutGlobalScope(LayerScope::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
