@extends('layouts.app')

@section('title', 'Profile - Password Manager & Generator')

@section('page-title', 'Profile')

@section('content')

<style>
    .profile-container {
        max-width: 700px;
        margin: 0 auto;
    }

    .profile-header {
        margin-bottom: 25px;
    }

    .profile-header h1 {
        margin: 0 0 8px;
        color: #243b5f;
        font-size: 28px;
    }

    .profile-header p {
        margin: 0;
        color: #5f6b76;
        font-size: 14px;
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

    .profile-card {
        background-color: white;
        padding: 30px;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 3px 12px rgba(15, 39, 71, 0.06);
    }

    .profile-icon {
        width: 100px;
        height: 100px;
        margin: 0 auto 25px;
        background-color: #eef5f8;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .profile-icon img {
        width: 70px;
        height: 70px;
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

    @media (max-width: 700px) {
        .profile-card {
            padding: 22px;
        }

        .profile-header h1 {
            font-size: 24px;
        }
    }
</style>

<div class="profile-container">
    <div class="profile-header">
        <h1> My Profile </h1>
        <p> Manage your account information. </p>
    </div>

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

    <div class="profile-card">

        <div class="profile-icon">
            <img src="{{ $user->profile_pic ? asset($user->profile_pic) : asset('images/user.png') }}" alt="User Icon"
            onerror="this.onerror=null; this.src='{{ asset('images/user.png') }}';">
        </div>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="form-group">
                <label for="name">Name</label>

                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>

                @error('name')
                    <div class="field-error"> {{ $message }} </div>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>

                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>

                @error('email')
                    <div class="field-error"> {{ $message }} </div>
                @enderror
            </div>

            <!-- Profile Picture -->
            <div class="form-group">
                <label for="profile_pic">Add Profile Picture</label>

                <input type="file" id="profile_pic" name="profile_pic">

                @error('profile_pic')
                    <div class="field-error"> {{ $message }} </div>
                @enderror
            </div>

            <button type="submit" class="update-btn"> Update Profile </button>
        </form>
    </div>
</div>

@endsection