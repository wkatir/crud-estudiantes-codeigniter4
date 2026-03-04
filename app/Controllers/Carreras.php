<?php

namespace App\Controllers;

use App\Models\CarreraModel;

class Carreras extends BaseController
{
    protected $carreraModel;

    public function __construct()
    {
        $this->carreraModel = new CarreraModel();
    }

    public function index()
    {
        $data['carreras'] = $this->carreraModel->findAll();
        return view('carreras/index', $data);
    }

    public function create()
    {
        return view('carreras/create');
    }

    public function store()
    {
        $data = [
            'codigo_carrera' => $this->request->getPost('codigo_carrera'),
            'nombre_carrera' => $this->request->getPost('nombre_carrera'),
        ];

        if (!$this->carreraModel->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $this->carreraModel->errors());
        }

        return redirect()->to('/carreras')->with('success', 'Carrera registrada correctamente.');
    }

    public function edit($codigo)
    {
        $data['carrera'] = $this->carreraModel->find($codigo);

        if (!$data['carrera']) {
            return redirect()->to('/carreras')->with('error', 'Carrera no encontrada.');
        }

        return view('carreras/edit', $data);
    }

    public function update($codigo)
    {
        $carrera = $this->carreraModel->find($codigo);

        if (!$carrera) {
            return redirect()->to('/carreras')->with('error', 'Carrera no encontrada.');
        }

        $data = [
            'nombre_carrera' => $this->request->getPost('nombre_carrera'),
        ];

        if (!$this->carreraModel->update($codigo, $data)) {
            return redirect()->back()->withInput()->with('errors', $this->carreraModel->errors());
        }

        return redirect()->to('/carreras')->with('success', 'Carrera actualizada correctamente.');
    }

    public function delete($codigo)
    {
        $carrera = $this->carreraModel->find($codigo);

        if (!$carrera) {
            return redirect()->to('/carreras')->with('error', 'Carrera no encontrada.');
        }

        $db = \Config\Database::connect();
        $alumnos = $db->table('alumnos')->where('codigo_carrera', $codigo)->countAllResults();
        if ($alumnos > 0) {
            return redirect()->to('/carreras')->with('error', 'No se puede eliminar: hay ' . $alumnos . ' alumno(s) asignados a esta carrera.');
        }

        $this->carreraModel->delete($codigo);
        return redirect()->to('/carreras')->with('success', 'Carrera eliminada correctamente.');
    }
}
