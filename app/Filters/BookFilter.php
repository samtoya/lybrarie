<?php

namespace App\Filters;


use App\Models\Book;
use Illuminate\Database\Eloquent\Builder;

class BookFilter extends QueryFilter
{
    public function year( $year )
    {
        return Book::where( 'year', $year )->paginate();
    }

    public function genre( $genre )
    {
        return Book::whereHas( 'genres', function ( Builder $builder ) use ( $genre ) {
            $builder->whereName( $genre )->distinct();
        } )->paginate();
    }

    public function author( $author )
    {
        return Book::whereHas( 'authors', function ( Builder $builder ) use ( $author ) {
            $builder->whereName( $author )->distinct();
        } )->paginate();
    }

    public function query( $query )
    {
        return Book::where( 'title', 'like', "%{$query}%" )
            ->orWhere( 'isbn', 'like', "%{$query}%" )
            ->paginate();
    }
}
