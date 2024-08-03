@extends('layouts.app')

@section('content')
    <h1 class="mb-2 article-label">Create New Company</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('companies.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="logo">Logo</label>
            <input type="url" name="logo" id="logo" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        </div>
        <div class="form-group mb-3 text-end">
            <button type="submit" class="btn btn-success">Create</button>
        </div>
    </form>
@endsection
