<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAlumnoMateriaTable extends Migration
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
            'id_alumno' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'id_materia' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_alumno', 'alumnos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_materia', 'materias', 'id_materia', 'CASCADE', 'CASCADE');
        $this->forge->createTable('alumno_materia');
    }

    public function down()
    {
        $this->forge->dropTable('alumno_materia');
    }
}
