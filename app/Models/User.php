<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Billable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Stripe\Subscription;
use function Illuminate\Events\queueable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'attempted_quiz'
    ];

    protected static function booted()
    {
//        static::updated(queueable(function ($customer) {
//            $customer->syncStripeCustomerDetails();
//        }));
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function setEasy()
    {
        $tag = Tag::where('name', 'Easy')->first();
        $this->tags()->sync($tag);
    }

    public function setMedium()
    {
        $tag = Tag::where('name', 'Medium')->first();
        $this->tags()->sync($tag);
    }

    public function setHard()
    {
        $tag = Tag::where('name', 'Hard')->first();
        $this->tags()->sync($tag);
    }

    public function getTag()
    {
        return $this->tags->last()->name;
    }


    public static function boot()
    {
        static::updated(queueable(function ($customer) {
            $customer->syncStripeCustomerDetails();
        }));
        parent::boot();
        self::created(function ($model) {
            $model->setEasy();
        });
        self::deleting(function ($model) {
            foreach ($model->subscriptions as $subscription) {
                $subscription->cancel();
            }
        });
    }

    public function enrollments()
    {
        return $this->hasMany(\App\Models\Subscription::class, 'user_id', 'id')->whereIn('stripe_status', ['active', 'trialing']);
    }

    public function exams_visited()
    {
        return $this->hasMany(UserExamVisit::class, 'user_id', 'id');
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function layer_quiz_results()
    {
        return $this->hasMany(LayerQuizResult::class);
    }

    public function getAttemptedQuizAttribute($id)
    {
        return count($this->layer_quiz_results->where('layer_id', $id));
    }

    public function lesson_dates()
    {
        return $this->hasMany(UserLessonDate::class);
    }

    public function practice_exam_dates()
    {
        return $this->hasMany(UserPracticeExamDate::class, 'user_id', 'id')->orderBy('date_time');
    }

}
