<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Projects extends Migration
{
   public function up()
    {
        $this->forge->addField([
            "project_id" => [
                "type" => "INT",
                "auto_increment" => true,
                "unsigned" => true
            ],
            "user_id" => [
                "type" => "INT",
                "unsigned" => true
            ],
            "project_name" => [
                "type" => "VARCHAR",
                "constraint" => 100,
                "null" => false
            ],
            "project_budget" => [
                "type" => "VARCHAR",
                "constraint" => 10,
                "null" => false
            ],
            "project_description" => [
                "type" => "TEXT"
            ],
            "created_at datetime default current_timestamp"
        ]);

        $this->forge->addPrimaryKey("project_id");
        $this->forge->createTable("projects");
    }

    public function down()
    {
        $this->forge->dropTable("projects");
    }
}
