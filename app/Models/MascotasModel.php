<?php

namespace App\Models;

use CodeIgniter\Model;

class MascotasModel extends Model
{
    protected $table            = 've_mascotas';
    protected $primaryKey       = 'ID_MASCOTA';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array'; // Puedes usar 'object' si lo prefieres
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        // Asumiendo que la columna para el nombre de la mascota es 'NOMBRE'
        // y coincide con $request->getPost('nombre')
        'NOMBRE_MASCOTA',
        'RAZA',
        'FECHA_NACIMIENTO',
        'COLOR',
        'DESCRIPCION',
        'QR_CODE_PATH', // Asegúrate de que esta columna exista en tu tabla VE_MASCOTAS
        'NOMBRE',
        'contacto_propietario',
        'ID_USUARIO', // Campo para relacionar la mascota con el usuario
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at'; // Descomenta si decides usar soft deletes

    // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = [];
    // protected $afterInsert    = [];
    // ... (otros callbacks si los necesitas)
}
