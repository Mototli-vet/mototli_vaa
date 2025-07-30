<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestionar Usuarios</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Gestión de Usuarios</h1>
            <div>
                <a href="<?= site_url('/dashboard') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver al Dashboard</a>
                <a href="<?= site_url('usuarios/nuevo') ?>" class="btn btn-success"><i class="fas fa-plus"></i> Registrar Nuevo Usuario</a>
            </div>
        </div>

        <?php if (session()->getFlashdata('mensaje')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('mensaje') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email (Usuario)</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $usuario): ?>
                                <tr>
                                    <td><?= esc($usuario['ID_USUARIO']) ?></td>
                                    <td><?= esc($usuario['Nombre']) ?></td>
                                    <td><?= esc($usuario['USUARIO']) ?></td>
                                    <td><?= ($usuario['ROL'] == 1) ? 'Administrador' : 'Usuario' ?></td>
                                    <td>
                                        <a href="<?= site_url('usuarios/editar/' . $usuario['ID_USUARIO']) ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Editar</a>

                                        <?php // No permitir que el admin se borre a sí mismo 
                                        ?>
                                        <?php if (session()->get('user_id') != $usuario['ID_USUARIO']): ?>
                                            <a href="<?= site_url('usuarios/eliminar/' . $usuario['ID_USUARIO']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar a este usuario?');"><i class="fas fa-trash"></i> Borrar</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>