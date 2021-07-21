<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Locale
{
    public function handle(Request $request, $next)
    {
        $default = Session::get('locale', config('app.locale'));
        $queryLocale = $request->query('locale', $default);
        $locale = in_array($queryLocale, ['en', 'fa']) ? $queryLocale : $default;
        App::setLocale($locale);
        return $next($request);
    }
}
