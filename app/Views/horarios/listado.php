<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Listado de Materias por Docente<?= $this->endSection() ?>

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
                    <h3 class="card-title">Filtrar por Docente</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="<?= base_url('horarios/filtrar') ?>">
                        <?= csrf_field() ?>
                        <div class="input-group">
                            <select name="id_docente" class="form-control" required>
                                <option value="">Seleccione un docente</option>
                                <?php foreach ($docentes as $d): ?>
                                <option value="<?= esc($d->id_docente) ?>" <?= isset($id_docente_seleccionado) && $id_docente_seleccionado == $d->id_docente ? 'selected' : '' ?>>
                                    <?= esc($d->id_docente) ?> - <?= esc($d->nombre_docente) ?>
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

    <?php if (!empty($horarios)): ?>
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
                                <th>No</th>
                                <th>ID Docente</th>
                                <th>Nombre Docente</th>
                                <th>ID Materia</th>
                                <th>Materia</th>
                                <th>Dia</th>
                                <th>Hora Inicio</th>
                                <th>Hora Fin</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($horarios as $h): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($h->id_docente) ?></td>
                                <td><?= esc($h->nombre_docente) ?></td>
                                <td><?= esc($h->id_materia) ?></td>
                                <td><?= esc($h->nombre_materia) ?></td>
                                <td><?= esc($h->dia) ?></td>
                                <td><?= esc($h->hora_inicio) ?></td>
                                <td><?= esc($h->hora_fin) ?></td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar" data-url="<?= base_url('horarios/delete/' . $h->id) ?>" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php elseif (isset($id_docente_seleccionado)): ?>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info">
                <h5><i class="icon fas fa-info"></i> Informacion</h5>
                No se encontraron horarios para el docente seleccionado.
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle mr-2"></i>Confirmar eliminacion
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Seguro que deseas eliminar este horario?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Cancelar
                    </button>
                    <form id="formEliminar" method="post" action="" class="d-inline">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash mr-1"></i> Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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

        $('#modalEliminar').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var url = button.data('url');
            $('#formEliminar').attr('action', url);
        });
    });
</script>
<?= $this->endSection() ?>
