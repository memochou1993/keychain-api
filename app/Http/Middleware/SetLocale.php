<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Carbon\Carbon;

class SetLocale
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
        $locale = $request->locale;

        if ($locale) {
            App::setLocale($locale);
            Carbon::setLocale($locale);
        }

        return $next($request);
    }
}
