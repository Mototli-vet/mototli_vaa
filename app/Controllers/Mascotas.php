<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Login extends BaseController
{
    public function index()
    {
        // Si el usuario ya está logueado, redirigir a la página principal
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }
        helper(['form']);
        return view('login/login_view');
    }

    public function authenticate()
    {
        $session = session();
        $model   = new UsuarioModel();
        $request = $this->request;

        $email = $request->getPost('email');
        $password = $request->getPost('password');

        // Buscar usuario por email
        $user = $model->where('USUARIO', $email)->first(); // Asumiendo que USUARIO es el campo para el email

        // Usar password_verify para comparar la contraseña de forma segura
        if ($user && password_verify($password, $user['PASSWORD'])) {
            // Contraseña correcta, iniciar sesión
            $ses_data = [
                'user_id'        => $user['ID_USUARIO'],
                'user_name'      => $user['USUARIO'],
                'user_email'     => $user['USUARIO'],
                'isLoggedIn'     => true,
            ];
            $session->set($ses_data);
            return redirect()->to('/')->with('mensaje', 'Bienvenido de nuevo, ' . $user['USUARIO']);
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
