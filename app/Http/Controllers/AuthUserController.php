<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthUserController extends Controller
{
    public function login(Request $request)
    {
       $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:5'
      ]);

      if (Auth::attempt($request->only('email', 'password'))) {
        return redirect()->intended(route('dashboard'));
      }else{
        return back()->with('error', 'Incorrect user details');
      }
    }
}
