<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    // Display User Profile.
    public function showProfile()
    {
        $user = Auth::user();

        return view('auth.profile', compact('user'));
    }

    // Update User Profile.
    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'profile_pic' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        /** @var User $user */
        $user = Auth::user();

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if ($request->hasFile('profile_pic'))
        {
            if ($user->profile_pic)
            {
                $oldProfilePicPath = public_path($user->profile_pic);

                if (file_exists($oldProfilePicPath))
                {
                    unlink($oldProfilePicPath);
                }
            }

            $profilePic = $request->file('profile_pic');
            $profilePicName = time() . '_' . $profilePic->getClientOriginalName();

            $profilePic->move(public_path('images/profile'), $profilePicName);

            $user->profile_pic = 'images/profile/' . $profilePicName;
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile Updated Successfully.');
    }
}