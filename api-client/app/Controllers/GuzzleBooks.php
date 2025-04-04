<?php
namespace App\Controllers;
use GuzzleHttp;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class GuzzleBooks extends BaseController
{
    private $client;
    private $base_uri = 'http://localhost/ci4/Codeigniter4-10projects/api-resource/api/';

    public function __construct()
    {
        $this->client = new GuzzleHttp\Client([
            // Base URI is used with relative requests
            'base_uri' => $this->base_uri,
        ]);
    }

    /**
     * Get data resource in JSON format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $response = $this->client->request('GET', 'books');
        d($response->getStatusCode());       
        d($response->getHeader('content-type')[0]);
        d($response->getBody());
        d($response);
    }
     
    /**
     * Get a resource with id.
     *
     * @param int|string $id
     *
     * @return ResponseInterface
     */
    public function show( int|string $book_id )
    {
        $response = $this->client->request('GET', 'books/'.$book_id);                
        d($response->getStatusCode());       
        d($response->getHeader('content-type')[0]);
        d($response->getBody());
        d($response);
    }
    
    /**
     * Create a new resource, from "form_params".
     *
     * @return ResponseInterface
     */
    public function createBooks()
    {
        $response = $this->client->post('books', [
            'form_params' => [
                'book_name' => 'el libro chinguetas 2',
                'book_description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit dolorem vitae hic consequatur unde, doloribus earum excepturi voluptate, dolore sint ratione vel neque minus magni. Repudiandae maiores omnis sint iste?',
                'authors' => [
                    0 => [
                        'author_name' => 'totoyito de la muerte',
                        'author_bio'    => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit dolorem vitae hic consequatur unde, doloribus earum excepturi voluptate, dolore sint ratione vel neque minus magni. Repudiandae maiores omnis sint iste?'
                    ]                    
                ]
            ]
        ]);

        $body = $response->getBody();
        $arr_body = json_decode($body);
        print_r($arr_body);
        d($response);
    }

    /**
     * Update a resource, from "form_params".
     *
     * @param int|string $id
     *
     * @return ResponseInterface
     */
    public function updateBooks( int|string $book_id )
    {
        $response = $this->client->request('PUT', 'books/'.$book_id, [
            'form_params' => [
                'book_name' => 'el libro chinguetas 2 edit',
                'book_description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit dolorem vitae hic consequatur unde, doloribus earum excepturi voluptate, dolore sint ratione vel neque minus magni. Repudiandae maiores omnis sint iste?',
                'authors' => [
                    0 => [
                        'author_name' => 'totoyito de la muerte edit',
                        'author_bio'    => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit dolorem vitae hic consequatur unde, doloribus earum excepturi voluptate, dolore sint ratione vel neque minus magni. Repudiandae maiores omnis sint iste?'
                    ]                    
                ]
            ]
        ]);
         
        $body = $response->getBody();
        $arr_body = json_decode($body);
        d($arr_body);
        dd($response);
    }

    /**
     * Delete the designated resource.
     *
     * @param int|string $id
     *
     * @return ResponseInterface
     */
    public function deleteBook( int|string $book_id )
    {
        if ( $book_id > 0 ) {
            $response = $this->client->request('DELETE', 'books/'.$book_id);
            $code = $response->getStatusCode(); d($code); // 200
            $reason = $response->getReasonPhrase(); d($reason); // OK
            dd($response);
        } else {
            echo 'No se encontró el identificador';
        }        
    }

    /**
     * Partially updates a resource, with a formatted JSON in "form_params".
     *
     * @param int|string $id
     *
     * @return ResponseInterface
     */
    public function patchBook( int|string $book_id  )
    {
        $response = $this->client->request('PATCH',  'books/'.$book_id, [
            'form_params' => [
               'book_status' => '0',
            ]
        ]);        
        $body = $response->getBody();
        $arr_body = json_decode($body);
        d($arr_body);
        dd($response);
    }
}
