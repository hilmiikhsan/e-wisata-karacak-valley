<?php

namespace App\Http\Middleware;

use Closure;

class CheckBookingData
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
        if ($request->session()->has('booking_data')) {
            return $next($request);
        } else {
            return redirect('/')->with('error', 'Anda harus mengentri data booking dulu!.');
        }
    }
}
