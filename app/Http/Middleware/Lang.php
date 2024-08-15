<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class Lang
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $local = $request->session()->get('locale', config('app.locale'));
        if ($local != app()->getLocale()) {
            app()->setLocale($local);
        }
        View::share('lang', \App\Enums\Lang::tryFrom($local));
        View::composer('*', function (\Illuminate\View\View $view) {
            if (!isset($view->getData()['langs'])) {
                $view->with('langs', \App\Enums\Lang::cases());
            }
        });
        return $next($request);
    }
}
