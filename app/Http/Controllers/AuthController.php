<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|max:255|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
    	    'email' => $validated['email'],
    	    'password' => $validated['password'],
        ]);
        return redirect('/register')->with('success', 'Registration Successful.');
    }

    public function showLogin()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        // Validate the login from input
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

	 // Get Email and Password.
        $email = $validated['email'];
        $password = $validated['password'];

        // Find the user using email address.
        $user = User::where('email',$email)->first();

        // Checks Email and Password.
        if($user && Hash::check($password, $user->password))
        {
            Auth::login($user);

            $request->session()->regenerate();

            return redirect('/dashboard')->with('success', 'Login Success. Welcome, '.Auth::user()->name.'.');
        }
        else
        {
            return redirect('/login')->with('error','Invalid Email or Password.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success','Logout Successfully.');
    }
}