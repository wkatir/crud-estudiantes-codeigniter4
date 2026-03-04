<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHorariosTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_docente' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'id_materia' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'dia' => [
                'type'       => 'ENUM',
                'constraint' => ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'],
            ],
            'hora_inicio' => [
                'type' => 'TIME',
            ],
            'hora_fin' => [
                'type' => 'TIME',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_docente', 'docentes', 'id_docente', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_materia', 'materias', 'id_materia', 'CASCADE', 'CASCADE');
        $this->forge->createTable('horarios');
    }

    public function down()
    {
        $this->forge->dropTable('horarios');
    }
}
