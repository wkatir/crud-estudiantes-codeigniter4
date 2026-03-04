<?php

namespace App\Controllers;

use App\Models\HorarioModel;

class AlumnosxMateria extends BaseController
{
    protected $horarioModel;

    public function __construct()
    {
        $this->horarioModel = new HorarioModel();
    }

    public function index()
    {
        $data['materias'] = $this->horarioModel->obtenerMaterias();
        $data['alumnos'] = [];
        return view('alumnosxmateria/index', $data);
    }

    public function filtrar()
    {
        $id_materia = $this->request->getPost('id_materia');

        $data['materias'] = $this->horarioModel->obtenerMaterias();
        $data['alumnos'] = $this->horarioModel->obtenerAlumnosPorMateria($id_materia);
        $data['id_materia_seleccionada'] = $id_materia;

        return view('alumnosxmateria/index', $data);
    }
}
