@extends('layouts.app')

@section('content')
    <div class="row dashboard-wrapper">
        <div class="card col-md-6">
            <div class="card-body">
                <h1 class="card-title mb-3">Welcome to {{Auth::user()->firstname}} Editor Dashboard</h1>
                <a href="{{ route('articles.create') }}" class="btn btn-success mb-3">Create New Article</a>

                <hr class="my-2 mb-3">

                <h1 class="card-title mb-3">Published Articles Preview</h1>
                <p class="card-text">
                    <div class="row">
                        @foreach($articlesPublished as $article)
                            <div class="row mb-4">
                                <div class="col-3 text-center">
                                    <img src="{{ $article->image }}" alt="{{ $article->title }}">

                                    <h2 class="mt-3 view-details"><a href="{{ route('articles.show', ['article' => $article->id]) }}">VIEW DETAILS</a></h2>
                                </div>
                                <div class="col-9">
                                    <h2 class="mb-1 article-title">
                                        <a href="{{ $article->link }}" target="_blank">
                                            <span class="published-text">Published</span> {{ $article->title }}
                                        </a>
                                    </h2>
                                    <p class="mb-1"><small>{{date('M d, Y',strtotime($article->date))}} </small></p>
                                    <p class="article-content mb-3">{!! $article->content !!}</p>
                                    <p>Writer: {{ $article->writer->firstname }} {{ $article->writer->lastname }}</p>
                                    <p>Editor: {{ $article->editor->firstname }} {{ $article->editor->lastname }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </p>
            </div>
        </div>

        <div class="card col-md-6">
            <div class="card-body">
                <h1 class="card-title mb-3">For Edit Articles Preview</h1>
                <p class="card-text">
                    <div class="row">
                        @foreach($articlesForEdit as $article)
                            <div class="row mb-4">
                                <div class="col-3 text-center">
                                    <img src="{{ $article->image }}" alt="{{ $article->title }}">
                                    <h2 class="mt-3 view-details"><a href="{{ route('articles.show', ['article' => $article->id]) }}">VIEW DETAILS</a></h2>
                                </div>
                                <div class="col-9">
                                    <h2 class="mb-1 article-title">
                                        <a href="{{ $article->link }}"  target="_blank">
                                            <span class="for-edit-text">For Editing</span> {{ $article->title }}
                                        </a>
                                    </h2>
                                    <p class="mb-1"><small>{{date('M d, Y',strtotime($article->date))}} </small></p>
                                    <p class="article-content mb-3">{!! $article->content !!}</p>
                                    <p>Writer: {{ $article->writer->firstname }} {{ $article->writer->lastname }}</p>
                                    <p>Editor: {{ $article->editor->firstname }} {{ $article->editor->lastname }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </p>
            </div>
        </div>
    </div>

@endsection
