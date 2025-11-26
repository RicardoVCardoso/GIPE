<?php

namespace App\Models;

use CodeIgniter\Model;

class UtilizadorModel extends Model
{
    protected $table            = 'Utilizadores';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nome', 'email', 'senha', 'tipo', 'status']; // Adicionado status
    protected $returnType       = 'array';

    // Regras de validação
    protected $validationRules = [
        'nome'  => 'required|min_length[3]|max_length[100]',
        'email' => 'required|valid_email|is_unique[Utilizadores.email]',
        'senha' => 'required|min_length[6]',
        'tipo'  => 'required|in_list[admin,gestor,morador]',
    ];

    protected $validationMessages = [
        'email' => ['is_unique' => 'Este email já está registado.']
    ];

    // Encriptar senha automaticamente
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['senha'])) {
            $data['data']['senha'] = password_hash($data['data']['senha'], PASSWORD_DEFAULT);
        }
        return $data;
    }
}