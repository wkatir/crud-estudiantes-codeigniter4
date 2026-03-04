<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?> | CRUD Estudiantes</title>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    
    <?= $this->renderSection('styles') ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?= base_url('alumnos') ?>" class="nav-link">Inicio</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="<?= base_url('alumnos') ?>" class="brand-link">
            <i class="fas fa-graduation-cap fa-lg ml-3 mr-2"></i>
            <span class="brand-text font-weight-light">CRUD Estudiantes</span>
        </a>

        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <i class="fas fa-user-circle fa-2x text-gray"></i>
                </div>
                <div class="info">
                    <span class="d-block text-white">Wilmer Salazar</span>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    
                    <li class="nav-item">
                        <a href="<?= base_url('alumnos') ?>" class="nav-link <?= current_url() == base_url('alumnos') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Alumnos</p>
                        </a>
                    </li>

                    <li class="nav-item <?= strpos(current_url(), 'carreras') !== false || strpos(current_url(), 'materias') !== false || strpos(current_url(), 'docentes') !== false || strpos(current_url(), 'horarios/inscripcion') !== false ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= strpos(current_url(), 'carreras') !== false || strpos(current_url(), 'materias') !== false || strpos(current_url(), 'docentes') !== false || strpos(current_url(), 'horarios/inscripcion') !== false ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-plus-circle"></i>
                            <p>
                                Agregar/Datos
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('carreras') ?>" class="nav-link <?= strpos(current_url(), 'carreras') !== false ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Carreras</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('materias') ?>" class="nav-link <?= strpos(current_url(), 'materias') !== false ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Materias</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('docentes') ?>" class="nav-link <?= strpos(current_url(), 'docentes') !== false ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Docentes</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('horarios/inscripcion') ?>" class="nav-link <?= strpos(current_url(), 'horarios/inscripcion') !== false ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Inscripcion Materias</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item <?= strpos(current_url(), 'alumnosxcarrera') !== false || strpos(current_url(), 'alumnosxmateria') !== false || strpos(current_url(), 'horarios/listado') !== false ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= strpos(current_url(), 'alumnosxcarrera') !== false || strpos(current_url(), 'alumnosxmateria') !== false || strpos(current_url(), 'horarios/listado') !== false ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-chart-bar"></i>
                            <p>
                                Listado/Reportes
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('alumnosxcarrera') ?>" class="nav-link <?= strpos(current_url(), 'alumnosxcarrera') !== false ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Alumnos por Carrera</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('alumnosxmateria') ?>" class="nav-link <?= strpos(current_url(), 'alumnosxmateria') !== false ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Alumnos por Materia</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('horarios/listado') ?>" class="nav-link <?= strpos(current_url(), 'horarios/listado') !== false ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Materias por Docente</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><?= $this->renderSection('title') ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= base_url('alumnos') ?>">Inicio</a></li>
                            <li class="breadcrumb-item active"><?= $this->renderSection('title') ?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <?= $this->renderSection('content') ?>
            </div>
        </section>
    </div>

    <footer class="main-footer">
        <div class="float-right d-none d-sm-inline">
            CodeIgniter 4
        </div>
        <strong>Copyright &copy; <?= date('Y') ?> Wilmer Salazar SM100223.</strong>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<?= $this->renderSection('scripts') ?>

</body>
</html>
