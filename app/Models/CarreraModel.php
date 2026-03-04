<?php

namespace App\Models;

use CodeIgniter\Model;

class CarreraModel extends Model
{
    protected $table = 'carrera';
    protected $primaryKey = 'codigo_carrera';
    protected $useAutoIncrement = false;
    protected $returnType = 'object';
    protected $allowedFields = ['codigo_carrera', 'nombre_carrera'];

    protected $validationRules = [
        'codigo_carrera' => 'required|max_length[10]',
        'nombre_carrera' => 'required|min_length[2]|max_length[100]',
    ];

    protected $validationMessages = [
        'codigo_carrera' => [
            'required'   => 'El codigo de carrera es obligatorio.',
            'max_length' => 'El codigo no puede exceder 10 caracteres.',
        ],
        'nombre_carrera' => [
            'required'   => 'El nombre de la carrera es obligatorio.',
            'min_length' => 'El nombre debe tener al menos 2 caracteres.',
            'max_length' => 'El nombre no puede exceder 100 caracteres.',
        ],
    ];
}
