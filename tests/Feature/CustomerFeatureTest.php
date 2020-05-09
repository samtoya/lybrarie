<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_customer_should_be_able_view_a_list_of_books()
    {
        $books = factory( Book::class, 2 )->create();
        $this->get( '/' )->assertStatus( 200 );
        $this->assertDatabaseCount( 'books', $books->count() );
    }

    /** @test */
    public function a_customer_should_be_able_to_view_a_single_book()
    {
        $book = factory( Book::class )->create();

        $this->get( 'books/' . $book->id )
            ->assertStatus( 200 )
            ->assertSee( $book->title );
    }

    /** @test */
    public function a_customer_can_search_for_a_book()
    {
        $this->withoutExceptionHandling();
        $query = 'Harry';
        $books = factory( Book::class, 1 )->create(['title' => 'Harry Potter']);

        $response = $this->get('/?query='. $query)
            ->assertStatus(200)
            ->assertSee($query);
    }
}
