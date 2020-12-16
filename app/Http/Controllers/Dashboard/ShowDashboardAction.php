<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowDashboardAction extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();
        $wallets = $user->wallets;

        return view('home', [
            'wallets' => $wallets,
        ]);
    }
}
