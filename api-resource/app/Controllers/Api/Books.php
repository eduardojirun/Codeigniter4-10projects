<?php

namespace App\Controllers\Api;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
// use App\Models\BooksModel;

class Books extends ResourceController
{
    protected $modelName = "App\Models\Books";
    protected $format = "json"; // xml

    public function __construct() {
    }
    
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $pager = service('pager');
        $pager->setPath('books', 'default');
        $limit = (int) ( $this->request->getGet('limit') ) ? $this->request->getGet('limit') : 20;
        $sort = $this->request->getGet('sort') ?? 'desc';
        $order_by = $this->request->getGet('order_by') ?? 'book_id'; 
        $keywords = $this->request->getGet('search');
        
        $this->format = $this->request->getGet('format') ?? 'json';

        if ( $keywords && !is_numeric($keywords) ) {
            $data = [
                'total' => $this->model->search($keywords)->countAllResults(),
                'limit' => $limit,
                'books' => $this->model->search($keywords)->orderBy($order_by, $sort)->paginate($limit, 'default'),
                'pager'   => $pager->only(['search', 'sort', 'limit', 'order_by', 'start'])->links('default'),
            ]; // dd($data);
        } else {            
            $booksAuthors = $this->model->booksAuthors()->orderBy($order_by, $sort)->paginate($limit, 'default'); // dd( $booksAuthors );
            
            // Agrupando por book_id con helper array de CI
            helper('array');
            $group_books = array_group_by($booksAuthors, ['book_id']);

            // Agrupando y eliminando redundancias
            $books = [];
            if ( $group_books ) {
                foreach ( $group_books as $book_id => $book ) { // d($book);
                    $authors = [];
                    foreach ( $book as $value ) {
                        // d($value);
                        $authors[] = [ 'author_name' => $value['author_name'], 'author_bio' => $value['author_bio'] ];
                    } // d($authors);                
                        $books[$book_id] = [
                            'book_id'           => $book[0]['book_id'],
                            'book_name'         => $book[0]['book_name'],
                            'book_description'  => $book[0]['book_description'],
                            'authors'           => $authors
                        ];                
                } // dd($books);
                $data = [
                    'total' =>  $this->model->countAll(),
                    'limit' => $limit,
                    'books' => $books,
                    'pager' => $pager->only(['search', 'sort', 'limit', 'order_by', 'start'])->links('default'),
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
    public function show( $book_id = null )
    {
        $book = $this->model->find( $book_id );
        if( !empty($book) ) {
            return $this->respond([
                "status" => true,
                "message" => "Datos del Libro",
                "data" => $book
            ], 200);
        } else {
            // Resource Not Found, 404
            $description = "No se pudieron eliminar los datos";
            return $this->failNotFound($description);
        }
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $rules = [
            'book_name'            => 'required|min_length[2]|max_length[50]',
            'book_description'     => 'required|min_length[10]|max_length[100]',
        ];
        if ( !$this->validate($rules) ) {
            // Display Errors
            // return $this->failValidationErrors($this->validator->getErrors(), 422); // 422 or 400 
            return $this->fail($this->validator->getErrors(), 422);
        }

        $data = $this->request->getPost(); // var_dump($this->request->getRawInput()); die();
        // Add Book to Table
        $insert = $this->model->insert([
            "book_name"         => $data['book_name'],
            "book_description"  => $data['book_description']
        ]);
        if( $insert ) {
            // Success Block
            $data = [
                'message' => 'Creado satisfactoriamente',
                'id'        => $insert
            ];
            return $this->respondCreated($data);
        } else {
            // Failed Block
            return $this->respond([
                "status" => false,
                "message" => "No se pudieron eliminar los datos"
            ]);
        }        
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
    public function update( $book_id = null )
    {
        $book = $this->model->find( $book_id );
        if( !empty($book) ) {
            $rules = [
                'book_name'            => 'required|min_length[5]|max_length[20]',
                'book_description'     => 'required',
            ];
            if ( !$this->validate($rules) ) {
                // Display Errors
                return $this->fail($this->validator->getErrors(), 422);
            } else {
                $input = $this->request->getRawInput(); // var_dump( $input );die('die');
                $update = $this->model->update($book_id, $input);
                if ( $update ) {
                    return $this->respond($book, 200);
                } else {
                    return $this->respond(
                        [
                            'message' => 'Book updated failed',
                            'status' => false
                        ],
                        ResponseInterface::HTTP_NOT_FOUND
                    );
                }    
            }
        } else {
            return $this->respond([
                "status" => false,
                "message" => "book doesn't exists with this ID"
            ]);
        } 
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($book_id = null)
    {
        $book = $this->model->find( $book_id );
        if( !empty($book) ) {
            if( $this->model->delete($book_id) ) {
                $data = ['message' => 'Eliminado correctamente'];
                return $this->respondDeleted($data);
            } else {
                return $this->respond([
                    "status" => false,
                    "message" => "No se pudieron eliminar los datos"
                ]);
            }
        } else {
            // Resource Not Found, 404
            $description = "No existe el identificador";
            return $this->failNotFound($description);
        }
    }
}
