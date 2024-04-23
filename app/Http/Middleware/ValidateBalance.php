<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateBalance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(session('memberBalance') != '' && session('memberBalance') > 0 && (date('m') > 3)) {
            return redirect('/paymentgateway/'.session('memberBalance'))->with('info', 'You are required to clear your balance of Ksh '.session('memberBalance').' before accessing other services. For more information navigate to the Financials section.');
        }
        return $next($request);
    }
}