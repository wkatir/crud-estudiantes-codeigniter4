<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Materias por Alumno<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Filtrar por Alumno</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="<?= base_url('materiasxalumno/filtrar') ?>">
                        <?= csrf_field() ?>
                        <div class="input-group">
                            <select name="id_alumno" class="form-control" required>
                                <option value="">Seleccione un alumno</option>
                                <?php foreach ($alumnos as $a): ?>
                                <option value="<?= esc($a->id) ?>" <?= isset($id_alumno_seleccionado) && $id_alumno_seleccionado == $a->id ? 'selected' : '' ?>>
                                    <?= esc($a->id) ?> - <?= esc($a->nombre) ?> <?= esc($a->apellido) ?>
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

    <?php if (!empty($materias)): ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Resultados</h3>
                </div>
                <div class="card-body">
                    <table id="registros" class="table table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>ID Materia</th>
                                <th>Nombre Materia</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($materias as $m): ?>
                            <tr>
                                <td><?= esc($m->id_materia) ?></td>
                                <td><?= esc($m->nombre_materia) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php elseif (isset($id_alumno_seleccionado)): ?>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info">
                <h5><i class="icon fas fa-info"></i> Informacion</h5>
                No se encontraron materias inscritas para el alumno seleccionado.
            </div>
        </div>
    </div>
    <?php endif; ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function(){
        $('#registros').DataTable({
            responsive: true,
            language: {
                search: "Buscar:",
                lengthMenu: "Mostrar _MENU_ registros",
                info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                infoEmpty: "Mostrando 0 a 0 de 0 registros",
                infoFiltered: "(filtrado de _MAX_ registros totales)",
                zeroRecords: "No se encontraron resultados",
                emptyTable: "No hay datos disponibles",
                paginate: {
                    first: "Primero",
                    last: "Ultimo",
                    next: "Siguiente",
                    previous: "Anterior"
                }
            }
        });
    });
</script>
<?= $this->endSection() ?>
