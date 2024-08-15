<?php

namespace App\Http\Middleware;

use App\Models\StockManagement\Order;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckOrderCreation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $order = $request->route('order');
        if ($order->created == 1) {
            return redirect()->route('orders.index')->with('error', 'Update is not allowed for this order.');
        }
        return $next($request);
    }
}
