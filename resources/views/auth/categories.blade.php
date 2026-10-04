@extends('layouts.app')

@section('title', 'Categories - Password Manager & Generator')

@section('page-title', 'Categories')

@section('content')

<style>
    .category-page {
        background-color: white;
        padding: 25px;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 3px 12px rgba(15, 39, 71, 0.06);
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .page-header h1 {
        margin: 0;
        color: #243b5f;
        font-size: 24px;
    }

    .add-form {
        display: flex;
        gap: 10px;
        margin-bottom: 25px;
    }

    .add-form input {
        flex: 1;
        padding: 11px 13px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        font-size: 14px;
        outline: none;
    }

    .add-form input:focus {
        border-color: #325481;
        box-shadow: 0 0 0 3px rgba(50, 84, 129, 0.10);
    }

    .add-btn {
        border: none;
        background-color: #569c54;
        color: white;
        padding: 11px 18px;
        border-radius: 7px;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
    }

    .add-btn:hover {
        background-color: #478746;
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
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        padding: 12px 18px;
        margin-bottom: 20px;
        border-radius: 8px;
        font-size: 14px;
    }

    .category-table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        overflow: hidden;
    }

    .category-table th {
        background-color: #243b5f;
        color: white;
        padding: 13px;
        text-align: left;
        font-size: 13px;
    }

    .category-table td {
        padding: 13px;
        border-top: 1px solid #e5e7eb;
        color: #4b5563;
        font-size: 14px;
    }

    .category-name {
        color: #243b5f;
        font-weight: bold;
    }

    .edit-input {
        padding: 7px 9px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 13px;
        width: 180px;
    }

    .edit-btn,
    .delete-btn {
        border: none;
        padding: 7px 11px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: bold;
        cursor: pointer;
    }

    .edit-btn {
        background-color: #478746;
        color: white;
    }

    .edit-btn:hover {
        background-color: #569c54;
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

    .empty-message {
        text-align: center;
        padding: 35px 20px;
        color: #5f6b76;
    }

    @media (max-width: 700px) {
        .page-header {
            align-items: flex-start;
        }

        .add-form {
            flex-direction: column;
        }

        .category-table {
            min-width: 600px;
        }

        .table-container {
            overflow-x: auto;
        }
    }
</style>

@if(session('success'))
    <div class="success-message">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="error-message">
        <ul style="margin: 0; padding-left: 20px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="category-page">

    <div class="page-header">
        <h1> Manage Categories </h1>
    </div>

    <!-- Add Category -->
    <form method="POST" action="{{ route('categories.store') }}" class="add-form">
        @csrf

        <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter category name" maxlength="50" required>

        <button type="submit" class="add-btn"> + Add Category </button>
    </form>

    @if($categories->isEmpty())

        <div class="empty-message">
            <h3> No Categories Found. </h3>
            <p> Create your first category above. </p>
        </div>

    @else
        <div class="table-container">

            <table class="category-table">
                <thead>
                    <tr>
                        <th> Category Name </th>
                        <th> Actions </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                <span class="category-name"> {{ $category->name }} </span>
                            </td>

                            <td>
                                <!-- Edit -->
                                <form method="POST" action="{{ route('categories.update', $category->_id) }}"
                                style="display: inline-flex; gap: 7px; align-items: center;">
                                    @csrf
                                    @method('PUT')

                                    <input type="text" name="name" value="{{ $category->name }}" class="edit-input" maxlength="50" required>

                                    <button type="submit" class="edit-btn"> Edit </button>
                                </form>

                                <!-- Delete -->
                                <form method="POST" action="{{ route('categories.delete', $category->_id) }}" class="delete-form"
                                onsubmit="return confirm('Are you sure you want to delete this category?');">
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
    @endif
</div>

@endsection