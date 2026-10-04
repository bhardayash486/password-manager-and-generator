@extends('layouts.app')

@section('title', 'My Passwords - Password Manager & Generator')

@section('page-title', 'My Passwords')

@section('content')

<style>
    /* Page */
    .password-page {
        background-color: white;
        padding: 25px;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 3px 12px rgba(36, 59, 95, 0.06);
    }

    /* Header */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .page-header h1 {
        margin: 0;
        font-size: 24px;
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
    }

    .add-btn:hover {
        background-color: #478746;
    }

    /* Success Message */
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

    /* Search */
    .search-form {
        display: flex;
        gap: 10px;
        margin-bottom: 25px;
    }

    .search-form input {
        flex: 1;
        padding: 12px 14px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        font-size: 14px;
        outline: none;
    }

    .search-form input:focus {
        border-color: #325481;
        box-shadow: 0 0 0 3px rgba(50, 84, 129, 0.10);
    }

    .search-btn {
        border: none;
        background-color: #325481;
        color: white;
        padding: 0 18px;
        border-radius: 7px;
        cursor: pointer;
        font-size: 14px;
        font-weight: bold;
    }

    .search-btn:hover {
        background-color: #243b5f;
    }

    .clear-btn {
        display: flex;
        align-items: center;
        text-decoration: none;
        background-color: #6b7280;
        color: white;
        padding: 0 16px;
        border-radius: 7px;
        font-size: 14px;
        font-weight: bold;
    }

    .clear-btn:hover {
        background-color: #4b5563;
    }

    /* Table */
    .table-container {
        width: 100%;
        overflow-x: auto;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
    }

    .password-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 900px;
    }

    .password-table thead {
        background-color: #243b5f;
        color: white;
    }

    .password-table th {
        padding: 14px 12px;
        text-align: left;
        font-size: 13px;
        font-weight: bold;
        white-space: nowrap;
    }

    .password-table td {
        padding: 13px 12px;
        border-top: 1px solid #e5e7eb;
        font-size: 13px;
        color: #4b5563;
        vertical-align: middle;
    }

    .password-table tbody tr:hover {
        background-color: #f3f6f8;
    }

    .website-name {
        color: #243b5f;
        font-weight: bold;
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

    /* Generated */
    .generated-yes {
        color: #237a36;
        font-weight: bold;
    }

    .generated-no {
        color: #6b7280;
        font-weight: bold;
    }

    /* Password */
    .password-value {
        letter-spacing: 2px;
        color: #6b7280;
        font-weight: bold;
        white-space: nowrap;
    }

    /* Buttons */
    .show-btn,
    .copy-btn,
    .edit-btn,
    .delete-btn {
        border: none;
        padding: 6px 9px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 11px;
        font-weight: bold;
        text-decoration: none;
        display: inline-block;
        white-space: nowrap;
    }

    .show-btn {
        background-color: #325481;
        color: white;
    }

    .show-btn:hover {
        background-color: #243b5f;
    }

    .copy-btn {
        background-color: #6b7280;
        color: white;
    }

    .copy-btn:hover {
        background-color: #4b5563;
    }

    .edit-btn {
        background-color: #569c54;
        color: white;
    }

    .edit-btn:hover {
        background-color: #478746;
    }

    .delete-btn {
        background-color: #dc3545;
        color: white;
    }

    .delete-btn:hover {
        background-color: #c82333;
    }

    .delete-form {
        display: inline;
    }

    /* Actions */
    .actions {
        white-space: nowrap;
    }

    /* Empty Message */
    .empty-message {
        text-align: center;
        padding: 40px 20px;
        color: #6b7280;
    }

    .empty-message h3 {
        margin-bottom: 8px;
        color: #243b5f;
    }

    .empty-message p {
        margin: 5px 0;
        font-size: 14px;
    }

    /* Pagination */
    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 25px;
    }

    .pagination-container .pagination {
        margin: 0;
    }

    /* Responsive */
    @media (max-width: 700px) {
        .password-page {
            padding: 18px;
        }

        .page-header {
            align-items: flex-start;
            gap: 15px;
        }

        .search-form {
            flex-direction: column;
        }

        .search-btn,
        .clear-btn {
            justify-content: center;
            padding: 11px 16px;
        }

        .add-btn {
            white-space: nowrap;
        }
    }
</style>

@if(session('success'))
    <div class="success-message">
        {{ session('success') }}
    </div>
@endif

<div class="password-page">

    <!-- Page Header -->
    <div class="page-header">
        <h1>My Saved Passwords</h1>
        <a href="{{ route('passwords.create') }}" class="add-btn"> + Add Password </a>
    </div>

    <!-- Search -->
    <form method="GET" action="{{ route('passwords.index') }}" class="search-form">

        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Website or Username">

        <button type="submit" class="search-btn"> Search </button>

        <a href="{{ route('passwords.index') }}" class="clear-btn"> Clear </a>

    </form>

    @if($passwords->isEmpty())
        <!-- Empty Message -->
        <div class="empty-message">
            @if(request('search'))

                <h3> Passwords Not Found. </h3>
                <p> No passwords found for <strong> "{{ request('search') }}" </strong>. </p>
                <p> Try searching for another website or username. </p>

            @else

                <h3> Passwords Not Found. </h3>
                <p> You haven't saved any passwords yet. </p>
                <p> Start adding passwords to manage them securely. </p>

            @endif
        </div>
    @else

        <!-- Password Table -->
        <div class="table-container">

            <table class="password-table">
                <thead>
                    <tr>
                        <th> Website / Account </th>
                        <th> Username / Email </th>
                        <th> Category </th>
                        <th> Generated </th>
                        <th> Password </th>
                        <th> Actions </th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($passwords as $password)

                        <tr>
                            <!-- Website -->
                            <td>
                                <span class="website-name"> {{ $password->website }} </span>
                            </td>

                            <!-- Username -->
                            <td> {{ $password->username }} </td>

                            <!-- Category -->
                            <td>
                                <span class="category"> {{ $password->category }} </span>
                            </td>

                            <!-- Generated -->
                            <td>
                                @if($password->generated)
                                    <span class="generated-yes"> Yes </span>
                                @else
                                    <span class="generated-no"> No </span>
                                @endif
                            </td>

                            <!-- Password -->
                            <td>
                                <span id="password-{{ $password->_id }}" class="password-value" data-length="{{ $password->password_length ?? 8 }}">
                                    {{ str_repeat('•', $password->password_length ?? 8) }}
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="actions">

                                <button type="button" class="show-btn" onclick="togglePassword('{{ $password->_id }}', this)"> Show </button>

                                <button type="button" class="copy-btn" onclick="copyPassword('{{ $password->_id }}')"> Copy </button>

                                <a href="{{ route('passwords.edit', $password->_id) }}" class="edit-btn"> Edit </a>

                                <form action="{{ route('passwords.delete', $password->_id) }}" method="POST" class="delete-form"
                                    onsubmit="return confirm('Are you sure you want to delete this password?');">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="delete-btn"> Delete </button>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-container">
            {{ $passwords->links('pagination::bootstrap-5') }}
        </div>

    @endif

</div>

<script>
    function togglePassword(id, button)
    {
        let passwordElement = document.getElementById('password-' + id);

        if (button.innerText === 'Hide')
        {
            let length = passwordElement.dataset.length;
            passwordElement.innerText = '•'.repeat(length);
            button.innerText = 'Show';
            return;
        }

        fetch("{{ url('/passwords') }}/" + id + "/reveal", {
            method: 'POST',
            headers:
            {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok)
            {
                throw new Error('Failed to reveal password.');
            }
            return response.json();
        })
        .then(data => {
            passwordElement.innerText = data.password;
            button.innerText = 'Hide';
        })
        .catch(error => {
            console.error(error);
            alert('Failed to reveal password.');
        });
    }

    function copyPassword(id)
    {
        fetch("{{ url('/passwords') }}/" + id + "/reveal", {
                method: 'POST',
                headers:
                {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
        })
        .then(response => {
            if (!response.ok)
            {
                throw new Error('Failed to retrieve password.');
            }
            return response.json();
        })
        .then(data => {
            navigator.clipboard.writeText(data.password)
                .then(function()
                {
                    alert('Password Copied Successfully.');
                })
                .catch(function()
                {
                    alert('Failed to Copy Password.');
                });
        })
        .catch(error => {
            console.error(error);
            alert('Failed to retrieve password.');
        });
    }
</script>

@endsection