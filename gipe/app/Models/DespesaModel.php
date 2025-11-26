<?php

namespace App\Models;

use CodeIgniter\Model;

class DespesaModel extends Model
{
    protected $table            = 'Despesas';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_condominio', 'descricao', 'valor', 'data', 'status'];
    protected $returnType       = 'array';
}