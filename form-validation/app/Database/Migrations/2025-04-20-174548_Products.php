<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Products extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'product_id'          => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'product_name'        => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'product_description' => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'product_price'       => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
            ],
            'product_stock'        => [
                'type'       => 'INT',
                'unsigned'   => true,
                'default'    => 0,
            ],
            'product_status'       => [
                'type'       => 'ENUM',
                'constraint' => ['active', 'inactive'],
                'default'    => 'active',
            ],
            'category_id'  => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],
            'created_at'  => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'updated_at'  => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
        ]);

        $this->forge->addPrimaryKey('product_id');
        // $this->forge->addForeignKey('category_id', 'categories', 'category_id', 'CASCADE', 'CASCADE',  'product_fk');
        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}
