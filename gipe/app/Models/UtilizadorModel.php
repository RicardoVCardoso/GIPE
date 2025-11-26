<?php

namespace App\Models;

use CodeIgniter\Model;

class UtilizadorModel extends Model
{
    protected $table            = 'Utilizadores';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['nome', 'email', 'senha', 'tipo'];

    // Validation
    protected $validationRules = [
        'nome'  => 'required|min_length[3]|max_length[100]',
        'email' => 'required|valid_email|is_unique[Utilizadores.email]',
        'senha' => 'required|min_length[6]',
        'tipo'  => 'required|in_list[administrador,morador]',
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Este email já se encontra registado na nossa base de dados.'
        ]
    ];

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['hashPassword'];
    protected $beforeUpdate   = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['senha'])) {
            $data['data']['senha'] = password_hash($data['data']['senha'], PASSWORD_DEFAULT);
        }
        return $data;
    }
}