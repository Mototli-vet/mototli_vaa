<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('css/login.css') ?>" rel="stylesheet">
</head>

<body>
    <div class="login-container">
        <h2 class="text-center mb-4">Iniciar Sesión</h2>

        <?php if (session()->getFlashdata('msg')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
        <?php endif; ?>

        <?= form_open('login/authenticate') ?>
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" name="email" class="form-control" id="email" value="<?= old('email') ?>" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control" id="password" required>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Ingresar</button>
        </div>
        <?= form_close() ?>
        <div class="text-center mt-3">
            <a href="<?= site_url('/') ?>">Volver al inicio</a>
        </div>
    </div>
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>