<?php

namespace App\Models;

use CodeIgniter\Model;

class ServicoModel extends Model
{
    protected $table            = 'Servicos';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_condominio', 'descricao', 'valor', 'data_servico'];
    protected $returnType       = 'array';
    protected $useSoftDeletes = true; 
    protected $deletedField = 'deleted_at';
}