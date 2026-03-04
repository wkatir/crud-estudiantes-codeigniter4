<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Editar Carrera<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Editar Carrera</h3>
                </div>
                <form action="<?= base_url('carreras/update/' . $carrera->codigo_carrera) ?>" method="post">
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
                            <label>Codigo de Carrera</label>
                            <input type="text" class="form-control" value="<?= esc($carrera->codigo_carrera) ?>" disabled>
                        </div>

                        <div class="form-group">
                            <label for="nombre_carrera">Nombre de Carrera</label>
                            <input type="text" name="nombre_carrera" id="nombre_carrera" class="form-control" value="<?= old('nombre_carrera', $carrera->nombre_carrera) ?>" maxlength="100" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save mr-1"></i> Actualizar
                        </button>
                        <a href="<?= base_url('carreras') ?>" class="btn btn-secondary">
                            <i class="fas fa-times mr-1"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
