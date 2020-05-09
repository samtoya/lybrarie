<?php

namespace App\Filters;


use Illuminate\Database\Eloquent\Builder;

class BookFilter extends QueryFilter
{
    /**
     * Eloquent builder instance.
     *
     * @var
     */
    protected $builder;

    public function year( $year )
    {
        return $this->builder->where( 'year', $year );
    }

    public function genre( $genre )
    {
        return $this->builder->whereHas( 'genres', function ( Builder $builder ) use ( $genre ) {
            $builder->whereName( $genre )->distinct();
        } );
    }

    public function author( $author )
    {
        return $this->builder->whereHas( 'authors', function ( Builder $builder ) use ( $author ) {
            $builder->whereName( $author )->distinct();
        } );
    }

    public function query( $query )
    {
        return $this->builder->where( 'title', 'like', "%{$query}%" )
            ->orWhere( 'isbn', 'like', "%{$query}%" );
    }
}
