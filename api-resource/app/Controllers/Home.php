<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function _index(): string
    {
        // Ejecución de migraciones desde controlador
        $migrate = \Config\Services::migrations();
        try {
            // $migrate->latest();
            // regress(-1); // último cambio
            // -1 ultimo cambio
            // 0 ninguna migración
            // $migrate->regress(-1);
            // php spark migrate:rollback -b -1 ( bes el batch)            
        } catch (\Throwable $e) {
            echo $e;
        }
        
        // Ejecución de seeders desde controlador
        $seeder = \Config\Services::seeder();
        $seeder->call('NombreArchivo');

        // desde linea de comandos
        // php spark db:seed NombreArchivo
        
        return view('welcome_message');
    }

    public function runMigrateSeeds()
    {
        $migrate = \Config\Services::migrations();
        if ( $migrate->latest() ) {
            $seeder = \Config\Services::seeder();
            $seeder->call('Books');
            $seeder->call('Authors');
            $seeder->call('BooksAuthors');
        }
    }

    public function jqueryClient()
    {
        return view('books/index');
    }

    public function curlClient()
    {
        $options = [
            'baseURI' => 'http://localhost/ci4/Codeigniter4-10projects/api-resource/api/',
            'timeout' => 3,
        ];
        $client = service('curlrequest', $options); // Since v4.5.0, this code is recommended due to performance improvements
        $response = $client->request('GET', 'books');

        if ($this->request->isAJAX()) {
            // echo $response->getStatusCode();
            echo $response->getBody();
            // echo $response->header('Content-Type');
            /* if (str_contains($response->header('content-type'), 'application/json')) {
                $body = json_decode($response->getBody());
                echo $body;
            }  */  
            // $language = $response->negotiateLanguage(['en', 'fr']);
            // return view('books/index');
            

        } else {
            $arrayBooks = json_decode($response->getBody(), true);
            // dd($arrayBooks);
            return view('books_array/index', $arrayBooks);
        }        
    }

    public function booksAjax()
    {
        return view('books_ajax/index');
    }
}
