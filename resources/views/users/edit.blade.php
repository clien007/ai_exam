@extends('layouts.app')

@section('content')
    <h1 class="mb-2 article-label">Edit User</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="firstname">First Name</label>
            <input type="text" name="firstname" id="firstname" class="form-control" value="{{$user->firstname}}" required>
        </div>

        <div class="form-group mb-3">
            <label for="lastname">Last Name</label>
            <input type="text" name="lastname" id="lastname" class="form-control" value="{{$user->lastname}}" required>
        </div>

        
        <div class="form-group mb-3">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" class="form-control" value="{{$user->email}}" required>
        </div>

        <div class="form-group mb-3">
            <label for="type">Type</label>
            <select name="type" id="type" class="form-control" required>
                @foreach($types as $type)
                    <option value="{{$type}}" {{$type == $user->type ? 'selected' : ''}}>{{$type}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                @foreach($statuses as $status)
                    <option value="{{$status}}" {{$status == $user->status ? 'selected' : ''}}>{{$status}}</option>
                @endforeach
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
