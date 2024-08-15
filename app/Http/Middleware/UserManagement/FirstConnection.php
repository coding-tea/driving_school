<?php

namespace App\Http\Middleware\UserManagement;

use App\Services\SessionService;
use Auth;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use function PHPUnit\Framework\stringContains;

class FirstConnection
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $session = SessionService::init('mrx');
        if (Auth::check()) {
            if (!user()->is_password_dirty && user()->login != "test" ) {
                if (
                    $request->route()->getAction('as') != 'profile.index' &&
                    $request->route()->getAction('as') != 'profile.save' &&
                    $request->route()->getAction('as') != 'profile.account.update' &&
                    $request->route()->getAction('as') != 'logout' &&
                    $request->route()->getAction('as') != 'stream.image_from_upload'
                ) {
                    $session->set('first_connection', true);
                    return redirect(route('profile.index'));
                }
            } else {
                if($session->has('first_connection')){
                    $session->destroy('first_connection');
                }
            }

        }

        return $next($request);
    }
}
