<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class MainUserController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
