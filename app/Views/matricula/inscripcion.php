<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Inscripcion de Materias por Alumno<?= $this->endSection() ?>

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
                    <h3 class="card-title">Inscribir Materias a Alumno</h3>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('matricula/guardar') ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="form-group row">
                            <label for="id_alumno" class="col-sm-2 col-form-label">Alumno</label>
                            <div class="col-sm-6">
                                <select name="id_alumno" id="id_alumno" class="form-control" required>
                                    <option value="">Seleccione un alumno</option>
                                    <?php foreach ($alumnos as $a): ?>
                                    <option value="<?= esc($a->id) ?>">
                                        <?= esc($a->id) ?> - <?= esc($a->nombre) ?> <?= esc($a->apellido) ?>
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
                                            <th>ID</th>
                                            <th>Materia</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>

                        <div id="alerta-lleno" class="d-none">
                            <div class="callout callout-warning">
                                <h5>Este alumno ya tiene 5 materias inscritas</h5>
                                <p class="mb-0">No se pueden agregar mas. Elimine alguna si desea cambiar.</p>
                            </div>
                        </div>

                        <div id="seccion-nuevas" class="d-none">
                            <hr>
                            <p>Espacios disponibles: <strong id="disponibles">5</strong></p>

                            <?php for ($i = 1; $i <= 5; $i++): ?>
                            <div class="form-row align-items-end mb-3 fila-materia" data-fila="<?= $i ?>">
                                <div class="col-md-6">
                                    <label>Materia <?= $i ?></label>
                                    <select name="materia[]" class="form-control">
                                        <option value="">-- Ninguna --</option>
                                        <?php foreach ($materias as $m): ?>
                                        <option value="<?= esc($m->id_materia) ?>"><?= esc($m->nombre_materia) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <?php endfor; ?>

                            <hr>
                            <button type="submit" class="btn btn-primary" id="btn-guardar">
                                <i class="fas fa-save mr-1"></i> Guardar Inscripcion
                            </button>
                        </div>

                        <a href="<?= base_url('materiasxalumno') ?>" class="btn btn-secondary mt-3">
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
        $('#id_alumno').on('change', function(){
            var id = $(this).val();
            var panel = $('#materias-actuales');
            var tbody = $('#tabla-materias-actuales tbody');
            var seccionNuevas = $('#seccion-nuevas');
            var alertaLleno = $('#alerta-lleno');

            panel.addClass('d-none');
            seccionNuevas.addClass('d-none');
            alertaLleno.addClass('d-none');
            $('.fila-materia').hide().find('select').val('');

            if (!id) {
                return;
            }

            $.getJSON('<?= base_url('matricula/materias-alumno') ?>/' + id, function(data){
                tbody.empty();
                var total = data.length;
                var disponibles = 5 - total;

                if (total > 0) {
                    $.each(data, function(i, m){
                        tbody.append(
                            '<tr><td>' + m.id_materia + '</td>' +
                            '<td>' + m.nombre_materia + '</td></tr>'
                        );
                    });
                    panel.removeClass('d-none');
                }

                $('#conteo-materias').text(total);

                if (disponibles <= 0) {
                    alertaLleno.removeClass('d-none');
                } else {
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
