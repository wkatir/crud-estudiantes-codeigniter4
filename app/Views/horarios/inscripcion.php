<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Inscripcion de Materias por Docente<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="row">
        <div class="col-12">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Exito</h5>
                    <?= esc(session()->getFlashdata('success')) ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error</h5>
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Asignar Materias a Docente</h3>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('horarios/guardar') ?>" method="post">
                        <?= csrf_field() ?>
                        
                        <div class="form-group row">
                            <label for="id_docente" class="col-sm-2 col-form-label">Docente</label>
                            <div class="col-sm-6">
                                <select name="id_docente" id="id_docente" class="form-control" required>
                                    <option value="">Seleccione un docente</option>
                                    <?php foreach ($docentes as $d): ?>
                                    <option value="<?= esc($d->id_docente) ?>">
                                        <?= esc($d->id_docente) ?> - <?= esc($d->nombre_docente) ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <hr>

                        <?php for ($i = 1; $i <= 5; $i++): ?>
                        <div class="form-row align-items-end mb-3">
                            <div class="col-md-4">
                                <label>Materia <?= $i ?></label>
                                <select name="materia[]" class="form-control">
                                    <option value="">-- Ninguna --</option>
                                    <?php foreach ($materias as $m): ?>
                                    <option value="<?= esc($m->id_materia) ?>"><?= esc($m->nombre_materia) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>Dia</label>
                                <select name="dia[]" class="form-control">
                                    <option value="Lunes">Lunes</option>
                                    <option value="Martes">Martes</option>
                                    <option value="Miércoles">Miércoles</option>
                                    <option value="Jueves">Jueves</option>
                                    <option value="Viernes">Viernes</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Hora inicio</label>
                                <input type="time" name="hora_inicio[]" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label>Hora fin</label>
                                <input type="time" name="hora_fin[]" class="form-control">
                            </div>
                        </div>
                        <?php endfor; ?>

                        <hr>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i> Guardar Inscripcion
                        </button>
                        <a href="<?= base_url('horarios/listado') ?>" class="btn btn-secondary">
                            <i class="fas fa-list mr-1"></i> Ver Listado
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
