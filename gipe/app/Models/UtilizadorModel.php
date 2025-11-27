<?php

namespace App\Models;

use CodeIgniter\Model;

class UtilizadorModel extends Model
{
    protected $table            = 'Utilizadores';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nome', 'email', 'senha', 'tipo', 'status', 'deleted_at'];
    protected $returnType       = 'array';

    protected $useSoftDeletes   = true;
    protected $deletedField     = 'deleted_at';

    // CORREÇÃO DO ERRO: Adicionada a regra para 'id'
    protected $validationRules = [
        'id'    => 'permit_empty', // <--- ESTA LINHA RESOLVE O LOGIC EXCEPTION
        'nome'  => 'required|min_length[3]|max_length[100]',
        'email' => 'required|valid_email|is_unique[Utilizadores.email,id,{id}]', 
        'senha' => 'permit_empty|min_length[6]',
        'tipo'  => 'required|in_list[admin,gestor,morador]',
    ];

    protected $validationMessages = [
        'email' => ['is_unique' => 'Este email já se encontra registado.']
    ];

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