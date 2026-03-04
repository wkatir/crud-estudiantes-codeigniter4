<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Agregar Docente<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Agregar Docente</h3>
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

                    <form action="<?= base_url('docentes/store') ?>" method="post">
                        <div class="form-group">
                            <label for="nombre_docente">Nombre del Docente</label>
                            <input type="text" class="form-control" id="nombre_docente" name="nombre_docente" value="<?= old('nombre_docente') ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="<?= base_url('docentes') ?>" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
