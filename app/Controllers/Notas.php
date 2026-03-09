<?php

namespace App\Controllers;

use App\Models\NotaModel;

class Notas extends BaseController
{
    protected $notaModel;

    public function __construct()
    {
        $this->notaModel = new NotaModel();
    }

    public function index()
    {
        $data['materias'] = $this->notaModel->obtenerMaterias();
        $data['estudiantes'] = [];
        return view('notas/index', $data);
    }

    public function filtrar()
    {
        $id_materia = $this->request->getPost('id_materia');

        $data['materias'] = $this->notaModel->obtenerMaterias();
        $data['estudiantes'] = $this->notaModel->obtenerNotasPorMateria($id_materia);
        $data['id_materia_seleccionada'] = $id_materia;

        return view('notas/index', $data);
    }

    public function guardar()
    {
        $id_materia = $this->request->getPost('id_materia');
        $id_alumnos = $this->request->getPost('id_alumno');
        $labs = $this->request->getPost('lab1');
        $parciales = $this->request->getPost('parcial1');

        if (empty($id_materia) || empty($id_alumnos)) {
            return redirect()->back()->with('error', 'Datos incompletos.');
        }

        $datos = [];
        for ($i = 0; $i < count($id_alumnos); $i++) {
            $lab1 = floatval($labs[$i] ?? 0);
            $parcial1 = floatval($parciales[$i] ?? 0);

            if ($lab1 < 0 || $lab1 > 10 || $parcial1 < 0 || $parcial1 > 10) {
                return redirect()->back()->with('error', 'Las notas deben estar entre 0 y 10.');
            }

            $datos[] = [
                'id_alumno' => $id_alumnos[$i],
                'lab1'      => $lab1,
                'parcial1'  => $parcial1,
            ];
        }

        $this->notaModel->guardarNotas($id_materia, $datos);

        return redirect()->to('/notas')->with('success', 'Notas guardadas correctamente.');
    }
}
