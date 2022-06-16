<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = Book::factory(40)->create();

        foreach ($books as $book) {
            $book->categories()->attach([
                rand(1, 5),
                rand(6, 10)
            ]);
        }
    }
}
