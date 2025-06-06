<?php
namespace App\Controllers;

use CodeIgniter\Controller;
// use CodeIgniter\Shield\Models\UserModel;
// use CodeIgniter\Shield\Authentication\Auth;

class Auth extends Controller
{
    public function logout()
    {
        // Obtener la instancia del servicio de autenticación
        $auth = service('authentication');

        // Cerrar la sesión del usuario
        $auth->logout();

        // Redirigir a la página de inicio o cualquier otra página
        return redirect()->to('/');
    }
}