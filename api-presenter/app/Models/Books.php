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
    protected $allowedFields    = ['book_name', 'book_description'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
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

}
