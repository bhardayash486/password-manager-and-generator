@extends('layouts.app')

@section('title', 'Dashboard - Password Manager & Generator')

@section('page-title', 'Dashboard')

@section('content')

<style>
    /* Welcome */
    .welcome {
        margin-bottom: 30px;
    }

    .welcome h1 {
        margin: 0 0 8px;
        font-size: 28px;
        color: #243b5f;
    }

    .welcome p {
        margin: 0;
        font-size: 15px;
        color: #5f6b76;
    }

    /* Success Message */
    .success-message {
        background-color: #e8f5e9;
        color: #478746;
        border: 1px solid #b7dfbf;
        padding: 12px 18px;
        margin-bottom: 20px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: bold;
        box-shadow: 0 3px 10px rgba(36, 59, 95, 0.05);
    }

    /* Statistics */
    .stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background-color: white;
        padding: 22px;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 3px 12px rgba(36, 59, 95, 0.06);
    }

    .stat-card .icon {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: transparent;
        border-radius: 10px;
        font-size: 22px;
    }

    .stat-card img {
        width: 70px;
        height: 70px;
        object-fit: contain;
        flex-shrink: 0;
    }

    .stat-card h3 {
        margin: 15px 0 5px;
        font-size: 27px;
        color: #243b5f;
    }

    .stat-card p {
        margin: 0;
        font-size: 14px;
        color: #5f6b76;
    }

    /* Password Section */
    .password-section {
        background-color: white;
        padding: 25px;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 3px 12px rgba(36, 59, 95, 0.06);
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .section-header h2 {
        margin: 0;
        font-size: 20px;
        color: #243b5f;
    }

    /* Add Button */
    .add-btn {
        text-decoration: none;
        background-color: #569c54;
        color: white;
        padding: 10px 16px;
        border-radius: 7px;
        font-size: 14px;
        font-weight: bold;
        transition: 0.2s;
    }

    .add-btn:hover {
        background-color: #478746;
    }

    /* Table */
    .table-container {
        width: 100%;
        overflow-x: auto;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
    }

    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        min-width: 650px;
        background-color: white;
    }

    thead th {
        background-color: #243b5f;
        color: white;
        text-align: left;
        padding: 13px 15px;
        font-size: 13px;
        font-weight: bold;
    }

    thead th:first-child {
        border-top-left-radius: 9px;
    }

    thead th:last-child {
        border-top-right-radius: 9px;
    }

    tbody td {
        padding: 15px;
        border-bottom: 1px solid #edf0f4;
        font-size: 14px;
        color: #374151;
        background-color: white;
    }

    tbody tr:last-child td {
        border-bottom: none;
    }

    tbody tr:hover td {
        background-color: #f3f6f8;
    }

    tbody td:first-child {
        color: #243b5f;
        font-weight: bold;
    }

    tbody td:nth-child(2) {
        color: #5f6b76;
    }

    tbody td:nth-child(4) {
        letter-spacing: 2px;
        color: #5f6b76;
        font-weight: bold;
    }

    .empty-row {
        text-align: center;
        color: #5f6b76;
    }

    /* Dashboard Action Buttons */
    .view-btn,
    .edit-btn {
        display: inline-block;
        text-decoration: none;
        padding: 6px 11px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: bold;
        transition: 0.2s;
    }

    .view-btn {
        background-color: #eef5f8;
        color: #325481;
    }

    .view-btn:hover {
        background-color: #325481;
        color: white;
    }

    .edit-btn {
        background-color: #e8f5e9;
        color: #478746;
    }

    .edit-btn:hover {
        background-color: #569c54;
        color: white;
    }

    /* Category */
    .category {
        display: inline-block;
        background-color: #eef5f8;
        color: #325481;
        padding: 5px 9px;
        border-radius: 15px;
        font-size: 12px;
        font-weight: bold;
    }

    /* Responsive */
    @media (max-width: 900px) {
        .stats {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 700px) {
        .section-header {
            align-items: flex-start;
            gap: 15px;
        }

        .welcome h1 {
            font-size: 24px;
        }
    }
</style>

<!-- Success Message -->

@if(session('success'))

<div class="success-message">
    {{ session('success') }}
</div>

@endif


<!-- Welcome -->

<div class="welcome">
    <h1> Welcome, {{ Auth::user()->name }} </h1>
    <p> Manage your passwords securely and easily. </p>
</div>

<!-- Statistics -->
<div class="stats">

    <!-- Total Passwords -->
    <div class="stat-card">
        <div class="icon">
            <img src="/images/total_passwords.png" alt="Total Passwords Icon">
        </div>

        <h3> {{ $totalPasswords }} </h3>
        <p> Total Passwords </p>
    </div>

    <!-- Total Categories -->
    <div class="stat-card">
        <div class="icon">
            <img src="/images/categories.png" alt="Categories Icon">
        </div>

        <h3> {{ $totalCategories }} </h3>

        <p> Total Categories </p>
    </div>

    <!-- Generated Passwords -->
    <div class="stat-card">
        <div class="icon">
            <img src="/images/generated.png" alt="Generated Passwords">
        </div>

        <h3> {{ $generatedPasswords }} </h3>
        <p> Generated Passwords </p>

    </div>
</div>

<!-- Password Section -->
<div class="password-section">
    <div class="section-header">
        <h2> My Passwords </h2>
        <a href="{{ route('passwords.create') }}" class="add-btn"> + Add Password </a>
    </div>

    <!-- Table -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th> Website / Account </th>
                    <th> Username / Email </th>
                    <th> Category </th>
                    <th> Password </th>
                    <th> Actions </th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentPasswords as $password)
                <tr>
                    <td> {{ $password->website }} </td>
                    <td> {{ $password->username }} </td>
                    <td>
                        <span class="category">
                            {{ $password->category }}
                        </span>
                    </td>
                    <td class="masked"> {{ str_repeat('•', $password->password_length ?? 8) }} </td>
                    <td>
                        <a href="{{ route('passwords.index') }}" class="view-btn"> View </a>
                        <a href="{{ route('passwords.edit', $password->_id) }}" class="edit-btn"> Edit </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="empty-row">
                        No passwords saved yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection