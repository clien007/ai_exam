@extends('layouts.app')

@section('content')
<div>
    <div class="row">
        <div class="col-6">
            <h1 class="article-label mb-2">Articles</h1>
        </div>
        <div class="col-6 text-end" >
            <a href="{{ route('articles.create') }}" class="btn btn-success mb-3 create-btn">Create New Article</a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="col-12 text-center mb-3">
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <table class="table table-striped for-desktop">
        <thead class="thead-dark">
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Date</th>
                <th>Writer</th>
                <th>Editor</th>
                <th>Company</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
                <tr>
                    <td width="100px"><img src="{{ $article->image }}" alt="{{ $article->title }}" width="50"></td>
                    <td><a href="{{ $article->link }}" target="_blank" class="article-title-table">{{ $article->title }}</a></td>
                    <td>{{date('M d, Y',strtotime($article->date))}}</td>
                    <td>{{ $article->writer->firstname }} {{ $article->writer->lastname }}</td>
                    <td>{{ $article->editor->firstname }} {{ $article->editor->lastname }}</td>
                    <td>{{ $article->company->name }}</td>
                    <td>{{ $article->status }}</td>
                    <td class="text-center">
                        @if(auth()->user()->can('edit', $article) || auth()->user()->can('publish', $article))
                            <a href="{{ route('articles.edit', $article->id) }}" class="mr-2">
                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                Edit
                            </a>
                        @endif
                        @can('publish', $article)
                            @if($article->status != "Published")
                                <form action="{{ route('articles.publish', $article->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit">
                                            <i class="fa fa-check-circle" aria-hidden="true"></i> Publish
                                    </button>
                                </form>
                            @endif
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="table table-striped for-mobile">
        <thead class="thead-dark">
            <tr>
                <th>Image</th>
                <th>Description</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
                <tr>
                    <td width="100px"><img src="{{ $article->image }}" alt="{{ $article->title }}" width="50"></td>
                    <td>
                        <p>
                            <a href="{{ $article->link }}" target="_blank" class="article-title-table">{{ $article->title }}</a>
                        </p>
                        <p><small>{{date('M d, Y',strtotime($article->date))}}</small></p>
                        <p>
                            <small><b>Writer:</b> {{ $article->writer->firstname }} {{ $article->writer->lastname }}</small>
                        </p>
                        <p>
                            <small><b>Editor:</b> {{ $article->editor->firstname }} {{ $article->editor->lastname }}</small>
                        </p>
                        <p>
                            <small><b>Company:</b> {{ $article->company->name }}</small>
                        </p>
                    </td>
                    <td>{{ $article->status }}</td>
                    <td class="text-center">
                        @if(auth()->user()->can('edit', $article) || auth()->user()->can('publish', $article))
                            <a href="{{ route('articles.edit', $article->id) }}" class="mr-2">
                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                Edit
                            </a>
                        @endif
                        @can('publish', $article)
                            @if($article->status != "Published")
                                <form action="{{ route('articles.publish', $article->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit">
                                            <i class="fa fa-check-circle" aria-hidden="true"></i> Publish
                                    </button>
                                </form>
                            @endif
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
