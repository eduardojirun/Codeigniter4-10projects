<?php

namespace App\Models;

use CodeIgniter\Model;

class Products extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['product_name',
                                    'product_description',
                                    'product_price',
                                    'product_stock',
                                    'product_status',
                                    'category_id'
                                ];

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
    protected $validationRules = [   
        'product_name' => 'required|max_length[30]|alpha_numeric_space|min_length[3]',
        'product_description' => 'required|max_length[30]|alpha_numeric_space|min_length[3]',
        'product_price' => 'required|max_length[30]|alpha_numeric_space|min_length[3]',
        'product_stock' => 'required|max_length[30]|alpha_numeric_space|min_length[3]',
        'product_status' => 'required|max_length[30]|alpha_numeric_space|min_length[3]',
        'category_id' => 'required|max_length[30]|alpha_numeric_space|min_length[3]'
    ];
    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Sorry. That email has already been taken. Please choose another.',
        ],
        'product_name'  => [
            'is_unique' => 'Sorry. That email has already been taken. Please choose another.',
        ],
        'product_description'  => [
            'is_unique' => 'Sorry. That email has already been taken. Please choose another.',
        ],
        'product_price' => [
            'is_unique' => 'Sorry. That email has already been taken. Please choose another.',
        ],
        'product_stock' => [
            'is_unique' => 'Sorry. That email has already been taken. Please choose another.',
        ],
        'product_status' => [
            'is_unique' => 'Sorry. That email has already been taken. Please choose another.',
        ],
        'category_id'  => [
            'is_unique' => 'Sorry. That email has already been taken. Please choose another.',
        ]
    ];
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
}
