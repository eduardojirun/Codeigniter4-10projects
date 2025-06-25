<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Promotions extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "promotion_id" => [
                "type" => "INT",
                "auto_increment" => true,
                "unsigned" => true
            ],
            "promotion_name" => [
                "type" => "VARCHAR",
                "constraint" => 100,
                "null" => false
            ],
            "promotion_description" => [
                "type" => "TEXT",
                "null" => true
            ],
            "promotion_date_start" => [
                'type' => 'DATETIME',
            ],
            "promotion_date_end" => [
                'type' => 'DATETIME',
            ],
            "created_at datetime default current_timestamp"
        ]);

        $this->forge->addPrimaryKey("promotion_id");
        $this->forge->createTable("promotions");
    }
    public function down()
    {
        $this->forge->dropTable("promotions");
    }
}
