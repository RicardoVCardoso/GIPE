<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificacaoModel extends Model
{
    protected $table            = 'Notificacoes';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_utilizador', 'mensagem', 'data_notificacao', 'lida'];
    protected $returnType       = 'array';
    protected $useSoftDeletes = true; 
    protected $deletedField = 'deleted_at';
}