<?php
namespace App\Models;
use CodeIgniter\Model;

class UnidadeModel extends Model {
    protected $table = 'Unidades';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_condominio', 'numero', 'tipo', 'proprietario_id', 'fracao'];

    // Join para trazer nomes
    public function getUnidadesDetalhadas() {
        return $this->select('Unidades.*, Condominios.nome as nome_condominio, Utilizadores.nome as nome_proprietario')
                    ->join('Condominios', 'Condominios.id = Unidades.id_condominio')
                    ->join('Utilizadores', 'Utilizadores.id = Unidades.proprietario_id', 'left')
                    ->findAll();
    }
}