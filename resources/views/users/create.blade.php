@extends('layouts.app')

@section('content')
    <h1 class="mb-2 article-label">Create New User</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="firstname">First Name</label>
            <input type="text" name="firstname" id="firstname" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="lastname">Last Name</label>
            <input type="text" name="lastname" id="lastname" class="form-control" required>
        </div>

        
        <div class="form-group mb-3">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="type">Type</label>
            <select name="type" id="type" class="form-control" required>
                <option value="Writer">Writer</option>
                <option value="Editor">Editor</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <div class="row">
                <div class="col-6">
                    <a href="{{ route('users.index') }}" class="btn btn-danger">Cancel</a>
                </div>

                <div class="col-6 text-end">      
                    <button type="submit" class="btn btn-success">Create</button>
                </div>
            </div>
        </div>
    </form>
@endsection