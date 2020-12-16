<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CheckAuthCookieMiddleware
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
        if (!Cache::has('loggedUser')) Cache::put('loggedUser', []);

        $logged = collect(Cache::get('loggedUser'));

        if (!$logged->contains('ips', $request->ip())) {
            return response()->redirectToRoute('login');
        }

        $loggedIn = $logged->where('ips', $request->ip())->first();

        $user = User::where('email', $loggedIn['email'])->first();

        if (!$user) {
            return response()->redirectToRoute('login');
        }

        Auth::loginUsingId($user->id, TRUE);

        return $next($request);
    }
}
