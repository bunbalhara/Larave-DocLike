<?php

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Set config translatable.locales
        app()->setLocale(session()->get('locale', config('app.locale')));
        return $next($request);
    }
}
