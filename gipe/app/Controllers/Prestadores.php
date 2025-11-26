<?php namespace App\Controllers;
use App\Models\PrestadorModel;

class Prestadores extends BaseModuleController {
    protected $modelName = PrestadorModel::class;
    protected $title = 'Prestadores de Serviço';
    protected $baseRoute = 'prestadores';
    protected $listColumns = ['nome' => 'Nome', 'cargo' => 'Cargo', 'telefone' => 'Telefone'];
    protected $formFields = [
        'id_condominio' => ['label' => 'ID Condomínio', 'type' => 'number'],
        'nome' => ['label' => 'Nome', 'type' => 'text'],
        'cargo' => ['label' => 'Cargo/Função', 'type' => 'text'],
        'telefone' => ['label' => 'Telefone', 'type' => 'text'],
        'email' => ['label' => 'Email', 'type' => 'email']
    ];
}