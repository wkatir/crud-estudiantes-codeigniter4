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

                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('alumnos/store') ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="form-group">
                            <label>Código</label>
                            <input type="text" name="codigo" class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['codigo']) ? 'is-invalid' : '' ?>" value="<?= old('codigo') ?>" required>
                            <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['codigo'])): ?>
                                <div class="invalid-feedback"><?= esc(session()->getFlashdata('errors')['codigo']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['nombre']) ? 'is-invalid' : '' ?>" value="<?= old('nombre') ?>" required>
                            <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['nombre'])): ?>
                                <div class="invalid-feedback"><?= esc(session()->getFlashdata('errors')['nombre']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label>Apellido</label>
                            <input type="text" name="apellido" class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['apellido']) ? 'is-invalid' : '' ?>" value="<?= old('apellido') ?>" required>
                            <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['apellido'])): ?>
                                <div class="invalid-feedback"><?= esc(session()->getFlashdata('errors')['apellido']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label>Teléfono</label>
                            <input type="text" name="telefono" class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['telefono']) ? 'is-invalid' : '' ?>" value="<?= old('telefono') ?>" required>
                            <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['telefono'])): ?>
                                <div class="invalid-feedback"><?= esc(session()->getFlashdata('errors')['telefono']) ?></div>
                            <?php endif; ?>
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="<?= base_url('alumnos') ?>" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
