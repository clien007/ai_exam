@extends('layouts.app')

@section('content')
    <h1 class="mb-2 article-label">Create New Company</h1>

    <form action="{{ route('companies.update', $company->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="logo">Logo</label>
            <input type="url" name="logo" id="logo" value="{{ $company->logo }}" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ $company->name }}" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="Active" {{ $company->status == 'Active' ? 'selected' : '' }}>Active</option>
                <option value="Inactive" {{ $company->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <div class="form-group mb-3 text-end">
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </form>
@endsection
