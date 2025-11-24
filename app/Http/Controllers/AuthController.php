<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm() 
    {
        return view('login');
    }

    public function login(Request $request) 
    {   
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email','password');

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'message' => 'Invalid credentials.',
            ]);
        }

        $request->session()->regenerate();
        return redirect()->intended('/'); 
    }

    public function logout(Request $request)

    {

        Auth::logout();

 

        // Invalidate session

        $request->session()->invalidate();

        $request->session()->regenerateToken();

 

        return redirect('/login')->with('success', 'You have been logged out.');

    }
}
