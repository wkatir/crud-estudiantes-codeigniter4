<?php

namespace App\Controllers;

use App\Models\MateriaModel;

class Materias extends BaseController
{
    protected $materiaModel;

    public function __construct()
    {
        $this->materiaModel = new MateriaModel();
    }

    public function index()
    {
        $data['materias'] = $this->materiaModel->findAll();
        return view('materias/index', $data);
    }

    public function create()
    {
        return view('materias/create');
    }

    public function store()
    {
        $data = [
            'nombre_materia' => $this->request->getPost('nombre_materia'),
        ];

        if (!$this->materiaModel->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $this->materiaModel->errors());
        }

        return redirect()->to('/materias')->with('success', 'Materia registrada correctamente.');
    }

    public function edit($id)
    {
        $data['materia'] = $this->materiaModel->find($id);

        if (!$data['materia']) {
            return redirect()->to('/materias')->with('error', 'Materia no encontrada.');
        }

        return view('materias/edit', $data);
    }

    public function update($id)
    {
        $materia = $this->materiaModel->find($id);

        if (!$materia) {
            return redirect()->to('/materias')->with('error', 'Materia no encontrada.');
        }

        $data = [
            'nombre_materia' => $this->request->getPost('nombre_materia'),
        ];

        if (!$this->materiaModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $this->materiaModel->errors());
        }

        return redirect()->to('/materias')->with('success', 'Materia actualizada correctamente.');
    }

    public function delete($id)
    {
        $materia = $this->materiaModel->find($id);

        if (!$materia) {
            return redirect()->to('/materias')->with('error', 'Materia no encontrada.');
        }

        $db = \Config\Database::connect();
        $horarios = $db->table('horarios')->where('id_materia', $id)->countAllResults();
        if ($horarios > 0) {
            return redirect()->to('/materias')->with('error', 'No se puede eliminar: hay ' . $horarios . ' horario(s) asignados a esta materia.');
        }

        $this->materiaModel->delete($id);
        return redirect()->to('/materias')->with('success', 'Materia eliminada correctamente.');
    }
}
