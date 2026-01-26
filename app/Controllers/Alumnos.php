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
        $this->alumnoModel->save([
            'nombre' => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'telefono' => $this->request->getPost('telefono'),
        ]);
        return redirect()->to('/alumnos');
    }

    public function edit($id)
    {
        $data['alumno'] = $this->alumnoModel->find($id);
        return view('alumnos/edit', $data);
    }

    public function update($id)
    {
        $this->alumnoModel->update($id, [
            'nombre' => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'telefono' => $this->request->getPost('telefono'),
        ]);
        return redirect()->to('/alumnos');
    }

    public function delete($id)
    {
        $this->alumnoModel->delete($id);
        return redirect()->to('/alumnos');
    }
}
