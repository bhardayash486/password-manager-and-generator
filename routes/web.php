<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;

// Display Welcome Page.
Route::get('/', function () {
    return view('auth.welcome');
});

// Registeration.
Route::get('/register', [AuthController::class, 'showRegister'])->name('register'); //Show Registration Form.
Route::post('/register', [AuthController::class, 'register']);

// Login.
Route::get('/login', [AuthController::class, 'showLogin'])->name('login'); //Show Login Form.
Route::post('/login', [AuthController::class, 'login']);

// Dashboard.
Route::get('/dashboard', [DashboardController::class, 'getPasswords'])->middleware('auth')->name('dashboard');

// Logout.
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Add Password.
Route::get('/add_password', [PasswordController::class, 'showAddPassword'])
->middleware('auth')->name('passwords.create');

Route::post('/passwords', [PasswordController::class, 'storePassword'])
->middleware('auth')->name('passwords.store');

Route::get('/passwords', [PasswordController::class, 'showStoredPassword'])
->middleware('auth')->name('passwords.index'); //Show Stored Password to User.

Route::post('passwords/{id}/reveal', [PasswordController::class, 'revealPassword'])
->middleware('auth')->name('passwords.reveal');

Route::get('/passwords/{id}/edit', [PasswordController::class, 'editPassword'])
->middleware('auth')->name('passwords.edit'); //Show Edit Password Form.

Route::put('/passwords/{id}', [PasswordController::class, 'updatePassword'])
->middleware('auth')->name('passwords.update'); //Update Password.

Route::delete('/passwords/{id}', [PasswordController::class, 'deletePassword'])
->middleware('auth')->name('passwords.delete'); //Delete Password.

// Password Generator.
Route::get('/password-generator', function () {
    return view('auth.password_generator');
})->middleware('auth')->name('passwords.generator');

// Category.
Route::get('/categories', [CategoryController::class, 'showCategory'])
->middleware('auth')->name('categories.index');

Route::post('/categories', [CategoryController::class, 'storeCategory'])
->middleware('auth')->name('categories.store');

Route::put('/categories/{id}', [CategoryController::class, 'updateCategory'])
->middleware('auth')->name('categories.update');

Route::delete('/categories/{id}', [CategoryController::class, 'deleteCategory'])
->middleware('auth')->name('categories.delete');

// Profile.
Route::get('/profile', [ProfileController::class, 'showProfile'])
->middleware('auth')->name('profile'); //Display Profile.

Route::put('/profile', [ProfileController::class, 'updateProfile'])
->middleware('auth')->name('profile.update');

// Settings.
Route::get('/settings', [SettingsController::class, 'showSettings'])
->middleware('auth')->name('settings');

Route::put('/settings/passwords', [SettingsController::class, 'changePassword'])
->middleware('auth')->name('setting.password');

Route::delete('/settings/account', [SettingsController::class, 'deleteAccount'])
->middleware('auth')->name('setting.delete');