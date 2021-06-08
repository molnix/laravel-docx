<?php

namespace App\Http\Middleware;

use Closure;
use App\Voting;

class CheckVoting
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Voting::find($request->id)!=null){
            return $next($request);
        }
        else{
            return redirect(route('profile_page'));
        }
    }
}
