<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GuestGateway
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Require verification if missing
        if (!session('recaptcha_verified')) {
            // Keep intended url if using standard intended workflow or just store in session if needed
            return redirect()->route('gateway.index');
        }

        return $next($request);
    }
}
