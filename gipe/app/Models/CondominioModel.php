<?php

namespace App\Models;

use CodeIgniter\Model;

class CondominioModel extends Model
{
    protected $table            = 'Condominios';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nome', 'endereco', 'telefone', 'administrador_id'];
    
    // --- CORREÇÃO DO PROBLEMA DE ELIMINAÇÃO ---
    protected $useSoftDeletes   = true;
    protected $deletedField     = 'deleted_at';
    // ------------------------------------------

    public function getCondominiosComAdmin()
    {
        // O findAll já filtra automaticamente os apagados quando useSoftDeletes é true
        return $this->select('Condominios.*, Utilizadores.nome as nome_admin')
                    ->join('Utilizadores', 'Utilizadores.id = Condominios.administrador_id', 'left')
                    ->findAll();
    }
}