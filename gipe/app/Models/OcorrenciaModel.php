<?php

namespace App\Models;

use CodeIgniter\Model;

class OcorrenciaModel extends Model
{
    protected $table            = 'Ocorrencias';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_condominio', 'id_unidade', 'descricao', 'data_ocorrencia', 'status'];
    protected $returnType       = 'array';
    protected $useSoftDeletes = true; 
    protected $deletedField = 'deleted_at';
}