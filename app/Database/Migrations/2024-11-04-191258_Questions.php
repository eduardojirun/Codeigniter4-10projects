<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Questions extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'question_id' => [
                'type'  => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'question' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'question_description' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'quiz_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME'
            ],
            'created_at datetime default current_timestamp',
        ]);
        $this->forge->addPrimaryKey('question_id');
        $this->forge->addForeignKey('quiz_id', 'quizzes', 'quiz_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('questions');
    }

    public function down()
    {
        $this->forge->dropTable('questions');
    }
}
