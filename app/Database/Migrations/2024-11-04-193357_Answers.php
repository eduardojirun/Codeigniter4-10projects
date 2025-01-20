<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Answers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'answer_id' => [
                'type'  => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'answer' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'answer_description' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'question_id' => [
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
        $this->forge->addPrimaryKey('answer_id');
        $this->forge->addForeignKey('question_id', 'questions', 'question_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('answers');
    }

    public function down()
    {
        $this->forge->dropTable('answers');
    }
}
