<?php namespace App\Controllers; use App\Models\PagamentoModel;
class Pagamentos extends BaseModuleController {
    protected $modelName = PagamentoModel::class; protected $title = 'Pagamentos'; protected $baseRoute = 'pagamentos';
    protected $listColumns = ['valor'=>'Valor (€)', 'data_pagamento'=>'Data', 'descricao'=>'Ref.'];
    protected $formFields = [
        'id_condominio' => ['label'=>'Condomínio', 'relation'=>['model'=>'CondominioModel', 'field'=>'nome']],
        'id_utilizador' => ['label'=>'Pagador', 'relation'=>['model'=>'UtilizadorModel', 'field'=>'nome']],
        'valor' => ['label'=>'Valor (€)', 'type'=>'number', 'step'=>'0.01'],
        'data_pagamento' => ['label'=>'Data', 'type'=>'date'],
        'descricao' => ['label'=>'Notas', 'type'=>'text']
    ];
}