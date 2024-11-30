<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle the login request.
     */
    public function login(Request $request)
    {
        // Validate login credentials
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Check if the "remember me" checkbox is selected
        $remember = $request->boolean('remember');

        // Attempt login with credentials
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Redirect based on user role
            switch (Auth::user()->role) {
                case 'admin':
                    return redirect()->route('admin')->with('message', 'Welcome Admin!');
                case 'doctor':
                    return redirect()->route('doctor')->with('message', 'Welcome Doctor!');
                case 'patient':
                    return redirect()->route('home')->with('message', 'Welcome Patient!');
                default:
                    Auth::logout();
                    return redirect('/')->withErrors(['role' => 'Invalid user role. Please contact support.']);
            }
        }

        // If login fails, return a generic error message
        return back()->withErrors([
            'email' => 'Invalid login credentials. Please try again.',
        ]);
    }

    /**
     * Handle logout request.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out successfully.');
    }
}
