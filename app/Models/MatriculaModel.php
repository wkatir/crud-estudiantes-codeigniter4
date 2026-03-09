<?php

namespace App\Models;

use CodeIgniter\Model;

class MatriculaModel extends Model
{
    protected $table = 'alumno_materia';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_alumno', 'id_materia'];

    public function obtenerAlumnos()
    {
        return $this->db->table('alumnos')->get()->getResult();
    }

    public function obtenerMaterias()
    {
        return $this->db->table('materias')->get()->getResult();
    }

    public function obtenerMateriasPorAlumno($id_alumno)
    {
        return $this->db->table('alumno_materia am')
            ->select('am.id, am.id_materia, m.nombre_materia')
            ->join('materias m', 'm.id_materia = am.id_materia')
            ->where('am.id_alumno', $id_alumno)
            ->get()
            ->getResult();
    }

    public function contarMateriasPorAlumno($id_alumno)
    {
        return $this->db->table('alumno_materia')
            ->where('id_alumno', $id_alumno)
            ->countAllResults();
    }
}
