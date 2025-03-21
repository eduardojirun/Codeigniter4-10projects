<?php

namespace App\Controllers\Api;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Authors;
use App\Models\BooksAuthors;

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
                        $authors[] = [
                            'author_id'   => $value['author_id'], 
                            'author_name' => $value['author_name'], 
                            'author_bio'  => $value['author_bio'] 
                        ];
                    } // d($authors);                
                        $books[$book_id] = [
                            'book_id'           => $book[0]['book_id'],
                            'book_name'         => $book[0]['book_name'],
                            'book_description'  => $book[0]['book_description'],
                            'created_at'        => $book[0]['created_at'],
                            'updated_at'        => $book[0]['updated_at'],
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
        $validation = service('validation');
        $AuthorsModel = new Authors();
        $BooksAuthorsModel = new BooksAuthors();

        $validation->setRules([
            'book_name' => [
                'label' => 'Título libro', 
                'rules' => 'required|min_length[2]|max_length[50]', 
                'errors' => [
                    'min_length' => 'Supplied value ({value}) for {field} must have at least {param} characters.',
                ],
            ],
            'book_description' => [
                'label' => 'Descripción libro', 
                'rules' => 'required|min_length[8]|max_length[500]', 
                'errors' => [
                    'min_length' => 'Supplied value ({value}) for {field} must have at least {param} characters.',
                ],
            ],

            'authors.*.author_name' => [
                'label' => 'Nombre autor', 
                'rules' => 'required|min_length[2]|max_length[50]', 
                'errors' => [
                    'required'  => 'Al menos un author es requerido',
                    'min_length' => 'Supplied value ({value}) for {field} must have at least {param} characters.',
                ],
            ],
            'authors.*.author_bio' => [
                'label' => 'Biografia author', 
                'rules' => 'required|min_length[8]|max_length[500]', 
                'errors' => [
                    'required'  => 'Al menos una biografia de author es requerido',
                    'min_length' => 'Supplied value ({value}) for {field} must have at least {param} characters.',
                ],
            ]
        ]);

        $data = $this->request->getPost();
        if ( !$validation->run($data) ) {
            // Display Errors
            // return $this->failValidationErrors($validation->getErrors(), 422); // 422 or 400 
            return $this->fail($validation->getErrors(), 422);
        }
        // Add Book to Table
        $insert_book = $this->model->insert([
            "book_name"         => esc($data['book_name']), // &lt;script&gt;alert(&#039;hi&#039;)&lt;/script&gt;
            "book_description"  => strip_tags($data['book_description']) // y el que no es jefe
            // "book_description"  => htmlspecialchars($data['book_description']) // &lt;button&gt;y el que no es jefe&lt;/button&gt;
        ]);
        // Sustituir pos transaction
        if( $insert_book ) {
            $authors =  $this->request->getPost('authors'); // var_dump($authors);
            // almacenar ids para eliminacion en caso de fallo
            $inserts_ids_a = [];   
            $inserts_ids_ba = [];
            foreach ( $authors as $author ) {
                $insert_author = $AuthorsModel->insert([
                    "author_name"           => esc($author['author_name']),
                    "author_bio"            => strip_tags($author['author_bio']) 
                ]);
                $inserts_ids_a[] = $insert_author;
                if ( $insert_author ) {
                    $insert_book_author = $BooksAuthorsModel->insert([
                        "book_id"              => esc($insert_book),
                        "author_id"            => esc($insert_author) 
                    ]);
                    if ( $insert_book_author) {
                        $inserts_ids_ba[] = $insert_book_author;
                    } else {
                        // Eliminar registros de authors y books para integridad la db
                        // Registros se eliminan en cascada de Authors y BooksAuthors
                        $del_book = $this->model->delete($insert_book);
                        $del_author = $AuthorsModel->delete($insert_author);
                        return $this->respond([
                            "status" => false,
                            "message" => "No se pudieron guardar los datos BookAuthor"
                        ]);
                    }
                } else {
                    // Failed Block
                    // Eliminar registros de books para integridad de db
                    // Registros se eliminan en cascada de Authors y BooksAuthors
                    $del_book = $this->model->delete($insert_book);
                    return $this->respond([
                        "status" => false,
                        "message" => "No se pudieron guardar datos Author"
                    ]);
                }
            } // END foreach 
            if ($inserts_ids_ba) {
                // Success Block
                $data = [
                    'message'   => 'Creado satisfactoriamente',
                    'idb'       => $insert_book,
                    'idsa'      => $inserts_ids_a,
                    'idsba'     => $inserts_ids_ba
                ];
                $inserts_ids_ba = $insert_book_author;
                return $this->respondCreated($data);
            }
        } else {
            // Failed Block
            return $this->respond([
                "status" => false,
                "message" => "No se pudieron guardar los datos Book"
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
            $validation = service('validation');
            $validation->setRules([
                'book_name' => [
                    'label' => 'Título libro', 
                    'rules' => 'required|min_length[2]|max_length[50]', 
                    'errors' => [
                        'min_length' => 'Supplied value ({value}) for {field} must have at least {param} characters.',
                    ],
                ],
                'book_description' => [
                    'label' => 'Descripción libro', 
                    'rules' => 'required|min_length[8]|max_length[500]', 
                    'errors' => [
                        'min_length' => 'Supplied value ({value}) for {field} must have at least {param} characters.',
                    ],
                ]
            ]);

            // $data = $this->request->getPost(); // No work to put
            $data = $this->request->getRawInput(); // var_dump( $data );die('die');
            if ( !$validation->run($data) ) {
                // Display Errors
                // return $this->failValidationErrors($validation->getErrors(), 422); // 422 or 400 
                return $this->fail($validation->getErrors(), 422);
                
            } else {                
                // Add Book to Table
                $update_book = $this->model->update( $book_id, [
                    'book_name'            => esc($data['book_name']),
                    'book_description'     => esc($data['book_description'])
                ]);

                if ( $update_book ) {
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
