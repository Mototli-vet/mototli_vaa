<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Información de <?= esc($mascota['NOMBRE_MASCOTA']) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- Leaflet CSS para el mapa -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
        .qr-code-container {
            max-width: 250px;
            margin: 20px auto;
        }

        #map {
            height: 400px;
            width: 100%;
            margin-top: 20px;
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

                <?php if (!empty($mascota['ULTIMA_LATITUD']) && !empty($mascota['ULTIMA_LONGITUD'])) : ?>
                    <hr>
                    <div class="text-center">
                        <h4>Última ubicación conocida</h4>
                        <p>Esta es la última ubicación registrada cuando se escaneó este código QR.</p>
                        <div id="map"></div>
                    </div>
                <?php else : ?>
                    <div class="alert alert-info mt-3 text-center" id="no-location-msg">
                        Aún no se ha registrado ninguna ubicación para esta mascota.
                    </div>
                    <!-- Div para el mapa que se mostrará si se obtiene la ubicación actual -->
                    <div id="map" style="display: none;"></div>
                <?php endif; ?>
            </div>
            <div class="card-footer text-center">
                <a href="<?= site_url('mascotas/misMascotas') ?>" class="btn btn-secondary">Volver a Mis Mascotas</a>
                <a href="<?= site_url('/') ?>" class="btn btn-primary">Página Principal</a>
            </div>
        </div>
    </div>
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
    <!-- Leaflet JS para el mapa -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Mostrar la última ubicación conocida si existe
            const lat = <?= json_encode($mascota['ULTIMA_LATITUD'] ?? null) ?>;
            const lon = <?= json_encode($mascota['ULTIMA_LONGITUD'] ?? null) ?>;
            const mapDiv = document.getElementById('map');
            let map;

            if (lat && lon) {
                map = L.map('map').setView([lat, lon], 15);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                L.marker([lat, lon]).addTo(map)
                    .bindPopup('Última ubicación registrada de <?= esc($mascota['NOMBRE_MASCOTA'], 'js') ?>.')
                    .openPopup();
            }

            // 2. Intentar obtener y guardar la ubicación actual del escaneo
            // Verificamos si la URL contiene un parámetro que indique que se accedió desde un QR
            const urlParams = new URLSearchParams(window.location.search);
            const fromQr = urlParams.has('source') && urlParams.get('source') === 'qr';

            if (fromQr) {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        const currentLat = position.coords.latitude;
                        const currentLon = position.coords.longitude;
                        const qrData = '<?= esc($mascota['QR_CODE_PATH'], 'js') ?>';

                        // Si no había mapa antes (porque no había última ubicación), lo creamos ahora con la ubicación actual
                        if (!map) {
                            const noLocationMsg = document.getElementById('no-location-msg');
                            if (noLocationMsg) noLocationMsg.style.display = 'none'; // Ocultar mensaje de "sin ubicación"

                            mapDiv.style.display = 'block'; // Mostrar el div del mapa
                            map = L.map('map').setView([currentLat, currentLon], 15);
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                            }).addTo(map);

                            L.marker([currentLat, currentLon]).addTo(map)
                                .bindPopup('¡Ubicación actual! Gracias por escanear.')
                                .openPopup();
                        }

                        // Enviar la ubicación al servidor en segundo plano (AJAX)
                        const formData = new FormData();
                        formData.append('qr_data', qrData);
                        formData.append('lat', currentLat);
                        formData.append('lon', currentLon);
                        // Necesitamos el token CSRF para la solicitud POST
                        formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

                        fetch('<?= site_url('mascotas/guardar-ubicacion') ?>', {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                console.log('Respuesta del servidor:', data);
                            })
                            .catch(error => {
                                console.error('Error al guardar la ubicación:', error);
                            });

                    }, function(error) {
                        console.warn(`ERROR(${error.code}): ${error.message}`);
                        // Opcional: Mostrar un mensaje al usuario si no da permiso
                        // Por ejemplo: alert('No se pudo obtener la ubicación. La última ubicación conocida no se actualizará.');
                    });
                } else {
                    console.log("La geolocalización no es soportada por este navegador.");
                }
            }
        });
    </script>
</body>

</html>