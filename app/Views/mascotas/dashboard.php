<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel de Administrador</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #343a40;
        }

        .card-icon {
            font-size: 3rem;
            opacity: 0.6;
        }

        .card {
            transition: transform .2s;
        }

        .card:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="<?= site_url('dashboard') ?>"><i class="fas fa-tachometer-alt"></i> Panel de Admin</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="navbar-text me-3">
                            Hola, <?= esc(session()->get('user_full_name')) ?>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger" href="<?= site_url('logout') ?>"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="mb-4">Dashboard</h1>

        <?php if (session()->getFlashdata('mensaje')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('mensaje') ?></div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-paw card-icon mb-3"></i>
                        <h5 class="card-title">Gestionar Mascotas</h5>
                        <p class="card-text">Ver, editar y eliminar todas las mascotas registradas en el sistema.</p>
                        <a href="<?= site_url('mascotas/misMascotas') ?>" class="btn btn-primary">Ir a Mascotas</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-users card-icon mb-3"></i>
                        <h5 class="card-title">Gestionar Usuarios</h5>
                        <p class="card-text">Administrar los usuarios, roles y permisos de la aplicación.</p>
                        <a href="#" class="btn btn-primary disabled">Próximamente</a>
                    </div>
                </div>
            </div>
            <!-- Puedes añadir más tarjetas aquí para otras funcionalidades -->
        </div>
    </div>

    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>