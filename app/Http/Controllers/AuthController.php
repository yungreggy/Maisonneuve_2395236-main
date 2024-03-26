<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function create()
    {
        return view('auth.create'); 
    }

    /**
     * Handle login attempt.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email', 
            'password' => 'required|min:6|max:20' 
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['login_error' => trans('auth.failed')])
                         ->withInput($request->except('password')); 
        }

        // Utilisateur authentifié, rediriger vers la page d'accueil ou la page souhaitée
        return redirect()->intended(route('home'))->with('success', 'Connected');
    }

    /**
     * Handle logout.
     */
    public function destroy()
    {
        Auth::logout();
        Session::flush(); 
        return redirect(route('login'))->with('success', 'Disconnected');
    }

 
}
