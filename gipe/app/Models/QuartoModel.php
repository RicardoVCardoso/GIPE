<?php

namespace App\Models;

use CodeIgniter\Model;

class QuartoModel extends Model
{
    protected $table            = 'Quartos';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_unidade', 'numero', 'tipo', 'area'];
    protected $returnType       = 'array';
}