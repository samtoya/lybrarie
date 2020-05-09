<?php

namespace App\Http\Controllers;

use App\Filters\BookFilter;
use App\Models\Book;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * View all books.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index( Request $request )
    {
        $books   = $this->getBooks( $request );
        $authors = $books->pluck( 'authors' )->flatten();
        $genres  = $books->pluck( 'genres' )->flatten();
        $years   = $books->pluck( 'year' )->sortDesc();

        return view( 'books.index', compact( 'books', 'authors', 'genres', 'years' ) );
    }

    private function getBooks( Request $request )
    {
        if ( $request->has( 'author' ) || $request->has( 'genre' ) || $request->has( 'query' ) || $request->has( 'year' ) ) {
            if ( $request->has( 'author' ) ) {
                return Book::whereHas( 'authors', function ( Builder $builder ) use ( $request ) {
                    $builder->whereName( $request->author );
                } )->paginate();
            }
            if ( $request->has( 'query' ) ) {
                return Book::where( 'title', 'like', "%{$request->get('query')}%" )
                    ->orWhere( 'isbn', 'like', "%{$request->get('query')}%" )
                    ->paginate();
            }
            if ( $request->has( 'genre' ) ) {
                return Book::whereHas( 'genres', function ( Builder $builder ) use ( $request ) {
                    $builder->whereName( $request->genre );
                } )->paginate();
            }
            if ( $request->has( 'year' ) ) {
                return Book::where( 'year', $request->year )->paginate();
            }
        }
        return Book::paginate();
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
