<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BooksAuthors extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'book_author_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'author_id' => [
                'type'       => 'BIGINT',
                'unsigned'   => true,
            ],
            'book_id' => [
                'type'       => 'BIGINT',
                'unsigned'   => true,
            ],
        ]);

        // Claves foráneas
        // campoTablaForanea, tablaForanea, campo de esta tabla, onDelete, onUpdate, nombre de clave foranea
        $this->forge->addForeignKey('author_id', 'authors', 'author_id', 'CASCADE', 'CASCADE', 'author_fk');
        $this->forge->addForeignKey('book_id', 'books', 'book_id', 'CASCADE', 'CASCADE', 'book_fk');

        // Clave primaria
        $this->forge->addPrimaryKey('book_author_id');
        $this->forge->createTable('books_authors');
    }

    public function down()
    {
        $this->forge->dropTable('books_authors');
    }
}
