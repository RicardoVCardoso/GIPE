<?php namespace App\Controllers;
use App\Models\DespesaModel;

class Despesas extends BaseModuleController {
    protected $modelName = DespesaModel::class;
    protected $title = 'Despesas';
    protected $baseRoute = 'despesas';
    
    protected $listColumns = ['descricao' => 'Descrição', 'valor' => 'Valor', 'status' => 'Estado'];
    
    protected $formFields = [
        'id_condominio' => [
            'label' => 'Condomínio',
            'relation' => ['model' => 'CondominioModel', 'field' => 'nome']
        ],
        'descricao' => ['label' => 'Descrição', 'type' => 'text'],
        'valor'     => ['label' => 'Valor (€)', 'type' => 'number', 'step' => '0.01'],
        'data'      => ['label' => 'Data Vencimento', 'type' => 'date'],
        'status'    => ['label' => 'Estado', 'type' => 'select', 'options' => ['pendente' => 'Pendente', 'paga' => 'Paga']]
    ];
}