<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

    </head>
    
    <body class="font-sans antialiased bg-gray-100">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                <nav id="sidebar">
                    <ul>
                        @if(auth()->user()->type == 'Writer')
                            <li><a href="{{ route('writer.dashboard') }}">Dashboard</a></li>
                        @endif

                        @if(auth()->user()->type == 'Editor')
                            <li><a href="{{ route('editor.dashboard') }}">Dashboard</a></li>
                            <li><a href="{{ route('companies.index') }}">Companies</a></li>
                            <li><a href="{{ route('users.index') }}">Users</a></li>
                        @endif

                        <li><a href="{{ route('articles.index') }}">All Media</a></li>
                    </ul>
                </nav>
                <div id="content">
                    @yield('content')
                </div>
            </main>
        </div>

        @yield('script')

        <script>
            CKEDITOR.replace('article_content', {
                enterMode: CKEDITOR.ENTER_BR, // Use <br> instead of <p>
                shiftEnterMode: CKEDITOR.ENTER_BR, // Use <br> for Shift+Enter as well
            });
        </script>
    </body>
</html>
