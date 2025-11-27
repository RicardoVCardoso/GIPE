<?php namespace App\Models; use CodeIgniter\Model;
class CondominioModel extends Model {
    protected $table = 'Condominios'; protected $primaryKey = 'id';
    protected $allowedFields = ['nome', 'endereco', 'telefone', 'administrador_id', 'deleted_at'];
    protected $useSoftDeletes   = true; // <--- OBRIGATÓRIO
    protected $deletedField     = 'deleted_at'; // <--- OBRIGATÓRIO
}