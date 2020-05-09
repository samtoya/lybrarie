<?php

namespace Tests\Unit;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_book_belongs_to_an_author()
    {
        $book   = factory( Book::class )->create();
        $author = factory( Author::class )->create();
        $book->authors()->attach( $author );

        $this->assertCount( 1, $book->authors );
        $this->assertInstanceOf( Author::class, $book->authors->first() );
    }

    /** @test */
    public function a_book_can_belong_to_multiple_authors()
    {
        $book    = factory( Book::class )->create();
        $authors = factory( Author::class, 2 )->create();
        $book->authors()->attach( $authors );

        $this->assertCount( 2, $book->authors );
        $this->assertInstanceOf( Collection::class, $book->authors );
    }

    /** @test */
    public function a_book_belongs_to_a_genre()
    {
        $book  = factory( Book::class )->create();
        $genre = factory( Genre::class )->create();
        $book->genres()->attach( $genre );

        $this->assertCount( 1, $book->genres );
        $this->assertInstanceOf( Genre::class, $book->genres->first() );
    }

    /** @test */
    public function a_book_can_have_multiple_genres()
    {
        $book   = factory( Book::class )->create();
        $genres = factory( Genre::class, 3 )->create();
        $book->genres()->attach( $genres );

        $this->assertCount( 3, $book->genres );
        $this->assertInstanceOf( Collection::class, $book->genres );
    }
}
