<?php

namespace App\Controllers;

use App\Models\DocenteModel;

class Docentes extends BaseController
{
    protected $docenteModel;

    public function __construct()
    {
        $this->docenteModel = new DocenteModel();
    }

    public function index()
    {
        $data['docentes'] = $this->docenteModel->findAll();
        return view('docentes/index', $data);
    }

    public function create()
    {
        return view('docentes/create');
    }

    public function store()
    {
        $data = [
            'nombre_docente' => $this->request->getPost('nombre_docente'),
        ];

        if (!$this->docenteModel->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $this->docenteModel->errors());
        }

        return redirect()->to('/docentes')->with('success', 'Docente registrado correctamente.');
    }

    public function edit($id)
    {
        $data['docente'] = $this->docenteModel->find($id);

        if (!$data['docente']) {
            return redirect()->to('/docentes')->with('error', 'Docente no encontrado.');
        }

        return view('docentes/edit', $data);
    }

    public function update($id)
    {
        $docente = $this->docenteModel->find($id);

        if (!$docente) {
            return redirect()->to('/docentes')->with('error', 'Docente no encontrado.');
        }

        $data = [
            'nombre_docente' => $this->request->getPost('nombre_docente'),
        ];

        if (!$this->docenteModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $this->docenteModel->errors());
        }

        return redirect()->to('/docentes')->with('success', 'Docente actualizado correctamente.');
    }

    public function delete($id)
    {
        $docente = $this->docenteModel->find($id);

        if (!$docente) {
            return redirect()->to('/docentes')->with('error', 'Docente no encontrado.');
        }

        $db = \Config\Database::connect();
        $horarios = $db->table('horarios')->where('id_docente', $id)->countAllResults();
        if ($horarios > 0) {
            return redirect()->to('/docentes')->with('error', 'No se puede eliminar: hay ' . $horarios . ' horario(s) asignados a este docente.');
        }

        $this->docenteModel->delete($id);
        return redirect()->to('/docentes')->with('success', 'Docente eliminado correctamente.');
    }
}
