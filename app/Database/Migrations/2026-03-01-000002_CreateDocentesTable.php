<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDocentesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_docente' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nombre_docente' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
        ]);
        $this->forge->addKey('id_docente', true);
        $this->forge->createTable('docentes');
    }

    public function down()
    {
        $this->forge->dropTable('docentes');
    }
}
