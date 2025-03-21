<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class BooksAuthors extends Seeder
{
    public function run()
    {
        $faker = Factory::create('es_ES');
        $books_authors = [];
        for ( $i = 0; $i < 300; $i++ ) {
            $books_authors[] = [
                'book_id'       => $faker->numberBetween(1, 80),
                'author_id'     => $faker->numberBetween(1, 60)
            ];
        } // dd($books_authors);
        $this->db->table('books_authors')->insertBatch($books_authors, true);
    }
}