<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Authors extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'author_id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'author_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'author_bio' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME'
            ],
            'updated_at' => [
                'type' => 'DATETIME'
            ],
            'created_at datetime default current_timestamp',
        ]);
        $this->forge->addPrimaryKey('author_id');
        $this->forge->createTable('authors');
    }

    public function down()
    {
        $this->forge->dropTable('authors');
    }
}
