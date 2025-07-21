<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Información de <?= esc($mascota['NOMBRE_MASCOTA']) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
    <style>
        .qr-code-container {
            max-width: 250px;
            margin: 20px auto;
        }

        .card-header h1 {
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <div class="container mt-5 mb-5">
        <div class="card shadow-sm">
            <div class="card-header text-center bg-info text-white">
                <h1>Información de la Mascota</h1>
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2><?= esc($mascota['NOMBRE_MASCOTA']) ?></h2>
                        <p class="mb-1"><strong>Raza:</strong> <?= esc($mascota['RAZA']) ?></p>
                        <p class="mb-1"><strong>Fecha de Nacimiento:</strong> <?= esc($mascota['FECHA_NACIMIENTO']) ?></p>
                        <p class="mb-1"><strong>Color:</strong> <?= esc($mascota['COLOR']) ?></p>
                        <p><strong>Descripción:</strong> <?= esc($mascota['DESCRIPCION']) ?></p>
                        <hr>
                        <h4>Información del Propietario</h4>
                        <p class="mb-1"><strong>Nombre:</strong> <?= esc($mascota['NOMBRE']) ?></p>
                        <p><strong>Contacto:</strong> <?= esc($mascota['contacto_propietario']) ?></p>
                    </div>
                    <div class="col-md-4 text-center">
                        <h5>Escanea para ver esta información</h5>
                        <div class="qr-code-container">
                            <img src="<?= $qrCodeImagen ?>" class="img-fluid" alt="Código QR de <?= esc($mascota['NOMBRE_MASCOTA']) ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <a href="<?= site_url('mascotas/misMascotas') ?>" class="btn btn-secondary">Volver a Mis Mascotas</a>
                <a href="<?= site_url('/') ?>" class="btn btn-primary">Página Principal</a>
            </div>
        </div>
    </div>
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>