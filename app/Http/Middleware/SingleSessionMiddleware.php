<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SingleSessionMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $currentSessionId = Session::getId();
            // Buscar otra sesión activa para el usuario
            $otherSession = DB::table('sessions')
                ->where('user_id', $userId)
                ->where('id', '!=', $currentSessionId)
                ->where('last_activity', '>', now()->subMinutes(config('session.lifetime'))->getTimestamp())
                ->first();
            if ($otherSession) {
                Auth::logout();
                Session::invalidate();
                Session::regenerateToken();
                if ($request->expectsJson()) {
                    return response()->json([
                        'message' => 'Tu sesión fue cerrada porque iniciaste sesión en otro dispositivo.'
                    ], 401);
                }
                return redirect('/login')->withErrors(['multi_session' => 'Tu sesión fue cerrada porque iniciaste sesión en otro dispositivo.']);
            }
        }
        return $next($request);
    }
} 