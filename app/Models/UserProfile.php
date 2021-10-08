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
        'reminder_phone',
        'reminder_email',
        'user_id',
        'tutor_match',
        'learning_style',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

//    public function setLearningStyleResult($result)
//    {
//        $result = ceil($result);
//        if ($result == 3) {
//            $this->set('Tactile');
//        } else if ($result == 2) {
//            $this->setLearningStyle('Visual');
//        } else {
//            $this->setLearningStyle('Auditory');
//        }
//    }

    public function setLearningStyleAttribute($value)
    {
        $value = ceil($value);
        if ($value == 3) {
            $this->attributes['learning_style'] = 'Tactile';
        } else if ($value == 2) {
            $this->attributes['learning_style'] = 'Visual';
        } else {
            $this->attributes['learning_style'] = 'Auditory';
        }
        $this->save();
    }
}
