<?php namespace App\Controllers;
use App\Models\GestorModel;

class Gestores extends BaseModuleController {
    protected $modelName = GestorModel::class;
    protected $title = 'Gestores de Condomínio';
    protected $baseRoute = 'gestores';
    
    protected $listColumns = [
        'nome' => 'Nome', 
        'contato' => 'Contacto', 
        'tipo_servico' => 'Serviço'
    ];
    
    protected $formFields = [
        'nome'          => ['label' => 'Nome Completo', 'type' => 'text'],
        'contato'       => ['label' => 'Contacto', 'type' => 'text'],
        'tipo_servico'  => ['label' => 'Tipo de Serviço', 'type' => 'text'],
        'id_condominio' => ['label' => 'ID Condomínio', 'type' => 'number']
    ];
}