<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservaModel extends Model
{
    protected $table            = 'Reservas';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_condominio', 'id_unidade', 'data_reserva', 'horario_inicio', 'horario_fim', 'descricao'];
    protected $returnType       = 'array';
}