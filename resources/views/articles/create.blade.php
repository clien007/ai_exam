@extends('layouts.app')

@section('content')
    <h1 class="mb-2 article-label">Create New Article</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('articles.store') }}" method="POST" id="article-form" onsubmit="return validateForm(event)">
        @csrf

        <div class="form-group mb-3">
            <label for="image">Image</label>
            <input type="url" name="image" id="image" class="form-control" required>
            <div id="imageError" class="text-danger"></div>
        </div>

         <div class="form-group  mb-3">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
            <div id="titleError" class="text-danger"></div>
        </div>

        <div class="form-group mb-3">
            <label for="link">Link</label>
            <input type="url" name="link" id="link" class="form-control" required>
            <div id="linkError" class="text-danger"></div>
        </div>

        <div class="form-group mb-3">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ date('Y-m-d') }}" required>
            <div id="dateError" class="text-danger"></div>
        </div>

        <div class="form-group mb-3">
            <label for="content">Content</label>
            <textarea name="content" id="article_content" class="form-control" rows="10" cols="80" required> </textarea>
            <div id="contentError" class="text-danger"></div>
        </div>

        @if(Auth::user()->type == "Writer")
        <div class="form-group mb-3">
            <label for="editor_id">Editor</label>
            <select name="editor_id" id="editor_id" class="form-control" required>
                @foreach($editors as $editor)
                    <option value="{{ $editor->id }}">{{ $editor->firstname }} {{ $editor->lastname }}</option>
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
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <div class="row">
                <div class="col-6">
                    <a href="{{ route('articles.index') }}" class="btn btn-danger">Cancel</a>
                </div>

                <div class="col-6 text-end">      
                    <button type="submit" class="btn btn-success">Create</button>
                </div>
            </div>
        </div>
    </form>
@endsection


@section('script')
<script>
function validateForm(event) {
    event.preventDefault();
    let isValid = true;

    // Clear previous errors
    document.getElementById('imageError').innerText = '';
    document.getElementById('titleError').innerText = '';
    document.getElementById('linkError').innerText = '';
    document.getElementById('dateError').innerText = '';
    document.getElementById('contentError').innerText = '';

    // Validate Image URL
    const image = document.getElementById('image').value;
    const urlPattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.?)+[a-z]{2,}|'+ // domain name
        '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
        '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
        '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
        '(\\#[-a-z\\d_]*)?$','i'); // fragment locator

    if (!urlPattern.test(image)) {
        document.getElementById('imageError').innerText = 'Please enter a valid URL.';
        isValid = false;
    }

    // Validate Title
    const title = document.getElementById('title').value;
    if (title.trim() === '') {
        document.getElementById('titleError').innerText = 'Title is required.';
        isValid = false;
    }

    // Validate Link
    const link = document.getElementById('link').value;
    if (!urlPattern.test(link)) {
        document.getElementById('linkError').innerText = 'Please enter a valid URL.';
        isValid = false;
    }

    // Validate Date
    const date = document.getElementById('date').value;
    if (date.trim() === '') {
        document.getElementById('dateError').innerText = 'Date is required.';
        isValid = false;
    }

    // Validate Content
    const content = document.getElementById('article_content').value;
    if (content.trim() === '') {
        document.getElementById('contentError').innerText = 'Content is required.';
        isValid = false;
    }

    if(isValid){
        document.getElementById("article-form").submit();
    }

    return isValid;
}
</script>
@endsection
