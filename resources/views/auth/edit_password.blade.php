@extends('layouts.app')

@section('title', 'Edit Password - Password Manager & Generator')

@section('page-title', 'Edit Password')

@section('content')

<style>
    /* Form */
    .form-container {
        max-width: 550px;
        margin: 0 auto;
    }

    .form-card {
        background-color: white;
        padding: 30px;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 3px 12px rgba(36, 59, 95, 0.06);
    }

    .form-card h1 {
        text-align: center;
        color: #243b5f;
        font-size: 26px;
        margin: 0 0 25px;
    }

    .logo-section {
        text-align: center;
        margin-bottom: 15px;
    }

    .logo-section img {
        width: 70px;
        height: 70px;
        object-fit: contain;
    }

    /* Form Styling */
    .form-group {
        margin-bottom: 18px;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 7px;
        color: #243b5f;
    }

    input,
    select {
        width: 100%;
        padding: 12px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 14px;
        outline: none;
    }

    input:focus,
    select:focus {
        border-color: #325481;
        box-shadow: 0 0 5px rgba(50, 84, 129, 0.2);
    }

    /* Show or Hide Button */
    .password-wrapper {
        position: relative;
    }

    .password-wrapper input {
        padding-right: 70px;
    }

    .password-wrapper button {
        position: absolute;
        right: 8px;
        top: 50%;
        transform: translateY(-50%);
        padding: 5px 8px;
        border: none;
        background-color: transparent;
        color: #325481;
        font-weight: bold;
        cursor: pointer;
    }

    /* Update Button */
    .update-btn {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 6px;
        background-color: #569c54;
        color: white;
        font-size: 15px;
        font-weight: bold;
        cursor: pointer;
        margin-top: 8px;
    }

    .update-btn:hover {
        background-color: #478746;
    }

    /* Error Message */
    .error {
        background-color: #fdecec;
        color: #b42318;
        padding: 12px 20px;
        margin-bottom: 20px;
        border: 1px solid #f5b5b0;
        border-radius: 6px;
        font-weight: bold;
    }

    .error ul {
        margin: 0;
        padding-left: 20px;
    }

    /* Back Link */
    .back-link {
        display: block;
        text-align: center;
        margin-top: 20px;
        color: #325481;
        text-decoration: none;
        font-size: 14px;
    }

    .back-link:hover {
        color: #243b5f;
        text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 500px) {
        .form-card {
            padding: 22px;
        }
    }
</style>

<div class="form-container">
    <div class="form-card">

        <!-- Logo -->
        <div class="logo-section">
            <img src="/images/edit_password.png" alt="Edit Password Icon">
        </div>

        <h1>Edit Password</h1>

        <!-- Validation Errors -->
        @if($errors->any())
        <div class="error">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('passwords.update', $password->_id) }}">
            @csrf
            @method('PUT')

            <!-- Website -->
            <div class="form-group">
                <label for="website">Website / Account</label>
                <input type="text" id="website" name="website" value="{{ $password->website }}" placeholder="Enter Website Name" required>
            </div>

            <!-- Username -->
            <div class="form-group">
                <label for="username">Username / Email</label>
                <input type="text" id="username" name="username" value="{{ $password->username }}" placeholder="Enter Username" required>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">New Password</label>
                <div class="password-wrapper">
                    <input type="password" name="password" id="password" placeholder="Enter New Password" required>
                    <button type="button" onclick="toggleInputPassword(this)">Show</button>
                </div>
            </div>

            <!-- Category -->
            <div class="form-group">
                <label for="category">Select Category</label>
                <select id="category" name="category" required>
                    <option value="">Select Category</option>

                    @foreach($categories as $category)
                        <option value="{{ $category->name }}"
                            {{ old('category', $password->category) == $category->name ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="update-btn">Update Password</button>

        </form>

        <a href="{{ route('passwords.index') }}" class="back-link">Back to Saved Passwords</a>
    </div>
</div>

<script>
    function toggleInputPassword(btn) {
        let pwdInput = document.getElementById('password');

        if (pwdInput.type === 'password') {
            pwdInput.type = 'text';
            btn.innerText = 'Hide';
        } else {
            pwdInput.type = 'password';
            btn.innerText = 'Show';
        }
    }
</script>

@endsection