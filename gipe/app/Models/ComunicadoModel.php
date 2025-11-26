<?php

namespace App\Models;

use CodeIgniter\Model;

class ComunicadoModel extends Model
{
    protected $table            = 'Comunicados';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_condominio', 'titulo', 'mensagem', 'data_publicacao'];
    protected $returnType       = 'array';
}