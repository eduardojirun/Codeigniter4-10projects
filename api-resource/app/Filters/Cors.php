<?php 
    namespace App\Filters;
    
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
 
Class Cors implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Permitir todas las fuentes (puedes agregar tu propia lógica para limitar los orígenes)
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        // Si el método es OPTIONS, terminamos la ejecución aquí para evitar el procesamiento adicional
        if ( $method == "OPTIONS" ) {
            die();
        }
    }
 
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
      // Do something here
    }
}