<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\CondominioModel; // Importar o modelo de condomínios

class UtilizadorModel extends Model
{
    protected $table            = 'Utilizadores';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nome', 'email', 'senha', 'tipo', 'status', 'deleted_at'];
    protected $returnType       = 'array';

    protected $useSoftDeletes   = true;
    protected $deletedField     = 'deleted_at';

    // Validations
    protected $validationRules = [
        'id'    => 'permit_empty',
        'nome'  => 'required|min_length[3]|max_length[100]',
        'email' => 'required|valid_email|is_unique[Utilizadores.email,id,{id}]', 
        'senha' => 'permit_empty|min_length[6]',
        'tipo'  => 'required|in_list[admin,gestor,morador]',
    ];

    protected $validationMessages = [
        'email' => ['is_unique' => 'Este email já se encontra registado.']
    ];

    // EVENTOS: Adicionar 'deleteRelatedCondominios' ao afterDelete
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];
    protected $afterDelete  = ['deleteRelatedCondominios']; 

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['senha'])) {
            $data['data']['senha'] = password_hash($data['data']['senha'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    // NOVA FUNÇÃO: Apagar condomínios associados
    protected function deleteRelatedCondominios(array $data)
    {
        // Verifica se o delete foi bem sucedido e se temos IDs
        if ($data['result'] && !empty($data['id'])) {
            $condominioModel = new CondominioModel();
            
            // O $data['id'] pode ser um array de IDs ou um único ID
            $ids = is_array($data['id']) ? $data['id'] : [$data['id']];

            // Procura e apaga (Soft Delete) todos os condomínios geridos por estes utilizadores
            // Onde 'administrador_id' é igual ao utilizador que acabámos de apagar
            $condominios = $condominioModel->whereIn('administrador_id', $ids)->findAll();
            
            foreach ($condominios as $condominio) {
                $condominioModel->delete($condominio['id']);
            }
        }
        
        return $data;
    }
}