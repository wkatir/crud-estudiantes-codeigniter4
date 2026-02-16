<?php

namespace App\Controllers;

use App\Models\AlumnoModel;

class Alumnos extends BaseController
{
    protected $alumnoModel;

    public function __construct()
    {
        $this->alumnoModel = new AlumnoModel();
    }

    public function index()
    {
        $data['alumnos'] = $this->alumnoModel->findAll();
        return view('alumnos/index', $data);
    }

    public function create()
    {
        return view('alumnos/create');
    }

    public function store()
    {
        $data = [
            'codigo'   => $this->request->getPost('codigo'),
            'nombre'   => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'telefono' => $this->request->getPost('telefono'),
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

        return view('alumnos/edit', $data);
    }

    public function update($id)
    {
        $alumno = $this->alumnoModel->find($id);

        if (!$alumno) {
            return redirect()->to('/alumnos')->with('error', 'Alumno no encontrado.');
        }

        $data = [
            'codigo'   => $this->request->getPost('codigo'),
            'nombre'   => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'telefono' => $this->request->getPost('telefono'),
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
