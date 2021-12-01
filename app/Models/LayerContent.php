<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayerContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'link',
        'layer_id'
    ];

    public function layer()
    {
        return $this->belongsTo(Layer::class);
    }
}
