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

    public function dashboard()
    {
        // Proteger la ruta: solo administradores (ROL=1) pueden acceder
        if (!session()->get('isLoggedIn') || session()->get('user_rol') != 1) {
            // Si no es admin, redirigir a la página principal
            return redirect()->to('/')->with('mensaje', 'Acceso no autorizado.');
        }

        // Aquí se podría cargar datos específicos para el dashboard,
        // como número de usuarios, número de mascotas, etc.
        // $data['total_usuarios'] = ...

        return view('mascotas/dashboard');
    }

    public function misMascotas()
    {
        // Es una buena práctica verificar si el usuario ha iniciado sesión
        // antes de mostrarle una página de "Mis Mascotas".
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $mascotasModel = new MascotasModel();

        // Si es admin (rol=1), mostramos todas las mascotas.
        if (session()->get('user_rol') == 1) {
            $data['mascotas'] = $mascotasModel->orderBy('ID_MASCOTA', 'DESC')->findAll();
        } else {
            // Si no es admin, filtramos para mostrar solo las del usuario que ha iniciado sesión.
            $userId = session()->get('user_id');
            $data['mascotas'] = $mascotasModel->where('ID_DUENO', $userId)->orderBy('ID_MASCOTA', 'DESC')->findAll();
        }

        return view('mascotas/misMascotas', $data);
    }

    public function nuevo()
    {
        // Es una buena práctica verificar si el usuario ha iniciado sesión
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('msg', 'Debes iniciar sesión para registrar una mascota.');
        }

        // Muestra el formulario para agregar una nueva mascota
        // Pasamos los datos del usuario de la sesión a la vista
        $data = [
            'nombre_propietario' => session()->get('user_full_name'),
            'contacto_propietario' => session()->get('user_name'), // user_name es el email
        ];

        return view('mascotas/MascotasView', $data);
    }

    public function guardar()
    {
        $mascotasModel = new MascotasModel();
        $request = \Config\Services::request();

        // Ensure keys match the $allowedFields in MascotasModel (e.g., uppercase)
        // Assuming model's allowedFields will be: NOMBRE, RAZA, FECHA_NACIMIENTO, NOMBRE_PROPIETARIO, CONTACTO_PROPIETARIO, QR_DATA
        $datosMascota = [
            'NOMBRE_MASCOTA' => $request->getPost('nombre'),
            'RAZA' => $request->getPost('raza'),
            'FECHA_NACIMIENTO' => $request->getPost('fecha_nacimiento'),
            'COLOR' => $request->getPost('color'),
            'DESCRIPCION' => $request->getPost('descripcion'),
            'NOMBRE' => $request->getPost('nombre_propietario'),
            'contacto_propietario' => $request->getPost('contacto_propietario'),
            'ID_DUENO' => session()->get('user_id'), // Añadimos el ID del usuario logueado
        ];

        // Generar un identificador único para el QR.
        // Podrías usar el ID del perro después de la inserción para mayor simplicidad y unicidad garantizada.
        // Ejemplo: $datosPerro['qr_data'] = 'perro_id_' . $perroModel->getInsertID();
        // Por ahora, usaremos uniqid() antes de la inserción.
        $uniqueQrData = uniqid('qr_', true);
        $datosMascota['QR_CODE_PATH'] = $uniqueQrData; // Match expected model field

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
        $mascota = $mascotasModel->where('QR_CODE_PATH', $qr_data)->first(); // Match expected model field

        if (!$mascota) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('No se encontró la mascota con el QR especificado.');
        }

        $data['mascota'] = $mascota;

        // Generar el código QR
        $qrUrl = base_url('mascotas/ver/' . $qr_data . '?source=qr'); // URL que contendrá el QR. ¡Añadimos el parámetro!
        $qrOptions = new QROptions([
            'outputType'  => QRCode::OUTPUT_IMAGE_PNG, // Especifica que queremos una imagen PNG
            'imageBase64' => true, // Pide a la librería que devuelva un Data URI (base64)
            'eccLevel'    => QRCode::ECC_L,
        ]);
        $qrcode = new QRCode($qrOptions);
        $data['qrCodeImagen'] = $qrcode->render($qrUrl); // Ahora esto devuelve el Data URI completo

        return view('mascotas/ver_mascota', $data);
    }

    public function eliminar($id = null)
    {
        // Proteger la ruta: solo los administradores pueden eliminar.
        if (session()->get('user_rol') != 1) {
            return redirect()->to('/')->with('mensaje', 'Acceso no autorizado.');
        }

        if ($id === null) {
            return redirect()->to('mascotas/misMascotas')->with('mensaje', 'Error: ID de mascota no proporcionado.');
        }

        $mascotasModel = new MascotasModel();
        $mascotasModel->delete($id);

        return redirect()->to('mascotas/misMascotas')->with('mensaje', 'Mascota eliminada correctamente.');
    }

    public function guardarUbicacion()
    {
        // Se espera una solicitud AJAX (POST)
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403); // Forbidden
        }

        $qr_data = $this->request->getPost('qr_data');
        $lat = $this->request->getPost('lat');
        $lon = $this->request->getPost('lon');

        // Validación básica
        if (empty($qr_data) || !is_numeric($lat) || !is_numeric($lon)) {
            return $this->response->setStatusCode(400)->setJSON(['status' => 'error', 'message' => 'Datos incompletos o inválidos.']);
        }

        $mascotasModel = new MascotasModel();
        $mascota = $mascotasModel->where('QR_CODE_PATH', $qr_data)->first();

        if (!$mascota) {
            return $this->response->setStatusCode(404)->setJSON(['status' => 'error', 'message' => 'Mascota no encontrada.']);
        }

        $updateData = [
            'ULTIMA_LATITUD' => $lat,
            'ULTIMA_LONGITUD' => $lon,
        ];

        if ($mascotasModel->update($mascota['ID_MASCOTA'], $updateData)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Ubicación guardada.']);
        }

        return $this->response->setStatusCode(500)->setJSON(['status' => 'error', 'message' => 'No se pudo guardar la ubicación.']);
    }
}
