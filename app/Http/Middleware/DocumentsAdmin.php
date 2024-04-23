<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DocumentsAdmin
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
        if (session('isDocumentsAdmin') == false or session('isDocumentsAdmin') == null) {
            return redirect()->back()->with('error', 'Only document admins can access this section.');
        }
        return $next($request);
    }
}