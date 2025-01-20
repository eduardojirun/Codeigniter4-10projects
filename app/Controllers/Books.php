<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
// use App\Models\BooksModel;

class Books extends ResourceController
{

    protected $modelName = "App\Models\BooksModel";
    protected $format = "json"; //xml
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $books = $this->model->findAll();
        return $this->respond([
            "status" => true,
            "message" => "Books data",
            "data" => $books
        ]);
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
        $book_data = $this->model->find( $book_id );
        if( !empty($book_data) ) {
            return $this->respond([
                "status" => true,
                "message" => "Book data",
                "data" => $book_data
            ]);
        } else {
            return $this->respond([
                "status" => false,
                "message" => "Book doesn't exists with this ID"
            ]);
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
            'book_name'            => 'required|min_length[5]|max_length[20]',
            'book_description'     => 'required',
        ];
        if ( !$this->validate($rules) ) {
            // Display Errors
            return $this->respond([
                "status" => false,
                "message" => $this->validator->getErrors()
            ]);
        }

        $data = $this->request->getPost(); // var_dump($this->request->getRawInput()); die();
        
        // Add Book to Table
        $insert = $this->model->insert([
            "book_name"         => $data['book_name'],
            "book_description"  => $data['book_description']
        ]);
        if( $insert ) {
            // Success Block
            return $this->respond([
                "status" => true,
                "message" => "Successfully, Book has been created"
            ]);
        } else {
            // Failed Block
            return $this->respond([
                "status" => false,
                "message" => "Failed to add Book"
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
                return $this->respond([
                    "status" => false,
                    "message" => $this->validator->getErrors()
                ]);
            } else {
                $input = $this->request->getRawInput(); // var_dump( $input );die('die');
                $update = $this->model->update($book_id, $input);
                if ( $update ) {
                        return $this->respond(
                        [
                            'message' => 'Book updated successfully',
                            'book' => $book
                        ]
                    );
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
                return $this->respond([
                    "status" => true,
                    "message" => "Book deleted successfully"
                ]);
            } else {
                return $this->respond([
                    "status" => false,
                    "message" => "Failed to delete data"
                ]);
            }
        } else {
            return $this->respond([
                "status" => false,
                "message" => "Book doesn't exists with this id"
            ]);
        }
    }
}
