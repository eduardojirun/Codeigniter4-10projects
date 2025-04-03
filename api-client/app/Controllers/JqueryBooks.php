<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class JqueryBooks extends BaseController
{
    public function index()
    {
        return view('jquery/index');
    }
}
