<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Lista de Alumnos<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <h1 class="text-3xl font-bold mb-6">Lista de Alumnos</h1>

    <a href="/alumnos/create" class="btn btn-primary mb-4">Nuevo Alumno</a>

    <div class="overflow-x-auto">
        <table class="table table-zebra w-full bg-base-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alumnos as $alumno): ?>
                <tr>
                    <td><?= $alumno['id'] ?></td>
                    <td><?= $alumno['nombre'] ?></td>
                    <td><?= $alumno['apellido'] ?></td>
                    <td><?= $alumno['telefono'] ?></td>
                    <td>
                        <a href="/alumnos/edit/<?= $alumno['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="/alumnos/delete/<?= $alumno['id'] ?>" class="btn btn-sm btn-error" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?= $this->endSection() ?>
