<?php

namespace App\Models;

use CodeIgniter\Model;

class AnexoModel extends Model
{
    protected $table            = 'Anexos';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_ocorrencia', 'id_comunicado', 'id_reuniao', 'arquivo', 'data_upload'];
    protected $returnType       = 'array';
    protected $useSoftDeletes = true; 
    protected $deletedField = 'deleted_at';
}