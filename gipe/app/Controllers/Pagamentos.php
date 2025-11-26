<?php namespace App\Controllers;
use App\Models\PagamentoModel;

class Pagamentos extends BaseModuleController {
    protected $modelName = PagamentoModel::class;
    protected $title = 'Gestão de Pagamentos';
    protected $baseRoute = 'pagamentos';
    
    protected $listColumns = [
        'valor' => 'Valor (€)', 
        'data_pagamento' => 'Data', 
        'descricao' => 'Descrição'
    ];
    
    protected $formFields = [
        'id_condominio' => ['label' => 'ID Condomínio', 'type' => 'number'],
        'id_utilizador' => ['label' => 'ID Utilizador', 'type' => 'number'],
        'valor'         => ['label' => 'Valor (€)', 'type' => 'number'],
        'data_pagamento'=> ['label' => 'Data Pagamento', 'type' => 'date'],
        'descricao'     => ['label' => 'Descrição', 'type' => 'text']
    ];
}