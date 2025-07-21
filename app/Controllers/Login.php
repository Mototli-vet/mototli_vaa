<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Login extends BaseController
{
    public function index()
    {
        // Si el usuario ya está logueado, redirigir a la página que le corresponde
        if (session()->get('isLoggedIn')) {
            if (session()->get('user_rol') == 1) {
                return redirect()->to('/dashboard');
            }
            // Los usuarios no administradores van a la página principal
            return redirect()->to('/');
        }
        helper(['form']);
        return view('login/login_view');
    }

    public function authenticate()
    {
        $session = session();
        $model = new UsuarioModel();
        $request = \Config\Services::request();

        $email = $request->getPost('email');
        $password = $request->getPost('password');

        // Buscar usuario por email
        $user = $model->where('USUARIO', $email)->first();

        // ADVERTENCIA: Comparar contraseñas en texto plano es muy inseguro.
        if ($user && $password === $user['PASSWORD']) {
            // Contraseña correcta, iniciar sesión
            $ses_data = [
                'user_id'        => $user['ID_USUARIO'],
                'user_name'      => $user['USUARIO'], // Este es el email
                'user_full_name' => $user['Nombre'], // Nombre completo del usuario
                'user_rol'       => $user['ROL'],
                'isLoggedIn'     => true,
            ];
            $session->set($ses_data);

            // Redirección basada en el rol
            if ($user['ROL'] == 1) { // Asumiendo que 1 es el rol de administrador
                return redirect()->to('/dashboard')->with('mensaje', 'Bienvenido al panel de administrador, ' . $user['Nombre']);
            }

            return redirect()->to('/')->with('mensaje', 'Bienvenido de nuevo, ' . $user['Nombre']);
        }

        // Si el usuario no existe o la contraseña es incorrecta
        $session->setFlashdata('msg', 'Email o contraseña incorrectos.');
        return redirect()->to('/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
