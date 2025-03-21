<?php

namespace App\Models;

use CodeIgniter\Model;

class Authors extends Model
{
    protected $table            = 'authors';
    protected $primaryKey       = 'author_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['author_name', 'author_bio'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // Search
    public function search( $keywords )
    {
        $fields_search = ['author_name', 'author_bio'];
        $this->builder()->groupStart();
            $this->builder()->like( $fields_search[0], $keywords );
            for ( $i = 1; $i < count( $fields_search ); $i++ ) {
                $this->builder()->orLike( $fields_search[$i], $keywords );
            }
        $this->builder()->groupEnd();
        return $this;
    }

    // Definir la relación con los autores
    public function authorsBooks()
    {
        $this->select(
            'authors.author_id, books.book_name, books.book_description, 
            authors.author_name, authors.author_bio');
        $this->join('books_authors', 'books_authors.author_id = authors.author_id');
        $this->join('books', 'books.book_id = books_authors.book_id');
        return $this;
    }
}
