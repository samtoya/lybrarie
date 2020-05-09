<?php

namespace App\Http\Controllers;

use App\Filters\BookFilter;
use App\Models\Book;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * View all books.
     *
     * @param BookFilter $request
     * @return Application|Factory|View
     */
    public function index( BookFilter $request )
    {
        $books   = Book::filter( $request )->paginate();
        $authors = $books->pluck( 'authors' )->flatten()->unique();
        $genres  = $books->pluck( 'genres' )->flatten()->unique();
        $years   = $books->pluck( 'year' )->sortDesc();

        return view( 'books.index', compact( 'books', 'authors', 'genres', 'years' ) );
    }

    /**
     * View a single book.
     *
     * @param Book $book
     * @return Application|Factory|View
     */
    public function show( Book $book )
    {
        return view( 'books.show', compact( 'book' ) );
    }
}
