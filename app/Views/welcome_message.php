<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido | CRUD Estudiantes</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

    <nav class="main-header navbar navbar-expand-md navbar-white navbar-light">
        <div class="container">
            <a href="<?= base_url() ?>" class="navbar-brand">
                <i class="fas fa-graduation-cap text-primary fa-lg mr-2"></i>
                <span class="brand-text font-weight-light">CRUD Estudiantes</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="<?= base_url('alumnos') ?>" class="nav-link">
                            <i class="fas fa-users mr-1"></i> Alumnos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('carreras') ?>" class="nav-link">
                            <i class="fas fa-graduation-cap mr-1"></i> Carreras
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('materias') ?>" class="nav-link">
                            <i class="fas fa-book mr-1"></i> Materias
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('docentes') ?>" class="nav-link">
                            <i class="fas fa-chalkboard-teacher mr-1"></i> Docentes
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center py-5">
                        <h1 class="display-4">Sistema de Gestion Estudiantil</h1>
                        <p class="lead">Wilmer Salazar SM100223 - CodeIgniter 4</p>
                        <a href="<?= base_url('alumnos') ?>" class="btn btn-primary btn-lg mt-3">
                            <i class="fas fa-sign-in-alt mr-2"></i> Ingresar al Sistema
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>Alumnos</h3>
                                <p>Gestion de estudiantes</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <a href="<?= base_url('alumnos') ?>" class="small-box-footer">
                                Ver mas <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>Carreras</h3>
                                <p>Programas academicos</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <a href="<?= base_url('carreras') ?>" class="small-box-footer">
                                Ver mas <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>Materias</h3>
                                <p>Catalogo de asignaturas</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <a href="<?= base_url('materias') ?>" class="small-box-footer">
                                Ver mas <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>Docentes</h3>
                                <p>Personal academico</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            <a href="<?= base_url('docentes') ?>" class="small-box-footer">
                                Ver mas <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-calendar-alt mr-2"></i>Horarios
                                </h3>
                            </div>
                            <div class="card-body">
                                <p>Asignacion de materias a docentes y gestion de horarios.</p>
                                <a href="<?= base_url('horarios/inscripcion') ?>" class="btn btn-outline-primary">
                                    Ver Horarios
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-bar mr-2"></i>Reportes
                                </h3>
                            </div>
                            <div class="card-body">
                                <p>Reportes de alumnos por carrera y materia.</p>
                                <a href="<?= base_url('alumnosxcarrera') ?>" class="btn btn-outline-secondary">
                                    Ver Reportes
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-database mr-2"></i>DataTables
                                </h3>
                            </div>
                            <div class="card-body">
                                <p>Busqueda, filtrado y paginacion avanzada.</p>
                                <span class="badge badge-primary">Integrado</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="main-footer text-center">
        <div class="container">
            <strong>Copyright &copy; <?= date('Y') ?> Wilmer Salazar SM100223.</strong>
            <div class="text-muted">CodeIgniter 4 + AdminLTE 3</div>
        </div>
    </footer>

</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>
</html>
