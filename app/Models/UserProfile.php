<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{

    protected $table = 'user_profile';
    use HasFactory;

    protected $fillable = [
        'desire_score',
        'exam_date',
        'days_available',
        'first_day_time',
        'second_day_time',
        'reminder_phone',
        'reminder_email',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
