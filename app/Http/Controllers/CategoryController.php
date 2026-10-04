<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Password;

class CategoryController extends Controller
{
    // Display user's categories.
    public function showCategory()
    {
        $categories = Category::where('user_id', Auth::id())->orderBy('name')->get();

        return view('auth.categories', compact('categories'));
    }

    // Stores Category in db.
    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
        ]);

        $exists = Category::where('user_id', Auth::id())->where('name', $validated['name'])->exists();

        if ($exists)
        {
            return back()->withErrors(['name' => 'This category already exists.',])->withInput();
        }

        Category::create([
            'user_id' => Auth::id(),
            'name' => $validated['name'],
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Category Added Successfully.');
    }

    // Update a Category.
    public function updateCategory(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
        ]);

        $category = Category::where('user_id', Auth::id())->where('_id', $id)->firstOrFail();

        // Checks category alredy exists or not.
        $exists = Category::where('user_id', Auth::id())->where('name', $validated['name'])
        ->where('_id', '!=', $id)->exists();

        if ($exists)
        {
            return back()->withErrors(['name' => 'This category already exists.',])->withInput();
        }

        // Rename Category.
        $oldName = $category->name;
        $newName = $validated['name'];

        $category->update([
            'name' => $newName,
        ]);

        // Find user's saved password using old categorry and change password to the new category.
        Password::where('user_id', Auth::id())->where('category', $oldName)
        ->update(['category' =>  $newName,]);

        return redirect()->route('categories.index')->with('success', 'Category Updated Successfully.');
    }

    // Delete Category.
    public function deleteCategory($id)
    {
        $category = Category::where('user_id', Auth::id())->where('_id', $id)->firstOrFail();

        $used = Password::where('user_id', Auth::id())->where('category', $category->name)->exists();
        if($used)
        {
            return back()->with('error', 'This category is being used by saved passwords.');
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category Deleted Successfully.');
    }
}