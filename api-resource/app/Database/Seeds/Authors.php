<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class Authors extends Seeder
{
    public function run()
    {
        $faker = Factory::create('es_ES');
        $authors = [];
        for ($i=0; $i < 60; $i++) {
            $created_at = $faker->dateTime()->format('Y-m-d H:i:s');
            $updated_at = $faker->dateTimeBetween($created_at)->format('Y-m-d H:i:s');
            $authors[] = [
                'author_name' => $faker->name(),
                'author_bio'  => $faker->realTextBetween(50, 100, 1),
                'created_at'    => $created_at, 
                'updated_at'    => $updated_at
            ];
        } // dd($authors);       
        $this->db->table('authors')->insertBatch($authors, true);
    }
}
