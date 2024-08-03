@extends('layouts.app')

@section('content')
<div>
    <div class="row">
        <div class="col-6">
            <h1 class="article-label mb-2">Users</h1>
        </div>
        <div class="col-6 text-end" >
            <a href="{{ route('users.create') }}" class="btn btn-success mb-3">Create New User</a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="col-12 text-center mb-3">
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Type</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->firstname}}</td>
                    <td>{{$user->lastname}}</td> 
                    <td>{{$user->type}}</td>
                    <td>{{$user->status}}</td>
                    <td class="text-center">
                        <a href="{{ route('users.edit', $user->id) }}" class="mr-2">
                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                Edit
                            </a>
                    </td>
                </tr>
            @endforeach      
        </tbody>

    </table>

</div>
@endsection