<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Editar Materia<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Editar Materia</h3>
                </div>
                <form action="<?= base_url('materias/update/' . $materia['id_materia']) ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="card-body">
                        <?php if (session()->getFlashdata('errors')): ?>
                            <div class="alert alert-danger">
                                <h5><i class="icon fas fa-ban"></i> Errores</h5>
                                <ul class="mb-0">
                                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="form-group">
                            <label for="nombre_materia">Nombre de la Materia</label>
                            <input type="text" class="form-control" id="nombre_materia" name="nombre_materia" value="<?= old('nombre_materia', $materia['nombre_materia']) ?>" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">
                            <i class="fas fa-save mr-1"></i> Actualizar
                        </button>
                        <a href="<?= base_url('materias') ?>" class="btn btn-secondary">
                            <i class="fas fa-times mr-1"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
