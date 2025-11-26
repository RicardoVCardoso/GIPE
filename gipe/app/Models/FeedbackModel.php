<?php

namespace App\Models;

use CodeIgniter\Model;

class FeedbackModel extends Model
{
    protected $table            = 'Feedback';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_utilizador', 'comentario', 'data_feedback'];
    protected $returnType       = 'array';
}