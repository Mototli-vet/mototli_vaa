<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registrar Nuevo Perro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
        }

        h1 {
            text-align: center;
            color: #0056b3;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            display: block;
            width: 100%;
            margin-top: 20px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error-messages {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }

        .error-messages ul {
            margin: 0;
            padding-left: 20px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Registrar Nueva Mascota</h1>

        <?php if (session()->get('errores')): ?>
            <div class="error-messages">
                <h4>Por favor, corrige los siguientes errores:</h4>
                <ul>
                    <?php foreach (session()->get('errores') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('mascotas/guardar') ?>" method="post">
            <?= csrf_field() ?>

            <label for="nombre">Nombre de la Mascota:</label>
            <input type="text" name="nombre" id="nombre" value="<?= old('nombre') ?>" required>

            <label for="raza">Raza:</label>
            <input type="text" name="raza" id="raza" value="<?= old('raza') ?>">

            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="<?= old('fecha_nacimiento') ?>">

            <label for="nombre_propietario">Nombre del Propietario:</label>
            <input type="text" name="nombre_propietario" id="nombre_propietario" value="<?= old('nombre_propietario') ?>">

            <label for="contacto_propietario">Contacto del Propietario (Tel/Email):</label>
            <input type="text" name="contacto_propietario" id="contacto_propietario" value="<?= old('contacto_propietario') ?>">

            <input type="submit" value="Registrar Mascota">
        </form>
        <p style="text-align: center; margin-top: 20px;"><a href="<?= base_url('mascotas') ?>">Volver al listado</a></p>
    </div>
</body>

</html>