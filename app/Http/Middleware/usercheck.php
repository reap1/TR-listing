<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class usercheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
       
        if(!session()->has('LoggedUser') && $request->path() != '/'){
            return redirect('/')->with('Lmessage', 'Please Sign In to Continue!');
        
        }
        if(session()->has('LoggedUser') && $request->path() == '/'){
            return redirect('/home')->with('Lmessage', 'Please Log Out to Continue!');
        }
        return $next($request);
    }

}