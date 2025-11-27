<?php namespace App\Models; use CodeIgniter\Model;
class GestorModel extends Model {
    protected $table = 'Gestores'; protected $primaryKey = 'id';
    protected $allowedFields = ['nome', 'contato', 'tipo_servico', 'id_condominio', 'deleted_at'];
    protected $useSoftDeletes = true; 
    protected $deletedField = 'deleted_at';
    
}