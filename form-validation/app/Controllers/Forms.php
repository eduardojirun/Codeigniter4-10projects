<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Forms extends ResourceController
{
    protected $helpers = ['form'];

    public function index()
    {
        if (! $this->request->is('post')) {
            return view('form-validation/signup');
        }

        // reglas en array multimensiobal independientes
        $rules = [
            'username' => 'required|max_length[30]',
            'password' => 'required|min_length[10]|max_length[255]',
            'passconf' => 'required|max_length[255]|matches[password]',
            'email'    => 'required|max_length[254]|valid_email',
        ];

        // Obtención de datos post del formulario
        $data = $this->request->getPost(array_keys($rules));
        
        // validación de datos con la reglas
        if (! $this->validateData($data, $rules)) {
            return view('form-validation/signup');
        }

        // para obtener los datos que pasaron la validacion
        $validData = ['validData' => $this->validator->getValidated()];
        return view('form-validation/success', $validData);
    }



    public function listEmployees()
    {
        return view('form-validation/employees');        
    }

    public function saveEmployee()
    {
        $validation = service('validation');
        // Obtención de datos post del formulario
        $data = $this->request->getPost();        
        if ( !$validation->run($data, 'employees') ) {
            // handle validation errors
            return $this->fail($validation->getErrors(), 422);
        } else {
            return $this->respond($data, 200);
        }

        // para obtener los datos que pasaron la validacion
        // $validData = ['validData' => $this->validator->getValidated()];
        // return view('form-validation/success', $validData);
    }
}
