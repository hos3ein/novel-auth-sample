<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class ProfileComplete
{
    public function handle(Request $request, $next)
    {
        if(is_null($request->user()->name) or is_null($request->user()->family))
            return redirect()->route('profile')->with('status', __('Please complete your profile'));
        return $next($request);
    }
}
