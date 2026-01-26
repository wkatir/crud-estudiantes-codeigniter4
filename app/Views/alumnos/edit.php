<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Editar Alumno<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <h1 class="text-3xl font-bold mb-6">Editar Alumno</h1>

    <div class="card bg-base-100 shadow-xl max-w-md">
        <div class="card-body">
            <form action="/alumnos/update/<?= $alumno['id'] ?>" method="post">
                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text">Nombre</span>
                    </label>
                    <input type="text" name="nombre" class="input input-bordered" value="<?= $alumno['nombre'] ?>" required>
                </div>

                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text">Apellido</span>
                    </label>
                    <input type="text" name="apellido" class="input input-bordered" value="<?= $alumno['apellido'] ?>" required>
                </div>

                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text">Teléfono</span>
                    </label>
                    <input type="text" name="telefono" class="input input-bordered" value="<?= $alumno['telefono'] ?>" required>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="/alumnos" class="btn btn-ghost">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
<?= $this->endSection() ?>
