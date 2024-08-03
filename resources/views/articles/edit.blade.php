@extends('layouts.app')

@section('content')
    <h1 class="mb-2 article-label">Edit Article</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('articles.update', $article->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="image">Image</label>
            <input type="text" name="image" id="image" value="{{ $article->image }}" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ $article->title }}" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="link">Link</label>
            <input type="text" name="link" id="link" value="{{ $article->link }}" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" value="{{ $article->date }}" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="content">Content</label>
            <textarea name="content" id="article_content" class="form-control" rows="10" cols="80" required>{!! $article->content !!}</textarea>
        </div>

        @if(Auth::user()->type == "Writer")
            <div class="form-group mb-3">
                <label for="editor_id">Editor</label>
                <select name="editor_id" id="editor_id" class="form-control" required>
                    @foreach($editors as $editor)
                        <option value="{{ $editor->id }}" {{$editor->id == $article->editor->id ? 'selected' : ''}}>{{ $editor->firstname }} {{ $editor->lastname }}</option>
                    @endforeach
                </select>
            </div>
        @else
            <div class="form-group mb-3">
                <label for="writer_id">Writer</label>
                <select name="writer_id" id="writer_id" class="form-control" required>
                    @foreach($writers as $writer)
                        <option value="{{ $writer->id }}">{{ $writer->firstname }} {{ $writer->lastname }}</option>
                    @endforeach
                </select>
            </div>
        @endif

        <div class="form-group mb-3">
            <label for="company_id">Company</label>
            <select name="company_id" id="company_id" class="form-control" required>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{ $company->id == $article->company_id ? 'selected' : '' }}>
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <div class="row">
                <div class="col-6">
                    <a href="{{ route('articles.index') }}" class="btn btn-danger">Cancel</a>
                </div>

                <div class="col-6 text-end">      
                    <button type="submit" class="btn btn-primary" name="action" value="save">Save</button>

                    @if(Auth::user()->type == "Editor" && $article->status != "Published")
                        <button type="submit" class="btn btn-success" name="action" value="publish"> Publish</button>       
                    @endif
                </div>
            </div>
        </div>
        
    </form>
@endsection
