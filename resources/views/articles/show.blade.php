@extends('layouts.app')

@section('content')
<div class="row article-show-wrapper">
    <div class="col-2">
        <div class="form-group mb-3">
            <img src="{{ $article->image }}" alt="{{ $article->title }}">
        </div>
    </div>

    <div class="col-10">
        <div class="form-group mb-3">
            <label for="title">Title:</label>
            <a href="{{ $article->link }}" target="_blank">
                {{ $article->title }}
            </a>
        </div>

        <div class="form-group mb-3">
            <label for="link">Link:</label>
            <p>
                {{$article->link}}
            </p>
        </div>

        <div class="form-group mb-3">
            <label for="date">Date:</label>
            <p>
                {{date('M d, Y',strtotime($article->date))}}
            </p>
        </div>

        <div class="form-group mb-3">
            <label for="content">Content:</label>
            <p>{!! $article->content !!}</p>
        </div>

        <div class="form-group mb-3">
            <label for="writer">Company:</label>
            <p>{{ $article->company->name }}</p>
        </div>

        <div class="form-group mb-3">
            <label for="writer">Writer:</label>
            <p>{{ $article->writer->firstname }} {{ $article->writer->lastname }}</p>
        </div>

        <div class="form-group mb-3">
            <label for="editor">Editor:</label>
            <p>{{ $article->editor->firstname }} {{ $article->editor->lastname }}</p>
        </div>

        <div class="form-group mb-3">
            <label for="editor">Status:</label>
            <p>{{$article->status}}</p>
        </div>


        
    </div>
</div>
@endsection