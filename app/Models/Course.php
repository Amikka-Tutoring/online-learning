<?php

namespace App\Models;

use App\Http\Controllers\UserController;
use App\Scopes\LayerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Subscription;
use Stripe\Plan;
use Stripe\Stripe;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'plan_id'
    ];
    protected $appends = ['quizzes_count', 'quizzes_attempted'];

    public static function boot()
    {
        parent::boot();
        self::created(function ($model) {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $plan = Plan::create([
                "amount" => substr($model->name, 0, 3) === "SAT" ? "1000" : "3000",
                "interval" => "month",
                "product" => [
                    "name" => $model->name
                ],
                "currency" => "USD",
            ]);
            $model->plan_id = $plan->id;
            $model->save();
        });
    }


    public function layers()
    {
        return $this->hasMany(Layer::class);
    }

    public function topLayers()
    {
        return Layer::withoutGlobalScope(LayerScope::class)->whereNull('parent_id')->where('course_id', $this->id)->get();
    }

    public function enrollments()
    {
        return $this->hasMany(Subscription::class, 'stripe_price', 'plan_id');
    }


    public function getQuizzesCountAttribute()
    {
        $quizzes_count = 0;
        foreach ($this->topLayers() as $topLayer) {
            if ( count($topLayer->questions) ) {
                $quizzes_count++;
            }
            foreach ($topLayer->children as $mid) {
                if ( count($mid->questions) ) {
                    $quizzes_count++;
                }
                foreach ($mid->children as $less) {
                    if ( count($less->questions) ) {
                        $quizzes_count++;
                    }
                }
            }
        }
        return $quizzes_count;
    }

    public function getQuizzesAttemptedAttribute()
    {
        $user = Auth::user();
        $quizzes_count = 0;
        foreach ($this->topLayers() as $topLayer) {
            foreach ($user->layer_quiz_results as $r) {
                if ( $r->layer == $topLayer ) {
                    $quizzes_count++;
                }
            }
            foreach ($topLayer->children as $mid) {
                foreach ($user->layer_quiz_results as $t) {
                    if ( $t->layer == $mid ) {
                        $quizzes_count++;
                    }
                }
                foreach ($mid->children as $less) {
                    foreach ($user->layer_quiz_results as $e) {
                        if ( $e->layer == $less ) {
                            $quizzes_count++;
                        }
                    }
                }
            }
        }
        return $quizzes_count;
    }

}
