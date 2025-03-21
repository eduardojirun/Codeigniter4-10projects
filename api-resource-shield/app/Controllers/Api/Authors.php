<?php

namespace App\Controllers\Api;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Authors extends ResourceController
{
    protected $modelName = "App\Models\Authors";
    protected $format = "xml"; // xml
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $pager = service('pager');
        $pager->setPath('authors', 'default');
        $limit = (int) ( $this->request->getGet('limit') ) ? $this->request->getGet('limit') : 20;
        $sort = $this->request->getGet('sort') ?? 'desc';
        $order_by = $this->request->getGet('order_by') ?? 'author_id'; 
        $keywords = $this->request->getGet('search'); 
        
        $this->format = $this->request->getGet('format') ?? 'json';

        if ( $keywords && !is_numeric($keywords) ) {
            $data = [
                'total' => $this->model->search($keywords)->countAllResults(),
                'limit' => $limit,
                'authors' => $this->model->search($keywords)->orderBy($order_by, $sort)->paginate($limit, 'default'),
                'pager'   => $pager->only(['search', 'sort', 'limit', 'order_by', 'start'])->links('default'),
            ]; // dd($data);
        } else {            
            $authorsBooks = $this->model->authorsBooks()->orderBy($order_by, $sort)->paginate($limit, 'default'); // dd( $authorsBooks );
            
            // Agrupando por author_id con helper array de CI
            helper('array');
            $group_authors = array_group_by($authorsBooks, ['author_id']); // dd($group_authors);

            // Agrupando y eliminando redundancias
            $authors = [];
            if ( $group_authors ) {
                foreach ( $group_authors as $author_id => $author ) { // d($author);
                    $books = [];
                    foreach ( $author as $value ) {
                        // d($value);
                        $books[] = [ 'book_name' => $value['book_name'], 'book_description' => $value['book_description'] ];
                    } // d($authors);                
                        $authors[$author_id] = [
                            'author_id'           => $author[0]['author_id'],
                            'author_name'         => $author[0]['author_name'],
                            'author_bio'          => $author[0]['author_bio'],
                            'books'               => $books
                        ];                
                } // dd($authors);
                $data = [
                    'total'                         =>  $this->model->countAll(),
                    'limit'                         => $limit,
                    'authors'                       => $authors,
                    'pager'                         => $pager->only(['search', 'sort', 'limit', 'order_by', 'start'])->links('default'),
                ]; // dd($data);
            }            
        }
        return $this->respond($data, 200);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        //
    }
}
