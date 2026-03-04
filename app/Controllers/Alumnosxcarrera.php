<?php

namespace App\Controllers;

use App\Models\Alumno_carreraModel;
use App\Models\CarreraModel;

class Alumnosxcarrera extends BaseController
{
    public function index()
    {
        $carreraModel = new CarreraModel();

        $data['carreras'] = $carreraModel->findAll();
        $data['alumnos'] = [];

        return view('alumnos/alumnos_view', $data);
    }

    public function filtrar()
    {
        $carreraModel = new CarreraModel();
        $alumnoCarreraModel = new Alumno_carreraModel();
        $codigo_carrera = $this->request->getPost('codigo_carrera');

        $data['carreras'] = $carreraModel->findAll();
        $data['alumnos'] = $alumnoCarreraModel->obtenerAlumnosPorCarrera($codigo_carrera);
        $data['codigo_carrera_seleccionada'] = $codigo_carrera;

        return view('alumnos/alumnos_view', $data);
    }
}
