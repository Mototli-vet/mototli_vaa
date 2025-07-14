<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table            = 've_usuarios';
    protected $primaryKey       = 'ID_USUARIO';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['USUARIO', 'PASSWORD', 'ROL'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Callbacks
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        // Comprobar si se está enviando una contraseña en el campo 'PASSWORD' (mayúsculas)
        if (! isset($data['data']['PASSWORD'])) {
            return $data;
        }

        // Hashear la contraseña y reemplazar el valor original en el mismo campo 'PASSWORD'
        $data['data']['PASSWORD'] = password_hash($data['data']['PASSWORD'], PASSWORD_DEFAULT);

        return $data;
    }
}
