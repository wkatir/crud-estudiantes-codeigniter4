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

                        <div id="materias-actuales" class="d-none">
                            <div class="callout callout-info">
                                <h5>Materias ya inscritas: <span id="conteo-materias" class="badge badge-primary">0</span> / 5</h5>
                                <table class="table table-sm table-bordered mt-2" id="tabla-materias-actuales">
                                    <thead>
                                        <tr>
                                            <th>Materia</th>
                                            <th>Dia</th>
                                            <th>Hora Inicio</th>
                                            <th>Hora Fin</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>

                        <div id="alerta-lleno" class="d-none">
                            <div class="callout callout-warning">
                                <h5>Este docente ya tiene 5 materias inscritas</h5>
                                <p class="mb-0">No se pueden agregar mas. Elimine alguna desde el listado si desea cambiar.</p>
                            </div>
                        </div>

                        <div id="seccion-nuevas" class="d-none">
                            <hr>
                            <p>Espacios disponibles: <strong id="disponibles">5</strong></p>

                            <?php for ($i = 1; $i <= 5; $i++): ?>
                            <div class="form-row align-items-end mb-3 fila-materia" data-fila="<?= $i ?>">
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
                            <button type="submit" class="btn btn-primary" id="btn-guardar">
                                <i class="fas fa-save mr-1"></i> Guardar Inscripcion
                            </button>
                        </div>

                        <a href="<?= base_url('horarios/listado') ?>" class="btn btn-secondary mt-3">
                            <i class="fas fa-list mr-1"></i> Ver Listado
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function(){
        $('#id_docente').on('change', function(){
            var id = $(this).val();
            var panel = $('#materias-actuales');
            var tbody = $('#tabla-materias-actuales tbody');
            var seccionNuevas = $('#seccion-nuevas');
            var alertaLleno = $('#alerta-lleno');

            // Ocultar todo y resetear
            panel.addClass('d-none');
            seccionNuevas.addClass('d-none');
            alertaLleno.addClass('d-none');
            $('.fila-materia').hide().find('select, input').val('');

            if (!id) {
                return;
            }

            $.getJSON('<?= base_url('horarios/materias-docente') ?>/' + id, function(data){
                tbody.empty();
                var total = data.length;
                var disponibles = 5 - total;

                // Mostrar materias ya inscritas
                if (total > 0) {
                    $.each(data, function(i, h){
                        tbody.append(
                            '<tr><td>' + h.nombre_materia + '</td>' +
                            '<td>' + h.dia + '</td>' +
                            '<td>' + h.hora_inicio + '</td>' +
                            '<td>' + h.hora_fin + '</td></tr>'
                        );
                    });
                    panel.removeClass('d-none');
                }

                $('#conteo-materias').text(total);

                if (disponibles <= 0) {
                    // Ya tiene 5, no puede agregar mas
                    alertaLleno.removeClass('d-none');
                } else {
                    // Mostrar solo las filas disponibles
                    $('#disponibles').text(disponibles);
                    seccionNuevas.removeClass('d-none');
                    $('.fila-materia').each(function(){
                        var fila = parseInt($(this).data('fila'));
                        if (fila <= disponibles) {
                            $(this).show();
                        }
                    });
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>
