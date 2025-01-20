<?php

namespace App\Models;

use CodeIgniter\Model;

class QuizzesModel extends Model
{
    protected $table            = 'quizzes';
    protected $primaryKey       = 'quiz_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['quiz_name', 'quiz_description'];

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
   /*  protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true; */

    // Callbacks
   /*  protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = []; */

    // Separando el where
    public function banned()
    {
        $this->builder()->where( 'created_at <=', date('Y-m-d') );
        return $this; // This will allow the call chain to be used.
    }

    // Search
    public function search( $keywords )
    {
        $fields_search = ['quiz_name', 'quiz_description'];
        $this->builder()->groupStart();
            $this->builder()->like( $fields_search[0], $keywords );
            for ( $i = 1; $i < count( $fields_search ); $i++ ) {
                $this->builder()->orLike( $fields_search[$i], $keywords );
            }
        $this->builder()->groupEnd();
        return $this;
    }

    // Join
    public function getPagination(?int $perPage = null): array
    {
        $this->builder()
            ->select('news.*, category.name')
            ->join('category', 'news.category_id = category.id');

        return [
            'news'  => $this->paginate($perPage),
            'pager' => $this->pager,
        ];
    }

    // Search
    /* public function get( 
        $where = null, 		// [ campo = valor ]
        $limit = null, 			// 20
        $start = 0, 			// 0
        $sort = 'asc', 			// 'asc', 'desc',
        $order_by = null, 		// 'campo'
        $keywords = null, 		// 'palabra clave'
        $fields_search = null 	// 'usuario'
        )
    {
        if ( $where ) {

            if( $limit ) $this->db->limit( $limit, $start );
            if( $order_by ) $this->db->order_by( $order_by, $sort );
            $this->db->select( $fields )->where( $where );

            if ( $keywords != null AND  $fields_search != null ) {
                $this->db->group_start();
                    $this->db->like( $fields_search[0], $keywords );
                    for ( $i = 1; $i < count( $fields_search ); $i++ ) {
                        $this->db->or_like( $fields_search[$i], $keywords );
                    }
                $this->db->group_end();
            }
            $query = $this->db->get( $table );

            if ( $query && $type === 'object' ) return $query->result();
            if ( $query && $type === 'array' ) return $query->result_array();
            return null;
        }


        if ( $keywords != null AND  $fields_search != null ) {
            $this->db->like( $fields_search[0], $keywords );
            for ( $i = 1; $i < count( $fields_search ); $i++ ) {
                $this->db->or_like( $fields_search[$i], $keywords );
            }
        }

        if( $limit ) $this->db->limit( $limit, $start );		
        if( $order_by ) $this->db->order_by( $order_by, $sort );
        $query = $this->db->select( $fields )->get( $table );

        if ( $query->num_rows() > 0 && $type === 'object' ) return $query->result();
        if ( $query->num_rows() > 0 && $type === 'array' ) return $query->result_array();

        return null;
    } */
}
