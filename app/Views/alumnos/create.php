<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Agregar Alumno<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Nuevo Alumno</h3>
                </div>
                <form action="<?= base_url('alumnos/store') ?>" method="post">
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
                            <label for="codigo">Codigo</label>
                            <input type="text" name="codigo" id="codigo" class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['codigo']) ? 'is-invalid' : '' ?>" value="<?= old('codigo') ?>" required>
                            <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['codigo'])): ?>
                                <div class="invalid-feedback"><?= esc(session()->getFlashdata('errors')['codigo']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['nombre']) ? 'is-invalid' : '' ?>" value="<?= old('nombre') ?>" required>
                            <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['nombre'])): ?>
                                <div class="invalid-feedback"><?= esc(session()->getFlashdata('errors')['nombre']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="apellido">Apellido</label>
                            <input type="text" name="apellido" id="apellido" class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['apellido']) ? 'is-invalid' : '' ?>" value="<?= old('apellido') ?>" required>
                            <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['apellido'])): ?>
                                <div class="invalid-feedback"><?= esc(session()->getFlashdata('errors')['apellido']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="telefono">Telefono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['telefono']) ? 'is-invalid' : '' ?>" value="<?= old('telefono') ?>" required>
                            <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['telefono'])): ?>
                                <div class="invalid-feedback"><?= esc(session()->getFlashdata('errors')['telefono']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="codigo_carrera">Carrera</label>
                            <select name="codigo_carrera" id="codigo_carrera" class="form-control" required>
                                <option value="">Seleccione una carrera</option>
                                <?php foreach($carreras as $c): ?>
                                <option value="<?= esc($c->codigo_carrera) ?>" <?= old('codigo_carrera') == $c->codigo_carrera ? 'selected' : '' ?>>
                                    <?= esc($c->codigo_carrera) ?> - <?= esc($c->nombre_carrera) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i> Guardar
                        </button>
                        <a href="<?= base_url('alumnos') ?>" class="btn btn-secondary">
                            <i class="fas fa-times mr-1"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
