<?php

namespace App\Models;

use CodeIgniter\Model;

class ObraModel extends Model
{
    protected $table            = 'Obras';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['descricao', 'data_inicio', 'data_fim', 'status', 'unidade_id'];
    protected $returnType       = 'array';
    protected $useSoftDeletes = true; 
    protected $deletedField = 'deleted_at';
}