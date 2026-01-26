<!DOCTYPE html>
<html lang="es" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Alumno</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-base-200">
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold mb-6">Crear Alumno</h1>

        <div class="card bg-base-100 shadow-xl max-w-md">
            <div class="card-body">
                <form action="/alumnos/store" method="post">
                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Nombre</span>
                        </label>
                        <input type="text" name="nombre" class="input input-bordered" required>
                    </div>

                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Apellido</span>
                        </label>
                        <input type="text" name="apellido" class="input input-bordered" required>
                    </div>

                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Teléfono</span>
                        </label>
                        <input type="text" name="telefono" class="input input-bordered" required>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="/alumnos" class="btn btn-ghost">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
