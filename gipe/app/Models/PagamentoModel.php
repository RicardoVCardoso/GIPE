<?php

namespace App\Models;

use CodeIgniter\Model;

class PagamentoModel extends Model
{
    protected $table            = 'Pagamentos';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_condominio', 'id_utilizador', 'valor', 'data_pagamento', 'descricao'];
    protected $returnType       = 'array';
    protected $useSoftDeletes = true; 
    protected $deletedField = 'deleted_at';
}