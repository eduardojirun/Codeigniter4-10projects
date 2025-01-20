<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Quizzes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'quiz_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'quiz_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'quiz_description' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME'
            ],
            'created_at datetime default current_timestamp',
        ]);
        $this->forge->addPrimaryKey('quiz_id');
        $this->forge->createTable('quizzes');
    }

    public function down()
    {
        $this->forge->dropTable('quizzes');
    }
}
