<?php

namespace App\Models;

use CodeIgniter\Model;

class ReuniaoModel extends Model
{
    protected $table            = 'Reunioes';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_condominio', 'data_reuniao', 'hora_reuniao', 'local', 'pauta'];
    protected $returnType       = 'array';
}