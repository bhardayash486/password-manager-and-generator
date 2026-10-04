<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Password;
use App\Models\Category;

class PasswordController extends Controller
{
    // Displays Saved Passwords.
    public function showStoredPassword(Request $request)
    {
        // Search Password.
        $search = $request->search;

        $passwords = Password::where('user_id', Auth::id())
            ->when($search, function ($query) use ($search) //When User Search.
            {
                $query->where(function ($query) use ($search) {
                    $query->whereLike('website', '%' . $search . '%')
                        ->orWhereLike('username', '%' . $search . '%'); //Finds website or username.
                });
            })->get()->sortByDesc('created_at')->values();

        // Pagination settings.
        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $passwords->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $passwords = new LengthAwarePaginator(
            $currentItems,
            $passwords->count(),
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        return view('auth.passwords', compact('passwords'));
    }

    // Reveal Password.
    public function revealPassword($id)
    {
        $password = Password::where('user_id', Auth::id())
            ->where('_id', $id)->firstOrFail();

        $decryptedPassword = Crypt::decryptString($password->password);

        return response()->json([
            'password' => $decryptedPassword,
        ])->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')->header('Pragma', 'no-cache');
    }

    // Stores User Credentials in DB.
    public function storePassword(Request $request)
    {
        $validated = $request->validate([
            'website' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string',
            'category' => [
                'required',
                'string',
                function ($attribute, $value, $fail)
                {
                    $exists = Category::where('user_id', Auth::id())->where('name', $value)->exists();

                    if(!$exists)
                    {
                        $fail('The selected category is invalid.');
                    }
                }
            ],
            'generated' => 'nullable|boolean',
        ]);

        Password::create([
            'user_id' => Auth::id(),
            'website' => $validated['website'],
            'username' => $validated['username'],
            'password' => Crypt::encryptString($validated['password']), //Encrypt password before storing.
            'password_length' => strlen($validated['password']),
            'category' => $validated['category'],
            'generated' => $request->boolean('generated'),
        ]);

        return redirect('/add_password')->with('success', 'Password Saved Successfully.');
    }

    // Display Edit Password Form.
    public function editPassword($id)
    {
        $password = Password::where('user_id', Auth::id())->where('_id', $id)->firstOrFail();

        $categories = Category::where('user_id', Auth::id())->orderBy('name')->get();

        return view('auth.edit_password', compact('password', 'categories'));
    }

    // Update Saved Password.
    public function updatePassword(Request $request, $id)
    {
        $validated = $request->validate([
            'website' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string',
            'category' => [
                'required',
                'string',
                function ($attribute, $value, $fail)
                {
                    $exists = Category::where('user_id', Auth::id())->where('name', $value)->exists();

                    if(!$exists)
                    {
                        $fail('The selected category is invalid.');
                    }
                }
            ],
        ]);

        $password = Password::where('user_id', Auth::id())->where('_id', $id)->firstOrFail();

        $password->update([
            'website' => $validated['website'],
            'username' => $validated['username'],
            'password' => Crypt::encryptString($validated['password']),
            'password_length' => strlen($validated['password']),
            'category' => $validated['category'],
        ]);

        return redirect('/passwords')->with('success', 'Password Updated Successfully.');
    }

    // Delete Saved Password.
    public function deletePassword($id)
    {
        $password = Password::where('user_id', Auth::id())->where('_id', $id)->firstOrFail();
        $password->delete();
        return redirect('/passwords')->with('success', 'Password Deleted Successfully.');
    }

    // Display Add Password Form.
    public function showAddPassword()
    {
        $categories = Category::where('user_id', Auth::id())->orderBy('name')->get();
        return view('auth.add_password', compact('categories'));
    }
}