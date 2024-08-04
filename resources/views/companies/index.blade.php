@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-6">
            <h1 class="article-label mb-2">Companies</h1>
        </div>
        <div class="col-6 text-end" >
            <a href="{{ route('companies.create') }}" class="btn btn-success mb-3">Create New Company</a>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="col-12 mb-3 text-center">
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Logo</th>
                <th>Name</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($companies as $company)
                <tr>
                    <td width="100px"><img src="{{ $company->logo }}" alt="{{ $company->name }}" width="50"></td>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->status }}</td>
                    <td class="text-center">
                        <a href="{{ route('companies.edit', $company->id) }}" class="mr-2">
                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                Edit
                            </a></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
