<?php

namespace App\Models;

use CodeIgniter\Model;

class MateriaModel extends Model
{
    protected $table = 'materias';
    protected $primaryKey = 'id_materia';
    protected $allowedFields = ['nombre_materia'];

    protected $validationRules = [
        'nombre_materia' => 'required|min_length[2]|max_length[100]',
    ];

    protected $validationMessages = [
        'nombre_materia' => [
            'required'   => 'El nombre de la materia es obligatorio.',
            'min_length' => 'El nombre debe tener al menos 2 caracteres.',
            'max_length' => 'El nombre no puede exceder 100 caracteres.',
        ],
    ];
}
