<?php namespace App\Models; use CodeIgniter\Model;
class PrestadorModel extends Model {
    protected $table = 'Prestador_servicos'; protected $primaryKey = 'id';
    protected $allowedFields = ['nome', 'cargo', 'telefone', 'email', 'id_condominio', 'deleted_at'];
    protected $useSoftDeletes = true; protected $deletedField = 'deleted_at';
}