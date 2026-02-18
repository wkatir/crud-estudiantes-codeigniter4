<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Alumnos por Carrera<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="text-center">Listado de Alumnos por carrera</h1>
            <hr class="border border-primary border-3 opacity-75">

            <div class="card">
                <div class="card-header">
                    <h3>Seleccione una carrera...</h3>

                    <form method="post" action="<?= base_url('alumnosxcarrera/filtrar') ?>">
                        <div class="input-group">
                            <select name="codigo_carrera" class="custom-select" id="inputGroupSelect04" required>
                                <option selected value="">Seleccione una carrera...</option>
                                <?php foreach($carreras as $c): ?>
                                <option value="<?= $c->codigo_carrera ?>">
                                    <?= $c->codigo_carrera ?> - <?= $c->nombre_carrera ?>
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
                    <?php if(!empty($alumnos)): ?>
                    <table id="registros" class="table table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Teléfonos</th>
                                <th>Carrera</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($alumnos as $a): ?>
                            <tr>
                                <td><?= $a->id ?></td>
                                <td><?= $a->nombre ?></td>
                                <td><?= $a->apellido ?></td>
                                <td><?= $a->telefono ?></td>
                                <td><?= $a->nombre_carrera ?></td>
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
