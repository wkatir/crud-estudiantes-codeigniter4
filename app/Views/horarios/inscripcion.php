<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Inscripción de Materias por Docente<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center">Inscripción de materias por docente</h2>
            <hr class="border border-primary border-3 opacity-75">

            <div class="card">
                <div class="card-body">

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <?= esc(session()->getFlashdata('success')) ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <?= esc(session()->getFlashdata('error')) ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('horarios/guardar') ?>" method="post">
                        <div class="form-group row">
                            <label for="id_docente" class="col-sm-3 col-form-label">Seleccione el Docente</label>
                            <div class="col-sm-4">
                                <select name="id_docente" id="id_docente" class="form-control" required>
                                    <option value="">-- Seleccione --</option>
                                    <?php foreach ($docentes as $d): ?>
                                    <option value="<?= $d->id_docente ?>">
                                        <?= $d->id_docente ?> <?= esc($d->nombre_docente) ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <hr>

                        <?php for ($i = 1; $i <= 4; $i++): ?>
                        <div class="form-row align-items-end mb-3">
                            <div class="col-md-3">
                                <label><strong>Materia #<?= $i ?></strong></label>
                                <select name="materia[]" class="form-control">
                                    <option value="">-- ninguna --</option>
                                    <?php foreach ($materias as $m): ?>
                                    <option value="<?= $m->id_materia ?>"><?= esc($m->nombre_materia) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>Día</label>
                                <select name="dia[]" class="form-control">
                                    <option value="Lunes">Lunes</option>
                                    <option value="Martes">Martes</option>
                                    <option value="Miércoles">Miércoles</option>
                                    <option value="Jueves">Jueves</option>
                                    <option value="Viernes">Viernes</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Hora inicio:</label>
                                <input type="time" name="hora_inicio[]" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label>Hora fin:</label>
                                <input type="time" name="hora_fin[]" class="form-control">
                            </div>
                        </div>
                        <?php endfor; ?>

                        <hr>
                        <button type="submit" class="btn btn-primary">Guardar Inscripción</button>
                        <a href="<?= base_url('horarios/listado') ?>" class="btn btn-secondary">Ver Listado</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
