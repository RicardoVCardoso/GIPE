<?php

namespace App\Models;

use CodeIgniter\Model;

class CondominioModel extends Model
{
    protected $table            = 'Condominios';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nome', 'endereco', 'telefone', 'administrador_id'];
    
    // Relação com o Administrador (opcional, para joins)
    public function getCondominiosComAdmin()
    {
        return $this->select('Condominios.*, Utilizadores.nome as nome_admin')
                    ->join('Utilizadores', 'Utilizadores.id = Condominios.administrador_id', 'left')
                    ->findAll();
    }
}