<?php

namespace App\Http\Middleware;

use App\Models\Video;
use Closure;
use Illuminate\Http\Request;

class TagLevelMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $enrolled_courses = auth()->user()->enrollments->pluck('course.id');

        $watched = auth()->user()->viewed_videos->pluck('id');
        $videos = Video::whereNotIn('id', $watched)->whereHas('layer', function ($q) use ($enrolled_courses) {
            $q->whereIn('course_id', $enrolled_courses);
        })->get();

        if ( $videos->count() ) {
            return $next($request);
        } else if ( auth()->user()->getTag() != 'All' && $watched->count() > 0 ) {
            switch ( auth()->user()->getTag() ) {
                case 'Easy':
                    auth()->user()->setTag('Medium');
                    break;
                case 'Medium':
                    auth()->user()->setTag('Hard');
                    break;
                case 'Hard':
                    auth()->user()->setTag('Expert');
                    break;
                case 'Expert':
                    auth()->user()->setTag('All');
                    break;
            }
            return redirect()->route('dashboard')->with('cup', 'Congrats you passed a level');
        } else {
            return $next($request);
        }
    }
}
