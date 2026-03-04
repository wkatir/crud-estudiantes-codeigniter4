<?php

namespace App\Controllers;

use App\Models\HorarioModel;

class Horarios extends BaseController
{
    protected $horarioModel;

    public function __construct()
    {
        $this->horarioModel = new HorarioModel();
    }

    // Formulario de inscripción de materias por docente
    public function inscripcion()
    {
        $data['docentes'] = $this->horarioModel->obtenerDocentes();
        $data['materias'] = $this->horarioModel->obtenerMaterias();
        return view('horarios/inscripcion', $data);
    }

    // Guardar inscripción de materias por docente
    public function guardarInscripcion()
    {
        $id_docente = $this->request->getPost('id_docente');
        $materias = $this->request->getPost('materia');
        $dias = $this->request->getPost('dia');
        $horas_inicio = $this->request->getPost('hora_inicio');
        $horas_fin = $this->request->getPost('hora_fin');

        if (empty($id_docente)) {
            return redirect()->back()->withInput()->with('error', 'Debe seleccionar un docente.');
        }

        $materiasLlenas = array_filter($materias);
        if (count($materiasLlenas) > 5) {
            return redirect()->back()->withInput()->with('error', 'Solo puede inscribir un maximo de 5 materias.');
        }

        $errores = [];
        $insertados = 0;
        for ($i = 0; $i < count($materias); $i++) {
            if (!empty($materias[$i]) && !empty($horas_inicio[$i]) && !empty($horas_fin[$i])) {
                if ($horas_inicio[$i] >= $horas_fin[$i]) {
                    $errores[] = 'Materia ' . ($i + 1) . ': la hora de inicio debe ser anterior a la hora de fin.';
                    continue;
                }
                $this->horarioModel->insert([
                    'id_docente'  => $id_docente,
                    'id_materia'  => $materias[$i],
                    'dia'         => $dias[$i],
                    'hora_inicio' => $horas_inicio[$i],
                    'hora_fin'    => $horas_fin[$i],
                ]);
                $insertados++;
            }
        }

        if (!empty($errores)) {
            return redirect()->back()->withInput()->with('error', implode(' ', $errores));
        }

        if ($insertados === 0) {
            return redirect()->back()->withInput()->with('error', 'Debe completar al menos una materia con su horario.');
        }

        return redirect()->to('/horarios/inscripcion')->with('success', $insertados . ' horario(s) registrado(s) correctamente.');
    }

    // Listado de materias por docente
    public function listado()
    {
        $data['docentes'] = $this->horarioModel->obtenerDocentes();
        $data['horarios'] = [];
        return view('horarios/listado', $data);
    }

    // Filtrar materias por docente
    public function filtrar()
    {
        $id_docente = $this->request->getPost('id_docente');

        $data['docentes'] = $this->horarioModel->obtenerDocentes();
        $data['horarios'] = $this->horarioModel->obtenerMateriasPorDocente($id_docente);
        $data['id_docente_seleccionado'] = $id_docente;

        return view('horarios/listado', $data);
    }

    // Eliminar un horario individual
    public function delete($id)
    {
        $horario = $this->horarioModel->find($id);

        if (!$horario) {
            return redirect()->to('/horarios/listado')->with('error', 'Horario no encontrado.');
        }

        $this->horarioModel->delete($id);
        return redirect()->to('/horarios/listado')->with('success', 'Horario eliminado correctamente.');
    }
}
