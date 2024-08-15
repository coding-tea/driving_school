<?php

namespace App\Http\Middleware\UserManagement;

use Auth;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LastSeen
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::check()) {

            $user = user();

            if(!isset($user['last_seen'])){
                $user->update([
                    'last_seen' => now()->toDateTimeString()
                ]);
            }else{
                // 1-2 try to increase db queries using 10mn rule
                $from = Carbon::parse($user['last_seen']);
                $to = Carbon::parse(now()->toDateTimeString());

                if ($to->diffInMinutes($from) >= 1 ) {
                    $user->update([
                        'last_seen' => now()->toDateTimeString()
                    ]);
                }
            }

        }
        return $next($request);
    }
}
