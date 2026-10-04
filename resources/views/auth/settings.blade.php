@extends('layouts.app')

@section('title', 'Settings - Password Manager & Generator')

@section('page-title', 'Settings')

@section('content')

<style>
    .settings-container {
        max-width: 700px;
        margin: 0 auto;
    }

    .settings-header {
        text-align: center;
        margin-bottom: 25px;
    }

    .settings-header h1 {
        margin: 0 0 8px;
        color: #243b5f;
        font-size: 28px;
    }

    .settings-header p {
        margin: 0;
        color: #5f6b76;
        font-size: 14px;
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

    .success-message {
        background-color: #e8f5e9;
        color: #237a36;
        border: 1px solid #b7dfbf;
        padding: 12px 18px;
        margin-bottom: 20px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: bold;
    }

    .error-message {
        background-color: #fdecec;
        color: #b42318;
        border: 1px solid #f5b5b0;
        padding: 12px 18px;
        margin-bottom: 20px;
        border-radius: 8px;
        font-size: 14px;
    }

    .settings-card {
        background-color: white;
        padding: 30px;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 3px 12px rgba(15, 39, 71, 0.06);
    }

    .settings-icon {
        width: 75px;
        height: 75px;
        margin: 0 auto 25px;
        background-color: #eef5f8;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .settings-icon img {
        width: 50px;
        height: 50px;
        object-fit: contain;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #243b5f;
        font-size: 14px;
        font-weight: bold;
    }

    .form-group input {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        font-size: 14px;
        outline: none;
        transition: 0.2s;
    }

    .form-group input:focus {
        border-color: #325481;
        box-shadow: 0 0 0 3px rgba(50, 84, 129, 0.1);
    }

    .field-error {
        margin-top: 6px;
        color: #dc3545;
        font-size: 13px;
    }

    .update-btn {
        width: 100%;
        border: none;
        background-color: #569c54;
        color: white;
        padding: 12px;
        border-radius: 7px;
        cursor: pointer;
        font-size: 14px;
        font-weight: bold;
    }

    .update-btn:hover {
        background-color: #478746;
    }

    .delete-btn {
        width: 100%;
        border: none;
        background-color: #dc3545;
        color: white;
        padding: 12px;
        border-radius: 7px;
        cursor: pointer;
        font-size: 14px;
        font-weight: bold;
    }

    .delete-btn:hover {
        background-color: #bb2d3b;
    }

    @media (max-width: 700px) {
        .settings-card {
            padding: 22px;
        }

        .settings-header h1 {
            font-size: 24px;
        }
    }
</style>

<div class="settings-container">

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="error-message">
            Please correct the following errors:
        </div>
    @endif

    <div class="settings-card">

        <div class="settings-header">
            <div class="logo-section">
                <img src="/images/settings.png" alt="Settings Icon">
            </div>

            <h1> Change Password </h1>
            <p> Update your account password securely. </p>
        </div>

        <form method="POST" action="{{ route('setting.password') }}">
            @csrf
            @method('PUT')

            <!-- Current Password -->
            <div class="form-group">
                <label for="current_password">Current Password</label>

                <input type="password" id="current_password" name="current_password" required>

                @error('current_password')
                    <div class="field-error"> {{ $message }} </div>
                @enderror
            </div>

            <!-- New Password -->
            <div class="form-group">
                <label for="password">New Password</label>

                <input type="password" id="password" name="password" required>

                @error('password')
                <div class="field-error"> {{ $message }} </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>

                <input type="password" id="password_confirmation" name="password_confirmation" required>

                @error('password_confirmation')
                <div class="field-error"> {{ $message }} </div>
                @enderror
            </div>

            <button type="submit" class="update-btn"> Change Password </button>

        </form>

        <hr>
        <div class="form-group">
            <label>Delete Account</label>

            <p style="color: #5f6b76; font-size: 14px; margin-bottom: 15px;">
                Deleting your account will permanently remove your account and all saved passwords.
                This action cannot be undone.
            </p>

            <form method="POST" action="{{ route('setting.delete') }}"
            onsubmit="return confirm('Are you sure you want to permanently delete your account? This action cannot be undone.');">
                @csrf
                @method('DELETE')

                <button type="submit" class="delete-btn"> Delete Account </button>
            </form>
        </div>
    </div>
</div>

@endsection