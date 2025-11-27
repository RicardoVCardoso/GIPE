<?php namespace App\Models; use CodeIgniter\Model;
class UnidadeModel extends Model {
    protected $table = 'Unidades'; protected $primaryKey = 'id';
    protected $allowedFields = ['id_condominio', 'numero', 'tipo', 'proprietario_id', 'fracao', 'deleted_at'];
    protected $useSoftDeletes = true; protected $deletedField = 'deleted_at';
}