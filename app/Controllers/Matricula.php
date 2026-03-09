<?php

namespace App\Controllers;

use App\Models\MatriculaModel;

class Matricula extends BaseController
{
    protected $matriculaModel;

    public function __construct()
    {
        $this->matriculaModel = new MatriculaModel();
    }

    public function inscripcion()
    {
        $data['alumnos'] = $this->matriculaModel->obtenerAlumnos();
        $data['materias'] = $this->matriculaModel->obtenerMaterias();
        return view('matricula/inscripcion', $data);
    }

    public function materiasAlumno($id_alumno)
    {
        $materias = $this->matriculaModel->obtenerMateriasPorAlumno($id_alumno);
        return $this->response->setJSON($materias);
    }

    public function guardarInscripcion()
    {
        $id_alumno = $this->request->getPost('id_alumno');
        $materias = $this->request->getPost('materia');

        if (empty($id_alumno)) {
            return redirect()->back()->withInput()->with('error', 'Debe seleccionar un alumno.');
        }

        $materiasLlenas = array_filter($materias ?? []);
        $existentes = $this->matriculaModel->contarMateriasPorAlumno($id_alumno);
        $totalFinal = $existentes + count($materiasLlenas);

        if ($totalFinal > 5) {
            $disponibles = 5 - $existentes;
            return redirect()->back()->withInput()->with('error', 'El alumno ya tiene ' . $existentes . ' materia(s) inscrita(s). Solo puede agregar ' . $disponibles . ' mas.');
        }

        // Obtener materias ya inscritas para evitar duplicados
        $inscritas = $this->matriculaModel->obtenerMateriasPorAlumno($id_alumno);
        $idsInscritas = array_map(function ($m) {
            return $m->id_materia;
        }, $inscritas);

        $errores = [];
        $insertados = 0;

        foreach ($materiasLlenas as $id_materia) {
            if (in_array($id_materia, $idsInscritas)) {
                $errores[] = 'La materia ID ' . $id_materia . ' ya esta inscrita.';
                continue;
            }

            $this->matriculaModel->insert([
                'id_alumno' => $id_alumno,
                'id_materia' => $id_materia,
            ]);

            $idsInscritas[] = $id_materia;
            $insertados++;
        }

        if (!empty($errores)) {
            return redirect()->back()->withInput()->with('error', implode(' ', $errores));
        }

        if ($insertados === 0) {
            return redirect()->back()->withInput()->with('error', 'Debe seleccionar al menos una materia.');
        }

        return redirect()->to('/matricula/inscripcion')->with('success', $insertados . ' materia(s) inscrita(s) correctamente.');
    }

    public function eliminar($id)
    {
        $registro = $this->matriculaModel->find($id);

        if (!$registro) {
            return redirect()->to('/matricula/inscripcion')->with('error', 'Registro no encontrado.');
        }

        $this->matriculaModel->delete($id);
        return redirect()->to('/matricula/inscripcion')->with('success', 'Materia eliminada de la inscripcion.');
    }
}
