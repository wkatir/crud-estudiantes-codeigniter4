<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Notas por Materia<?= $this->endSection() ?>

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
                    <h3 class="card-title">Seleccionar Materia</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="<?= base_url('notas/filtrar') ?>">
                        <?= csrf_field() ?>
                        <div class="input-group">
                            <select name="id_materia" class="form-control" required>
                                <option value="">Seleccione una materia</option>
                                <?php foreach ($materias as $m): ?>
                                <option value="<?= esc($m->id_materia) ?>" <?= isset($id_materia_seleccionada) && $id_materia_seleccionada == $m->id_materia ? 'selected' : '' ?>>
                                    <?= esc($m->id_materia) ?> - <?= esc($m->nombre_materia) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fas fa-search mr-1"></i> Buscar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($estudiantes)): ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Notas de Estudiantes</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="<?= base_url('notas/guardar') ?>">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id_materia" value="<?= esc($id_materia_seleccionada) ?>">

                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Estudiante</th>
                                    <th>Lab 1</th>
                                    <th>Parcial 1</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($estudiantes as $i => $e): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td>
                                        <?= esc($e->nombre) ?> <?= esc($e->apellido) ?>
                                        <input type="hidden" name="id_alumno[]" value="<?= esc($e->id_alumno) ?>">
                                    </td>
                                    <td>
                                        <input type="number" name="lab1[]" class="form-control" step="0.01" min="0" max="10" value="<?= esc($e->lab1 ?? 0) ?>">
                                    </td>
                                    <td>
                                        <input type="number" name="parcial1[]" class="form-control" step="0.01" min="0" max="10" value="<?= esc($e->parcial1 ?? 0) ?>">
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <button type="submit" class="btn btn-primary mt-3">
                            <i class="fas fa-save mr-1"></i> Guardar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php elseif (isset($id_materia_seleccionada)): ?>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info">
                <h5><i class="icon fas fa-info"></i> Informacion</h5>
                No se encontraron estudiantes inscritos en esta materia.
            </div>
        </div>
    </div>
    <?php endif; ?>
<?= $this->endSection() ?>
