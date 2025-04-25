<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    public array $employees = [
        'first_name' => [
            'label' => 'Nombre(s)',
            'rules' => 'required|alpha_space|min_length[2]|max_length[50]',
            'errors' => [
                'required' => 'El campo {field} es obligatorio',
            ]
        ],
        'last_name' => [
            'label' => 'Apellido(s)',
            'rules' => 'required|alpha_space|min_length[2]|max_length[50]',
            'errors' => [
                'required' => 'El campo {field} es obligatorio',
            ]                
        ],
        'email' => [
            'label' => 'Email',
            'rules' => 'required|valid_email',
            'errors' => [
                'required' => 'El campo {field} es obligatorio',
            ]               
        ],
        'birthday' => [
            'label' => 'Fecha de nacimiento',
            'rules' => 'required|valid_date[Y-m-d]',
            'errors' => [
                'required' => 'El campo {field} es obligatorio',
            ]                
        ],
        'gender' => [
            'label' => 'Género',
            'rules' => 'required|in_list[m,f,o]',
            'errors' => [
                'required' => 'El campo {field} es obligatorio',
            ]               
        ],        
        'phone' => [
            'label' => 'Teléfono',
            'rules' => 'required|alpha_numeric_space',
            'errors' => [
                'required' => 'El campo {field} es obligatorio',
            ]                
        ],
        'job_position' => [
            'label' => 'Ocupación',
            'rules' => 'required|alpha_numeric_space|min_length[1]|max_length[50]',
            'errors' => [
                'required' => 'El campo {field} es obligatorio',
            ]                
        ],
        'photo' => [
            'label' => 'Fotografía',
            'rules' => 'uploaded[photo]|is_image[photo]',
            'errors' => [
                'uploaded' => 'El campo {field} es obligatorio',
                'is_image'  => 'El campo {field} no es un archivo de imagen cargado válido'
            ]                
        ],
        'department' => [
            'label' => 'Experiencia',
            'rules' => 'required|alpha_numeric_space|min_length[1]|max_length[500]',
            'errors' => [
                'required' => 'El campo {field} es obligatorio',
            ]               
        ],        
        'salary' => [
            'label' => 'Entrada',
            'rules' => 'required|alpha_numeric_space',
            'errors' => [
                'required' => 'El campo {field} es obligatorio',
            ]
        ],
        'date_admission' => [
            'label' => 'Salida',
            'rules' => 'required|valid_date[Y-m-d]',
            'errors' => [
                'required' => 'El campo {field} es obligatorio',
            ]               
        ],
        'comments' => [
            'label' => 'Comentarios',
            'rules' => 'required|alpha_numeric_space|min_length[1]|max_length[500]',
            'errors' => [
                'required' => 'El campo {field} es obligatorio',
            ]                
        ],
        'active' => [
            'label' => 'Activo',
            'rules' => 'required|in_list[true,false]',
            'errors' => [
                'required' => 'El campo {field} es obligatorio',
            ]                
        ]
    ];
}
