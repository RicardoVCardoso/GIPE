<?php

namespace App\Models;

use CodeIgniter\Model;

class AvaliacaoModel extends Model
{
    protected $table            = 'Avaliacoes';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_utilizador', 'id_servico', 'nota', 'comentario', 'data_avaliacao'];
    protected $returnType       = 'array';
    protected $useSoftDeletes = true; 
    protected $deletedField = 'deleted_at';
}