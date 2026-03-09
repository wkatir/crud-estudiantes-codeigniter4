<?php

namespace App\Controllers;

use App\Models\MatriculaModel;

class MateriasxAlumno extends BaseController
{
    protected $matriculaModel;

    public function __construct()
    {
        $this->matriculaModel = new MatriculaModel();
    }

    public function index()
    {
        $data['alumnos'] = $this->matriculaModel->obtenerAlumnos();
        $data['materias'] = [];
        return view('materiasxalumno/index', $data);
    }

    public function filtrar()
    {
        $id_alumno = $this->request->getPost('id_alumno');

        $data['alumnos'] = $this->matriculaModel->obtenerAlumnos();
        $data['materias'] = $this->matriculaModel->obtenerMateriasPorAlumno($id_alumno);
        $data['id_alumno_seleccionado'] = $id_alumno;

        return view('materiasxalumno/index', $data);
    }
}
