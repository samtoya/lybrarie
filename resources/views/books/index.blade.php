@extends('layouts.app')

@section('content')
    <div class="row">
        @foreach($books as $book)
            <div class="col-md-3">
                <img src="{{ asset('img/default.png') }}" alt="{{ $book->title }}" class="img-responsive">
                <h5>
                    <a href="{{ route('books.show', $book) }}">{{ \Illuminate\Support\Str::limit($book->title, 40) }}</a></h5>
                <div>
                    @foreach($book->authors as $author)
                        <span>{{ $author->name }}</span>
                        @unless($loop->last), @endunless
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
    {{ $books->links() }}
@stop
