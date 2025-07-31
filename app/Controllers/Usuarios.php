<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Usuarios extends BaseController
{
    /**
     * Verifica si el usuario actual es un administrador.
     * Si no lo es, redirige a la página principal.
     */
    private function checkAdmin()
    {
        if (!session()->get('isLoggedIn') || session()->get('user_rol') != 1) {
            return redirect()->to('/')->with('mensaje', 'Acceso no autorizado.');
        }
        return null;
    }

    /**
     * Muestra la página de gestión con todos los usuarios.
     */
    public function gestionar()
    {
        if ($redirect = $this->checkAdmin()) {
            return $redirect;
        }

        $usuarioModel = new UsuarioModel();
        $data['usuarios'] = $usuarioModel->orderBy('ID_USUARIO', 'ASC')->findAll();

        return view('usuarios/gestionar', $data);
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     */
    public function nuevo()
    {
        if ($redirect = $this->checkAdmin()) {
            return $redirect;
        }
        helper(['form']);
        return view('usuarios/nuevo');
    }

    /**
     * Procesa el formulario y guarda el nuevo usuario en la base de datos.
     */
    public function guardar()
    {
        if ($redirect = $this->checkAdmin()) {
            return $redirect;
        }

        $usuarioModel = new UsuarioModel();
        $request = \Config\Services::request();

        // Reglas de validación
        $rules = [
            'nombre'   => 'required|min_length[3]|max_length[100]',
            'email'    => "required|min_length[6]|max_length[100]|valid_email|is_unique[{$usuarioModel->table}.USUARIO]",
            'password' => 'required|min_length[8]',
            'rol'      => 'required|in_list[1,2]' // Asumiendo 1=Admin, 2=Usuario
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'Nombre'   => $request->getPost('nombre'),
            'USUARIO'  => $request->getPost('email'),
            'PASSWORD' => $request->getPost('password'), // Guardamos la contraseña en texto plano
            'ROL'      => $request->getPost('rol'),
        ];

        $usuarioModel->save($data);
        return redirect()->to('/usuarios/gestionar')->with('mensaje', 'Usuario creado con éxito.');
    }

    /**
     * Muestra el formulario para editar un usuario existente.
     */
    public function editar($id = null)
    {
        if ($redirect = $this->checkAdmin()) {
            return $redirect;
        }

        $usuarioModel = new UsuarioModel();
        $data['usuario'] = $usuarioModel->find($id);

        if (empty($data['usuario'])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Usuario no encontrado.');
        }
        helper(['form']);
        return view('usuarios/editar', $data);
    }

    /**
     * Procesa el formulario de edición y actualiza el usuario.
     */
    public function actualizar()
    {
        if ($redirect = $this->checkAdmin()) {
            return $redirect;
        }

        $usuarioModel = new UsuarioModel();
        $request = \Config\Services::request();
        $id = $request->getPost('id_usuario');

        // Reglas de validación
        $rules = [
            'nombre'   => 'required|min_length[3]|max_length[100]',
            // La regla is_unique necesita ignorar el ID del usuario actual
            'email'    => "required|min_length[6]|max_length[100]|valid_email|is_unique[{$usuarioModel->table}.USUARIO,ID_USUARIO,{$id}]",
            'rol'      => 'required|in_list[1,2]'
        ];

        // La contraseña solo es requerida si se proporciona una nueva
        if ($request->getPost('password')) {
            $rules['password'] = 'required|min_length[8]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'ID_USUARIO' => $id,
            'Nombre'     => $request->getPost('nombre'),
            'USUARIO'    => $request->getPost('email'),
            'ROL'        => $request->getPost('rol'),
        ];

        // Actualizar la contraseña solo si se ha introducido una nueva
        if ($request->getPost('password')) {
            $data['PASSWORD'] = $request->getPost('password');
        }

        $usuarioModel->save($data);
        return redirect()->to('/usuarios/gestionar')->with('mensaje', 'Usuario actualizado con éxito.');
    }

    /**
     * Elimina un usuario de la base de datos.
     */
    public function eliminar($id = null)
    {
        if ($redirect = $this->checkAdmin()) {
            return $redirect;
        }

        // Prevenir que un admin se elimine a sí mismo
        if ($id == session()->get('user_id')) {
            return redirect()->to('/usuarios/gestionar')->with('mensaje', 'Error: No puedes eliminar tu propia cuenta de administrador.');
        }

        $usuarioModel = new UsuarioModel();
        $usuarioModel->delete($id);

        return redirect()->to('/usuarios/gestionar')->with('mensaje', 'Usuario eliminado con éxito.');
    }
}
