<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoricoPagamentoModel extends Model
{
    protected $table            = 'Historico_Pagamentos';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_pagamento', 'data_historico'];
    protected $returnType       = 'array';
}