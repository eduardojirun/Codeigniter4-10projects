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

    public function index()
    {
        $response = $this->client->request('GET', 'books');
        d($response->getStatusCode());       
        d($response->getHeader('content-type')[0]);
        d($response->getBody());
        d($response);
    }

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

    public function updateBooks( int $book_id )
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

    public function deleteBook( int $book_id )
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

    public function patchBook( int $book_id  )
    {
        $response = $this->client->request('PATCH',  'books/'.$book_id, [
            'json' => [
               'book_name' => 'el libro chinguetas 2 edit con patch',
            ]
        ]);        
        $body = $response->getBody();
        $arr_body = json_decode($body);
        d($arr_body);
        dd($response);
    }

}
