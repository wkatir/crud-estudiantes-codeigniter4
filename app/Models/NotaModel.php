<?php

namespace App\Models;

use CodeIgniter\Model;

class NotaModel extends Model
{
    protected $table = 'notas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_alumno', 'id_materia', 'lab1', 'parcial1'];

    public function obtenerMaterias()
    {
        return $this->db->table('materias')->get()->getResult();
    }

    public function obtenerNotasPorMateria($id_materia)
    {
        return $this->db->table('alumno_materia am')
            ->select('a.id as id_alumno, a.nombre, a.apellido, n.lab1, n.parcial1')
            ->join('alumnos a', 'a.id = am.id_alumno')
            ->join('notas n', 'n.id_alumno = am.id_alumno AND n.id_materia = am.id_materia', 'left')
            ->where('am.id_materia', $id_materia)
            ->get()
            ->getResult();
    }

    public function guardarNotas($id_materia, $datos)
    {
        foreach ($datos as $d) {
            $existe = $this->db->table('notas')
                ->where('id_alumno', $d['id_alumno'])
                ->where('id_materia', $id_materia)
                ->countAllResults();

            if ($existe > 0) {
                $this->db->table('notas')
                    ->where('id_alumno', $d['id_alumno'])
                    ->where('id_materia', $id_materia)
                    ->update([
                        'lab1'     => $d['lab1'],
                        'parcial1' => $d['parcial1'],
                    ]);
            } else {
                $this->db->table('notas')->insert([
                    'id_alumno'  => $d['id_alumno'],
                    'id_materia' => $id_materia,
                    'lab1'       => $d['lab1'],
                    'parcial1'   => $d['parcial1'],
                ]);
            }
        }
    }
}
