<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Agregar Alumno<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3>Agregar Alumno</h3>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('alumnos/store') ?>" method="post">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Apellido</label>
                            <input type="text" name="apellido" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Teléfono</label>
                            <input type="text" name="telefono" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="<?= base_url('alumnos') ?>" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
