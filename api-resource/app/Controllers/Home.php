<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
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
}
