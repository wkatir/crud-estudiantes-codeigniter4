<?php

namespace App\Models;

use CodeIgniter\Model;

class HorarioModel extends Model
{
    protected $table = 'horarios';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_docente', 'id_materia', 'dia', 'hora_inicio', 'hora_fin'];

    public function obtenerDocentes()
    {
        return $this->db->table('docentes')->get()->getResult();
    }

    public function obtenerMaterias()
    {
        return $this->db->table('materias')->get()->getResult();
    }

    public function obtenerMateriasPorDocente($id_docente)
    {
        return $this->db->table('horarios h')
            ->select('h.*, d.nombre_docente, m.nombre_materia')
            ->join('docentes d', 'd.id_docente = h.id_docente')
            ->join('materias m', 'm.id_materia = h.id_materia')
            ->where('h.id_docente', $id_docente)
            ->get()
            ->getResult();
    }

    public function obtenerTodosHorarios()
    {
        return $this->db->table('horarios h')
            ->select('h.*, d.nombre_docente, m.nombre_materia')
            ->join('docentes d', 'd.id_docente = h.id_docente')
            ->join('materias m', 'm.id_materia = h.id_materia')
            ->get()
            ->getResult();
    }

    public function obtenerAlumnosPorMateria($id_materia)
    {
        return $this->db->table('alumno_materia am')
            ->select('a.*, m.nombre_materia')
            ->join('alumnos a', 'a.id = am.id_alumno')
            ->join('materias m', 'm.id_materia = am.id_materia')
            ->where('am.id_materia', $id_materia)
            ->get()
            ->getResult();
    }
}
