<?php

namespace App\Controllers;

use App\Models\Alumno_carreraModel;

class Carreras extends BaseController
{
    protected $carreraModel;

    public function __construct()
    {
        $this->carreraModel = new Alumno_carreraModel();
    }

    public function index()
    {
        $data['carreras'] = $this->carreraModel->obtenerCarreras();
        return view('carreras/index', $data);
    }

    public function create()
    {
        return view('carreras/create');
    }

    public function store()
    {
        $codigo = $this->request->getPost('codigo_carrera');
        $nombre = $this->request->getPost('nombre_carrera');

        if (empty($codigo) || empty($nombre)) {
            return redirect()->back()->withInput()->with('errors', ['Todos los campos son obligatorios.']);
        }

        $db = \Config\Database::connect();

    
        $existe = $db->table('carrera')->where('codigo_carrera', $codigo)->countAllResults();
        if ($existe > 0) {
            return redirect()->back()->withInput()->with('errors', ['El código de carrera ya existe.']);
        }

        $db->table('carrera')->insert([
            'codigo_carrera' => $codigo,
            'nombre_carrera' => $nombre,
        ]);

        return redirect()->to('/carreras')->with('success', 'Carrera registrada correctamente.');
    }

    public function edit($codigo)
    {
        $db = \Config\Database::connect();
        $carrera = $db->table('carrera')->where('codigo_carrera', $codigo)->get()->getRowArray();

        if (!$carrera) {
            return redirect()->to('/carreras')->with('error', 'Carrera no encontrada.');
        }

        $data['carrera'] = $carrera;
        return view('carreras/edit', $data);
    }

    public function update($codigo)
    {
        $nombre = $this->request->getPost('nombre_carrera');

        if (empty($nombre)) {
            return redirect()->back()->withInput()->with('errors', ['El nombre de la carrera es obligatorio.']);
        }

        $db = \Config\Database::connect();
        $carrera = $db->table('carrera')->where('codigo_carrera', $codigo)->get()->getRowArray();

        if (!$carrera) {
            return redirect()->to('/carreras')->with('error', 'Carrera no encontrada.');
        }

        $db->table('carrera')->where('codigo_carrera', $codigo)->update([
            'nombre_carrera' => $nombre,
        ]);

        return redirect()->to('/carreras')->with('success', 'Carrera actualizada correctamente.');
    }

    public function delete($codigo)
    {
        $db = \Config\Database::connect();
        $carrera = $db->table('carrera')->where('codigo_carrera', $codigo)->get()->getRowArray();

        if (!$carrera) {
            return redirect()->to('/carreras')->with('error', 'Carrera no encontrada.');
        }

        $alumnos = $db->table('alumnos')->where('codigo_carrera', $codigo)->countAllResults();
        if ($alumnos > 0) {
            return redirect()->to('/carreras')->with('error', 'No se puede eliminar: hay ' . $alumnos . ' alumno(s) asignados a esta carrera.');
        }

        $db->table('carrera')->where('codigo_carrera', $codigo)->delete();
        return redirect()->to('/carreras')->with('success', 'Carrera eliminada correctamente.');
    }
}
