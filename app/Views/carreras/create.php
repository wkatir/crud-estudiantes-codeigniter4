<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Agregar Carrera<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3>Agregar Carrera</h3>
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

                    <form action="<?= base_url('carreras/store') ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="form-group">
                            <label>Código de Carrera</label>
                            <input type="text" name="codigo_carrera" class="form-control" value="<?= old('codigo_carrera') ?>" maxlength="10" required>
                        </div>

                        <div class="form-group">
                            <label>Nombre de Carrera</label>
                            <input type="text" name="nombre_carrera" class="form-control" value="<?= old('nombre_carrera') ?>" maxlength="100" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="<?= base_url('carreras') ?>" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
