<!DOCTYPE html>
<html lang="es" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Alumnos</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-base-200">
    <div class="container mx-auto p-8">
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
    </div>
</body>
</html>
