<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TokenBlacklisted extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "token_id" => [
                "type" => "INT",
                "auto_increment" => true,
                "unsigned" => true
            ],
            "token" => [
                "type" => "TEXT",
                "null" => false
            ],
            "created_at datetime default current_timestamp"
        ]);
        $this->forge->addPrimaryKey("token_id");
        $this->forge->createTable("token_blacklisted");
    }
    public function down()
    {
        $this->forge->dropTable("token_blacklisted");
    }
}
