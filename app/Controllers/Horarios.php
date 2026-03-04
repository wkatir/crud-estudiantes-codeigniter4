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

    public function inscripcion()
    {
        $data['docentes'] = $this->horarioModel->obtenerDocentes();
        $data['materias'] = $this->horarioModel->obtenerMaterias();
        return view('horarios/inscripcion', $data);
    }

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
        $horariosExistentes = $this->horarioModel->obtenerMateriasPorDocente($id_docente);
        $existentes = count($horariosExistentes);
        $totalFinal = $existentes + count($materiasLlenas);

        if ($totalFinal > 5) {
            $disponibles = 5 - $existentes;
            return redirect()->back()->withInput()->with('error', 'El docente ya tiene ' . $existentes . ' materia(s) inscrita(s). Solo puede agregar ' . $disponibles . ' mas.');
        }

        $bloquesOcupados = [];
        foreach ($horariosExistentes as $h) {
            $bloquesOcupados[] = [
                'dia'         => $h->dia,
                'hora_inicio' => $h->hora_inicio,
                'hora_fin'    => $h->hora_fin,
                'nombre'      => $h->nombre_materia,
            ];
        }

        $errores = [];
        $insertados = 0;
        for ($i = 0; $i < count($materias); $i++) {
            if (!empty($materias[$i]) && !empty($horas_inicio[$i]) && !empty($horas_fin[$i])) {
                $num = $i + 1;

                if ($horas_inicio[$i] >= $horas_fin[$i]) {
                    $errores[] = 'Materia ' . $num . ': la hora de inicio debe ser anterior a la hora de fin.';
                    continue;
                }

                $choque = false;
                foreach ($bloquesOcupados as $bloque) {
                    if ($bloque['dia'] === $dias[$i] && $horas_inicio[$i] < $bloque['hora_fin'] && $horas_fin[$i] > $bloque['hora_inicio']) {
                        $errores[] = 'Materia ' . $num . ': el horario (' . $dias[$i] . ' ' . $horas_inicio[$i] . '-' . $horas_fin[$i] . ') choca con "' . $bloque['nombre'] . '" (' . $bloque['hora_inicio'] . '-' . $bloque['hora_fin'] . ').';
                        $choque = true;
                        break;
                    }
                }

                if ($choque) {
                    continue;
                }

                $this->horarioModel->insert([
                    'id_docente'  => $id_docente,
                    'id_materia'  => $materias[$i],
                    'dia'         => $dias[$i],
                    'hora_inicio' => $horas_inicio[$i],
                    'hora_fin'    => $horas_fin[$i],
                ]);

                $bloquesOcupados[] = [
                    'dia'         => $dias[$i],
                    'hora_inicio' => $horas_inicio[$i],
                    'hora_fin'    => $horas_fin[$i],
                    'nombre'      => 'Materia ' . $num,
                ];

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

    public function listado()
    {
        $data['docentes'] = $this->horarioModel->obtenerDocentes();
        $data['horarios'] = [];
        return view('horarios/listado', $data);
    }

    public function filtrar()
    {
        $id_docente = $this->request->getPost('id_docente');

        $data['docentes'] = $this->horarioModel->obtenerDocentes();
        $data['horarios'] = $this->horarioModel->obtenerMateriasPorDocente($id_docente);
        $data['id_docente_seleccionado'] = $id_docente;

        return view('horarios/listado', $data);
    }

    public function materiasDocente($id_docente)
    {
        $horarios = $this->horarioModel->obtenerMateriasPorDocente($id_docente);
        return $this->response->setJSON($horarios);
    }

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
