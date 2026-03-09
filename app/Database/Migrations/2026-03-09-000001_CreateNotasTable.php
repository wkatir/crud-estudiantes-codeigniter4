<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNotasTable extends Migration
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
            'lab1' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'default'    => 0,
            ],
            'parcial1' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'default'    => 0,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['id_alumno', 'id_materia']);
        $this->forge->addForeignKey('id_alumno', 'alumnos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_materia', 'materias', 'id_materia', 'CASCADE', 'CASCADE');
        $this->forge->createTable('notas');
    }

    public function down()
    {
        $this->forge->dropTable('notas');
    }
}
