<?php

namespace App\Models;

use CodeIgniter\Model;

class ReceitaModel extends Model
{
    protected $table            = 'Receitas';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_condominio', 'descricao', 'valor', 'data'];
    protected $returnType       = 'array';
}