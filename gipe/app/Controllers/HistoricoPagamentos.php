<?php namespace App\Controllers;
use App\Models\HistoricoPagamentoModel;

class HistoricoPagamentos extends BaseModuleController {
    protected $modelName = HistoricoPagamentoModel::class;
    protected $title = 'Log de Histórico de Pagamentos';
    protected $baseRoute = 'historico_pagamentos';
    
    protected $listColumns = [
        'id_pagamento' => 'Ref. Pagamento', 
        'data_historico' => 'Data Registo'
    ];
    
    protected $formFields = [
        'id_pagamento'   => ['label' => 'ID Pagamento Original', 'type' => 'number'],
        'data_historico' => ['label' => 'Data do Histórico', 'type' => 'date']
    ];
}