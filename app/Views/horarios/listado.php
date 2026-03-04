<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Listado de Materias por Docente<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center">Listado de Materias por Docente</h2>
            <hr class="border border-primary border-3 opacity-75">

            <div class="card">
                <div class="card-header">
                    <h4>Seleccione el Docente</h4>

                    <form method="post" action="<?= base_url('horarios/filtrar') ?>">
                        <div class="input-group">
                            <select name="id_docente" class="custom-select" required>
                                <option value="">Seleccione una opción</option>
                                <?php foreach ($docentes as $d): ?>
                                <option value="<?= $d->id_docente ?>" <?= isset($id_docente_seleccionado) && $id_docente_seleccionado == $d->id_docente ? 'selected' : '' ?>>
                                    <?= $d->id_docente ?> - <?= esc($d->nombre_docente) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="submit">Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>

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

                    <?php if (!empty($horarios)): ?>
                    <table id="registros" class="table table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Id_docente</th>
                                <th>Nombre del docente</th>
                                <th>Id_materia</th>
                                <th>Nombre de materias</th>
                                <th>Dia</th>
                                <th>Horario inicio</th>
                                <th>Hora fin</th>
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
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar" data-url="<?= base_url('horarios/delete/' . $h->id) ?>">Eliminar</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                    <p>No se encontraron resultados.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEliminarLabel">Confirmar eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Seguro que deseas eliminar este horario?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="#" id="btnConfirmarEliminar" class="btn btn-danger">Eliminar</a>
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
                    last: "Último",
                    next: "Siguiente",
                    previous: "Anterior"
                }
            }
        });

        $('#modalEliminar').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var url = button.data('url');
            $('#btnConfirmarEliminar').attr('href', url);
        });
    });
</script>
<?= $this->endSection() ?>
