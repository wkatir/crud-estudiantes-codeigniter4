<?php

namespace App\Controllers;

use App\Models\AlumnoModel;
use App\Models\CarreraModel;

class Alumnos extends BaseController
{
    protected $alumnoModel;
    protected $carreraModel;

    public function __construct()
    {
        $this->alumnoModel = new AlumnoModel();
        $this->carreraModel = new CarreraModel();
    }

    public function index()
    {
        $data['alumnos'] = $this->alumnoModel
            ->select('alumnos.*, carrera.nombre_carrera')
            ->join('carrera', 'carrera.codigo_carrera = alumnos.codigo_carrera', 'left')
            ->findAll();
        return view('alumnos/index', $data);
    }

    public function create()
    {
        $data['carreras'] = $this->carreraModel->findAll();
        return view('alumnos/create', $data);
    }

    public function store()
    {
        $data = [
            'codigo'         => $this->request->getPost('codigo'),
            'nombre'         => $this->request->getPost('nombre'),
            'apellido'       => $this->request->getPost('apellido'),
            'telefono'       => $this->request->getPost('telefono'),
            'codigo_carrera' => $this->request->getPost('codigo_carrera'),
        ];

        if (!$this->alumnoModel->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $this->alumnoModel->errors());
        }

        return redirect()->to('/alumnos')->with('success', 'Alumno registrado correctamente.');
    }

    public function edit($id)
    {
        $data['alumno'] = $this->alumnoModel->find($id);

        if (!$data['alumno']) {
            return redirect()->to('/alumnos')->with('error', 'Alumno no encontrado.');
        }

        $data['carreras'] = $this->carreraModel->findAll();
        return view('alumnos/edit', $data);
    }

    public function update($id)
    {
        $alumno = $this->alumnoModel->find($id);

        if (!$alumno) {
            return redirect()->to('/alumnos')->with('error', 'Alumno no encontrado.');
        }

        $data = [
            'id'             => $id,
            'codigo'         => $this->request->getPost('codigo'),
            'nombre'         => $this->request->getPost('nombre'),
            'apellido'       => $this->request->getPost('apellido'),
            'telefono'       => $this->request->getPost('telefono'),
            'codigo_carrera' => $this->request->getPost('codigo_carrera'),
        ];

        if (!$this->alumnoModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $this->alumnoModel->errors());
        }

        return redirect()->to('/alumnos')->with('success', 'Alumno actualizado correctamente.');
    }

    public function delete($id)
    {
        $alumno = $this->alumnoModel->find($id);

        if (!$alumno) {
            return redirect()->to('/alumnos')->with('error', 'Alumno no encontrado.');
        }

        $this->alumnoModel->delete($id);
        return redirect()->to('/alumnos')->with('success', 'Alumno eliminado correctamente.');
    }
}
