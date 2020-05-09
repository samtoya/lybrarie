<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="container-fluid">
    <div class="row mb-5">
        <div class="col-md-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="{{ route('books.index') }}">{{ config('app.name') }}</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto"></ul>
                    <form action="{{ route('books.index', ['query' => request('query')]) }}" class="form-inline my-2 my-lg-0">
                        <input name="query" value="{{ request('query') }}" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </nav>
        </div>
    </div>
    <div class="row">
        @if(Route::currentRouteName() === 'books.index')
            <div class="col-md-3">
                <h4>Total Books - {{ $books->count() }}</h4>
                <h4>Year</h4>
                @foreach($years as $year)
                    <a href="{{ route('books.index', ['year' => $year]) }}" class="d-block" href="">{{ $year }}</a>
                @endforeach
                <h4>Authors - {{ $authors->count() }}</h4>
                @foreach($authors as $author)
                    <a href="{{ route('books.index', ['author' => $author->name]) }}" class="d-block" href="">{{ $author->name }}</a>
                @endforeach
                <h4>Genres - {{ $genres->count() }}</h4>
                @foreach($genres as $genre)
                    <a class="d-block" href="{{ route('books.index', ['genre' => $genre->name]) }}">{{ $genre->name }}</a>
                @endforeach
            </div>
        @endif
        <div class="col-md-9">
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
