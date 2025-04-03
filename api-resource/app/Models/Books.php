<?php

namespace App\Models;

use CodeIgniter\Model;

class Books extends Model
{
    protected $table            = 'books';
    protected $primaryKey       = 'book_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['book_name', 'book_description', 'book_status'];

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
        $fields_search = ['book_name', 'book_description'];
        $this->builder()->groupStart();
            $this->builder()->like( $fields_search[0], $keywords );
            for ( $i = 1; $i < count( $fields_search ); $i++ ) {
                $this->builder()->orLike( $fields_search[$i], $keywords );
            }
        $this->builder()->groupEnd();
        return $this;
    }

    // Definir la relación con los autores
    public function booksAuthors()
    {
        $this->select(
            'books.book_id, books.book_name,  books.book_status, books.book_description, books.created_at, books.updated_at, 
            authors.author_id, authors.author_name, authors.author_bio');
        $this->join('books_authors', 'books_authors.book_id = books.book_id');
        $this->join('authors', 'authors.author_id = books_authors.author_id');
        return $this;
    }

    public function saveBookAuthor()
    {
        $this->db->transStart();
        $this->db->query('AN SQL QUERY...');
        $this->db->query('ANOTHER QUERY...');
        $this->db->query('AND YET ANOTHER QUERY...');
        $this->db->transComplete();
    }

}
