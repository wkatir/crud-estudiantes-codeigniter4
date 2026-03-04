<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMateriasTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_materia' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nombre_materia' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
        ]);
        $this->forge->addKey('id_materia', true);
        $this->forge->createTable('materias');
    }

    public function down()
    {
        $this->forge->dropTable('materias');
    }
}
