@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <img src="{{ asset('img/default.png')  }}" alt="{{ $book->title }}">
        </div>

        <div class="col-md-9">
            <h3>Title: {{ $book->title }}</h3>
            <h4>ISBN: {{ $book->isbn }}</h4>
            <h4>Year: {{ $book->year }}</h4>
            <h4>Genres</h4>
            @foreach($book->genres as $genre)
                <span>{{ $genre->name }}</span>
                @unless($loop->last), @endunless
            @endforeach
            <h5>Authors</h5>
            @foreach($book->authors as $author)
                <span>{{ $author->name }}</span>
                @unless($loop->last), @endunless
            @endforeach
        </div>
    </div>
@stop

