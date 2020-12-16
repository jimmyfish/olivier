<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LoginAction extends Controller
{
    public function __invoke()
    {
        return view('login');
    }

    public function post(Request $request)
    {
        $user = User::where([
            'email' => $request->get('email'),
            'password' => md5($request->get('password'))
        ])->first();

        if (!$user) {
            $request->session()->flash('email', 'Email or password wether not found or wrong');
            return view('login');
        }

        $loggedUser = collect(Cache::get('loggedUser'));

        if (!$loggedUser->contains('ips', $request->ip())) {
            $loggedUser->add([
                'ips' => $request->ip(),
                'email' => $request->get('email'),
            ]);
        }

        Cache::put('loggedUser', $loggedUser);

        return response()->redirectToRoute('home');
    }
}
