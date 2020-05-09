<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use PhpParser\Builder;

class Book extends Model
{
    protected $perPage = 10;

    protected $with = [ 'authors', 'genres' ];

    /**
     * Author relationship.
     *
     * @return BelongsToMany
     */
    public function authors()
    {
        return $this->morphedByMany( Author::class, 'modelable' )->withTimestamps();
    }

    /**
     * Genre relationship.
     *
     * @return BelongsToMany
     */
    public function genres()
    {
        return $this->morphedByMany( Genre::class, 'modelable' )->withTimestamps();
    }

    /**
     * Handling filtering on model records.
     *
     * @param $query
     * @param QueryFilter $filter
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, QueryFilter $filter)
    {
        return $filter->apply( $query );
    }
}
