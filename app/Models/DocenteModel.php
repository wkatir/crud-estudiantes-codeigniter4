<?php

namespace App\Models;

use CodeIgniter\Model;

class DocenteModel extends Model
{
    protected $table = 'docentes';
    protected $primaryKey = 'id_docente';
    protected $allowedFields = ['nombre_docente'];

    protected $validationRules = [
        'nombre_docente' => 'required|min_length[2]|max_length[100]',
    ];

    protected $validationMessages = [
        'nombre_docente' => [
            'required'   => 'El nombre del docente es obligatorio.',
            'min_length' => 'El nombre debe tener al menos 2 caracteres.',
            'max_length' => 'El nombre no puede exceder 100 caracteres.',
        ],
    ];
}
