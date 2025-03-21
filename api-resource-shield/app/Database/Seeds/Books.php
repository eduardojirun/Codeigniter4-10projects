<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class Books extends Seeder
{
    public function run()
    {
        $faker = Factory::create('es_ES');
        $books = [];
        for ($i=0; $i < 80; $i++) {
            $created_at = $faker->dateTime()->format('Y-m-d H:i:s');
            $updated_at = $faker->dateTimeBetween($created_at)->format('Y-m-d H:i:s');
            $books[] = [
                'book_name' => $faker->slug(3, false),
                'book_description'  => $faker->realTextBetween(50, 100, 1),
                'created_at'    => $created_at, 
                'updated_at'    => $updated_at
            ];
        } // dd($books);       
        $this->db->table('books')->insertBatch($books, true);
    }
}
