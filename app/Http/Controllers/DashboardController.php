<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Password;

class DashboardController extends Controller
{
    public function getPasswords()
    {
        // Get passwords current logged-in user.
        $passwords = Password::where('user_id', Auth::id())->get()->sortByDesc('created_at')->values();

        // Count total stored passwords.
        $totalPasswords = $passwords->count();

        // Count Categories.
        $totalCategories = $passwords->pluck('category')->filter()->unique()->count();

        // Count Generated Passwords.
        $generatedPasswords = $passwords->where('generated',true)->count();

        // Display the 5 most recent passwords.
        $recentPasswords = $passwords->take(5);

        return view('auth.dashboard', compact('totalPasswords', 'totalCategories', 'generatedPasswords', 'recentPasswords'));
    }
}