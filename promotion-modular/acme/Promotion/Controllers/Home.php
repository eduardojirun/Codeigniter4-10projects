<?php
namespace Promotion\Controllers;
use App\Controllers\BaseController;

class Home extends BaseController 
{
    public function index() 
    {
        $db = db_connect();
        $query = $db->query('SELECT * FROM promotions');
        $data = $query->getLastRow('array');
        return  view('Promotion\Views\home', $data);
    }
    public function expired() 
    {
        return  view('Promotion\Views\expired');
    }
}