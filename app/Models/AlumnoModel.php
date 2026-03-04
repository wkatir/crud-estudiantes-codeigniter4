<?php

namespace App\Models;

use CodeIgniter\Model;

class AlumnoModel extends Model
{
    protected $table = 'alumnos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['codigo', 'nombre', 'apellido', 'telefono', 'codigo_carrera'];

    protected $validationRules = [
        'id'       => 'permit_empty|is_natural_no_zero',
        'codigo'   => 'required|min_length[2]|max_length[20]|alpha_numeric|is_unique[alumnos.codigo,id,{id}]',
        'nombre'   => 'required|min_length[2]|max_length[100]|alpha_space',
        'apellido' => 'required|min_length[2]|max_length[100]|alpha_space',
        'telefono'       => 'required|min_length[7]|max_length[15]|numeric',
        'codigo_carrera' => 'required',
    ];

    protected $validationMessages = [
        'codigo' => [
            'required'      => 'El código es obligatorio.',
            'min_length'    => 'El código debe tener al menos 2 caracteres.',
            'max_length'    => 'El código no puede exceder 20 caracteres.',
            'alpha_numeric' => 'El código solo puede contener letras y números.',
            'is_unique'     => 'Este código ya está registrado por otro alumno.',
        ],
        'nombre' => [
            'required'   => 'El nombre es obligatorio.',
            'min_length' => 'El nombre debe tener al menos 2 caracteres.',
            'max_length' => 'El nombre no puede exceder 100 caracteres.',
            'alpha_space' => 'El nombre solo puede contener letras y espacios.',
        ],
        'apellido' => [
            'required'   => 'El apellido es obligatorio.',
            'min_length' => 'El apellido debe tener al menos 2 caracteres.',
            'max_length' => 'El apellido no puede exceder 100 caracteres.',
            'alpha_space' => 'El apellido solo puede contener letras y espacios.',
        ],
        'telefono' => [
            'required'   => 'El teléfono es obligatorio.',
            'min_length' => 'El teléfono debe tener al menos 7 dígitos.',
            'max_length' => 'El teléfono no puede exceder 15 dígitos.',
            'numeric'    => 'El teléfono solo puede contener números.',
        ],
        'codigo_carrera' => [
            'required' => 'La carrera es obligatoria.',
        ],
    ];
}
