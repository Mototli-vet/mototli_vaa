<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="card shadow-sm mx-auto" style="max-width: 600px;">
            <div class="card-header">
                <h1 class="h3 mb-0">Editar Usuario: <?= esc($usuario['Nombre']) ?></h1>
            </div>
            <div class="card-body">
                <?php if (session()->get('errors')): ?>
                    <div class="alert alert-danger">
                        <p>Por favor, corrige los siguientes errores:</p>
                        <ul>
                            <?php foreach (session()->get('errors') as $error) : ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif ?>

                <?= form_open('usuarios/actualizar') ?>
                <input type="hidden" name="id_usuario" value="<?= esc($usuario['ID_USUARIO']) ?>">

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre Completo</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= old('nombre', $usuario['Nombre']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email (Usuario)</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= old('email', $usuario['USUARIO']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Nueva Contraseña (opcional)</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <div class="form-text">Deja este campo en blanco si no quieres cambiar la contraseña.</div>
                </div>
                <div class="mb-3">
                    <label for="rol" class="form-label">Rol</label>
                    <select class="form-select" id="rol" name="rol" required>
                        <option value="2" <?= old('rol', $usuario['ROL']) == '2' ? 'selected' : '' ?>>Usuario</option>
                        <option value="1" <?= old('rol', $usuario['ROL']) == '1' ? 'selected' : '' ?>>Administrador</option>
                    </select>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="<?= site_url('usuarios/gestionar') ?>" class="btn btn-secondary me-md-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Actualizar Usuario</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>