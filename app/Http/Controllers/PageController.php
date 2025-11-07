<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
      public function redirectLogin()
    {
        return redirect()->route('login');
    }

    public function redirectHome()
    {
        return redirect()->route('app.home');
    }

    public function user()
    {
        return view('pages.user');
    }

    public function profile()
    {
        return view('pages.profile');
    }

    public function changePassword()
    {
        return view('pages.change-password');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
