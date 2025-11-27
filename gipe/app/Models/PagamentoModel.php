<?php

namespace App\Models;

use CodeIgniter\Model;

class PagamentoModel extends Model
{
    protected $table            = 'Pagamentos';
    protected $primaryKey       = 'id';
    // ADICIONADO 'status' para permitir marcar como pago
    protected $allowedFields    = ['id_condominio', 'id_utilizador', 'valor', 'data_pagamento', 'descricao', 'status', 'deleted_at'];
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true; 
    protected $deletedField     = 'deleted_at';
}