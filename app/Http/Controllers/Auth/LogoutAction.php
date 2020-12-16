<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class LogoutAction extends Controller
{
    public function __invoke()
    {
        Auth::logout();

        $logged = collect(Cache::get('loggedUser'));

        $logged = $logged->whereNotIn('ips', request()->ip());

        Cache::put('loggedUser', $logged);

        return response()->redirectToRoute('login');
    }
}
