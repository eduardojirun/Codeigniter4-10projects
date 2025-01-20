<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class Questions extends Seeder
{
    public function run()
    {
        $faker = Factory::create('es_ES');
        $questions = [];
        $quiz = 1;
        for ($quiz=1; $quiz <= 80; $quiz++) { 
                for ($i=0; $i < 5; $i++) {
                $created_at = $faker->dateTime()->format('Y-m-d H:i:s');
                $updated_at = $faker->dateTimeBetween($created_at)->format('Y-m-d H:i:s');
                $questions[] = [
                    'question' => $faker->realTextBetween(50, 100, 1),
                    'question_description' => $faker->realTextBetween(50, 100, 1),
                    'quiz_id' => $quiz,
                    'created_at'    => $created_at, 
                    'updated_at'    => $updated_at
                ];
            } 
        } // dd($questions);
        $this->db->table('questions')->insertBatch($questions, true, 400);
    }
}
