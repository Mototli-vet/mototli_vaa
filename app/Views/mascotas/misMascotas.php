<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mis Mascotas y QR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Puedes añadir un CSS personalizado si lo necesitas -->
</head>

<body>
    <!-- Sería ideal tener un header común para incluirlo aquí -->

    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Mis Mascotas y QR</h1>
            <a href="<?= site_url('mascotas/nuevo') ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Registrar Nueva Mascota
            </a>
        </div>

        <?php if (session()->getFlashdata('mensaje')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('mensaje') ?></div>
        <?php endif; ?>

        <?php if (empty($mascotas)): ?>
            <div class="alert alert-info" role="alert">
                Aún no has registrado ninguna mascota. ¡<a href="<?= site_url('mascotas/nuevo') ?>" class="alert-link">Registra la primera</a>!
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($mascotas as $mascota): ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><?= esc($mascota['NOMBRE_MASCOTA']) ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted"><?= esc($mascota['RAZA']) ?></h6>
                                <p class="card-text">
                                    <strong>Propietario:</strong> <?= esc($mascota['NOMBRE']) ?><br>
                                    <strong>Contacto:</strong> <?= esc($mascota['contacto_propietario']) ?>
                                </p>
                                <?php if (!empty($mascota['QR_CODE_PATH'])): ?>
                                    <a href="<?= site_url('mascotas/ver/' . esc($mascota['QR_CODE_PATH'], 'url')) ?>" class="btn btn-info btn-sm">Ver QR e Info</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>