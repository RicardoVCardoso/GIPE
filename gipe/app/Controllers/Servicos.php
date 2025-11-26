<?php namespace App\Controllers;
use App\Models\ServicoModel;

class Servicos extends BaseModuleController {
    protected $modelName = ServicoModel::class;
    protected $title = 'Serviços Contratados';
    protected $baseRoute = 'servicos';
    
    protected $listColumns = [
        'descricao' => 'Descrição', 
        'valor' => 'Custo (€)', 
        'data_servico' => 'Data'
    ];
    
    protected $formFields = [
        'id_condominio' => ['label' => 'ID Condomínio', 'type' => 'number'],
        'descricao'     => ['label' => 'Descrição do Serviço', 'type' => 'text'],
        'valor'         => ['label' => 'Valor (€)', 'type' => 'number'],
        'data_servico'  => ['label' => 'Data Realização', 'type' => 'date']
    ];
}