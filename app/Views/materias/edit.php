<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Editar Materia<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Editar Materia</h3>
                </div>
                <div class="card-body">

                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('materias/update/' . $materia['id_materia']) ?>" method="post">
                        <div class="form-group">
                            <label for="nombre_materia">Nombre de la Materia</label>
                            <input type="text" class="form-control" id="nombre_materia" name="nombre_materia" value="<?= old('nombre_materia', $materia['nombre_materia']) ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="<?= base_url('materias') ?>" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
