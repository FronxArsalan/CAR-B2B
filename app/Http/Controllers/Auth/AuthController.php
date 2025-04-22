<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // login
    public function login()
    {
        // check user is logged in
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        $data['header_title'] = 'Login';
        return view('auth.login', $data);
    }
    // loginProcess
    public function loginProcess(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'Login successful');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }
    // logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout successful');
    }
}
