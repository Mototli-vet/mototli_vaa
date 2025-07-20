<?php

namespace App\Controllers;

use App\Models\MascotasModel;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class Mascotas extends BaseController
{
    public function index()
    {
        $mascotasModel = new MascotasModel();
        $data['mascotas'] = $mascotasModel->orderBy('ID_MASCOTA', 'DESC')->findAll();
        return view('principal/index', $data);
    }

    public function informacion()
    {
        // Muestra la página de información general sobre mascotas
        return view('infoMascotas/infoMascotas');
    }

    public function misMascotas()
    {
        // Es una buena práctica verificar si el usuario ha iniciado sesión
        // antes de mostrarle una página de "Mis Mascotas".
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $mascotasModel = new MascotasModel();

        // IDEALMENTE: Deberías filtrar las mascotas por el ID del usuario que ha iniciado sesión.
        // Esto requeriría añadir una columna `ID_USUARIO` a tu tabla `mascotas`.
        // Ejemplo:
        // $userId = session()->get('user_id');
        // $data['mascotas'] = $mascotasModel->where('ID_USUARIO', $userId)->orderBy('ID_MASCOTA', 'DESC')->findAll();
        $data['mascotas'] = $mascotasModel->orderBy('ID_MASCOTA', 'DESC')->findAll();

        return view('mascotas/misMascotas', $data);
    }

    public function nuevo()
    {
        // Muestra el formulario para agregar una nueva mascota
        return view('mascotas/mascotasview'); // This view name seems fine
    }

    public function guardar()
    {
        $mascotasModel = new MascotasModel();
        $request = \Config\Services::request();

        // Ensure keys match the $allowedFields in MascotasModel (e.g., uppercase)
        // Assuming model's allowedFields will be: NOMBRE, RAZA, FECHA_NACIMIENTO, NOMBRE_PROPIETARIO, CONTACTO_PROPIETARIO, QR_DATA
        $datosMascota = [
            'NOMBRE' => $request->getPost('nombre'),
            'RAZA' => $request->getPost('raza'),
            'FECHA_NACIMIENTO' => $request->getPost('fecha_nacimiento'),
            'NOMBRE_PROPIETARIO' => $request->getPost('nombre_propietario'),
            'CONTACTO_PROPIETARIO' => $request->getPost('contacto_propietario'),
        ];

        // Generar un identificador único para el QR.
        // Podrías usar el ID del perro después de la inserción para mayor simplicidad y unicidad garantizada.
        // Ejemplo: $datosPerro['qr_data'] = 'perro_id_' . $perroModel->getInsertID();
        // Por ahora, usaremos uniqid() antes de la inserción.
        $uniqueQrData = uniqid('qr_', true);
        $datosMascota['QR_DATA'] = $uniqueQrData; // Match expected model field

        if ($mascotasModel->save($datosMascota)) {
            // Opcional: si quieres usar el ID del perro en el qr_data
            // $mascotaId = $mascotasModel->getInsertID();
            // $newQrData = 'mascotaid_' . $mascotaId;
            // $mascotasModel->update($mascotaId, ['QR_DATA' => $newQrData]); // Match expected model field
            // return redirect()->to(base_url('mascotas/ver/' . $newQrData))->with('mensaje', 'Mascota registrada con éxito.');

            return redirect()->to(base_url('mascotas/ver/' . $uniqueQrData))->with('mensaje', 'Mascota registrada con éxito.');
        } else {
            // Si la validación falla (debes configurar reglas en el modelo o aquí)
            return redirect()->back()->withInput()->with('errores', $mascotasModel->errors());
        }
    }

    public function ver($qr_data)
    {
        $mascotasModel = new MascotasModel();
        $mascota = $mascotasModel->where('QR_DATA', $qr_data)->first(); // Match expected model field

        if (!$mascota) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('No se encontró la mascota con el QR especificado.');
        }

        $data['mascota'] = $mascota;

        // Generar el código QR
        $qrUrl = base_url('mascotas/ver/' . $qr_data); // URL que contendrá el QR
        $qrOptions = new QROptions(['outputType' => QRCode::OUTPUT_IMAGE_PNG, 'eccLevel' => QRCode::ECC_L]);
        $qrcode = new QRCode($qrOptions);
        $data['qrCodeImagen'] = $qrcode->render($qrUrl); // Genera la imagen QR como string base64 (data URI)

        return view('mascotas/ver_mascota', $data); // Suggest renaming view file for consistency
    }
}
