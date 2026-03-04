<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Alumnos por Materias<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center">Listado de Alumnos por materias</h2>
            <hr class="border border-primary border-3 opacity-75">

            <div class="card">
                <div class="card-header">
                    <h4>Seleccione una materia</h4>

                    <form method="post" action="<?= base_url('alumnosxmateria/filtrar') ?>">
                        <div class="input-group">
                            <select name="id_materia" class="custom-select" required>
                                <option value="">Seleccione una opción de materia</option>
                                <?php foreach ($materias as $m): ?>
                                <option value="<?= $m->id_materia ?>" <?= isset($id_materia_seleccionada) && $id_materia_seleccionada == $m->id_materia ? 'selected' : '' ?>>
                                    <?= $m->id_materia ?> - <?= esc($m->nombre_materia) ?>
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
                    <?php if (!empty($alumnos)): ?>
                    <table id="registros" class="table table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Teléfono</th>
                                <th>Materia</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($alumnos as $a): ?>
                            <tr>
                                <td><?= esc($a->id) ?></td>
                                <td><?= esc($a->nombre) ?></td>
                                <td><?= esc($a->apellido) ?></td>
                                <td><?= esc($a->telefono) ?></td>
                                <td><?= esc($a->nombre_materia) ?></td>
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
    });
</script>
<?= $this->endSection() ?>
