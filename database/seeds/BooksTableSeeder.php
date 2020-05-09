<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::defaultStringLength( 191 );
        Schema::disableForeignKeyConstraints();
        DB::table( 'books' )->truncate();
        DB::table( 'authors' )->truncate();
        DB::table( 'genres' )->truncate();

        factory( App\Models\Book::class, 20 )->create()
            ->each( function ( App\Models\Book $book ) {
                $authors = factory( App\Models\Author::class )->create();
                $genres  = factory( App\Models\Genre::class )->create();
                $book->authors()->attach( $authors );
                $book->genres()->attach( $genres );
            } );

        Schema::enableForeignKeyConstraints();
    }
}
