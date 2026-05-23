<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginSubmit(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (!Auth::attempt($validated, remember: true)) {
            return back()->withInput()->withErrors(['login' => 'نام کاربری یا رمز عبور اشتباه است.']);
        }
        // TODO: Redirect to right place
        return redirect()->route('index');
    }

    public function register(Request $request)
    {
        return view('auth.register');
    }

    public function registerSubmit(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
            'firstname' => 'required|alpha',
            'lastname' => 'required|alpha',
            'phone' => 'required|numeric',
        ]);
        $user = User::create($validated);
        Auth::login($user);
        return redirect()->route('index');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('index');
    }
}
