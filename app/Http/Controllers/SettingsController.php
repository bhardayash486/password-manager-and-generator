<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Password;
use App\Models\Category;

class SettingsController extends Controller
{
    // Display Settings Page.
    public function showSettings()
    {
        $user = Auth::user();

        return view('auth.settings', compact('user'));
    }

    // Change Password.
    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        /** @var User $user */
        $user = Auth::user();

        // Verify the current password.
        if(!Hash::check($validated['current_password'], $user->password))
        {
            return back()->withErrors([
                'current_password' => 'Current password is incorrect.',
            ])->withInput();
        }

        $user->password = $validated['password'];
        $user->save();

        return redirect()->route('settings')->with('success', 'Password Changed Successfully.');
    }

    // Delete User Account.
    public function deleteAccount(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        // Delete user's saved passwords.
        Password::where('user_id', $user->id)->delete();

        // Delete user's categories.
        Category::where('user_id', $user->id)->delete();

        // Delete user's profile picture.
        if($user->profile_pic)
        {
            $profilePicPath = public_path($user->profile_pic);

            if(file_exists($profilePicPath))
            {
                unlink($profilePicPath);
            }
        }

        // Delete user account.
        $user->delete();

        // Logout the deleted user.
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Account Deleted Successfully.');
    }
}