<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\PromotionsModel;

class PromotionsController extends ResourceController
{
    protected $modelName = "App\Models\PromotionsModel";
    protected $format = "json"; // xml

    public function __construct() {
        date_default_timezone_set( "America/Mexico_City" );
		setlocale( LC_ALL, "es_MX" );
    }
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $promotions = $this->model->findAll();
        if ( $promotions ) {
            return $this->respond([
                "status" => true,
                "message" => "promotions found",
                "data" => $promotions
            ]);
        } else {
            return $this->respond([
                "status" => false,
                "message" => "No projects found"
            ]);
        }
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $validationRules = [
            "promotion_name"            => "required",
            "promotion_description"     => "required",
            "promotion_date_start"      => "required|valid_date",
            "promotion_date_end"        => "required|valid_date",
        ];
        if ( !$this->validate($validationRules) ) {
            return $this->respond([
                "status" => false,
                "message" => "Promotions inputs are required",
                "errors" => $this->validator->getErrors()
            ]);
        }
        if ( $this->model->insert([
            "promotion_name"            => $this->request->getVar("promotion_name"),
            "promotion_date_start"      => $this->request->getVar("promotion_date_start"),
            "promotion_date_end"        => $this->request->getVar("promotion_date_end"),
            "promotion_description"     => $this->request->getVar("promotion_description")
        ]) ) {
            // Success block
            return $this->respond([
                "status" => true,
                "message" => "Successfully, project has been created!"
            ]);
        } else {
            return $this->respond([
                "status" => false,
                "message" => "Failed to create project for this user."
            ]);
        }
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        //
    }

}
