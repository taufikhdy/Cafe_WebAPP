<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckMejaStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('meja')->check()) {
            $meja = Auth::guard('meja')->user();

            if ($meja->status === 'kosong' && $meja->username === null) {
                Auth::guard('meja')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('thankyou');
            }
        }

        return $next($request);
    }
}
