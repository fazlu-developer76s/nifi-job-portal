<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckBlogSegment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->segment(1).'/'.$request->segment(2) === 'admin/blog'){
            return redirect('/404');
        }
        if ($request->segment(1) === 'blog') {
            return redirect('/404');
        }

        return $next($request);
    }
}

