<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    ];

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
        parent::boot();
        self::created(function ($model) {
            $model->setEasy();
        });
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'user_id', 'id');
    }
}
