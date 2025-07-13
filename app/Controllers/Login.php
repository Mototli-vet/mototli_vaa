<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Login extends BaseController
{
    public function index()
    {
        // Si el usuario ya está logueado, redirigir a la página principal
        if (session()->get('isLoggedIn')) {
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
        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password_hash'])) {
            // Contraseña correcta, iniciar sesión
            $ses_data = [
                'user_id'        => $user['id'],
                'user_name'      => $user['nombre_usuario'],
                'user_email'     => $user['email'],
                'isLoggedIn'     => true,
            ];
            $session->set($ses_data);
            return redirect()->to('/')->with('mensaje', 'Bienvenido de nuevo, ' . $user['nombre_usuario']);
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
