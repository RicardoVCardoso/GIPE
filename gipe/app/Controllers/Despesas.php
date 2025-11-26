<?php namespace App\Controllers;
use App\Models\DespesaModel;

class Despesas extends BaseModuleController {
    protected $modelName = DespesaModel::class;
    protected $title = 'Despesas do Condomínio';
    protected $baseRoute = 'despesas';
    protected $listColumns = ['descricao' => 'Descrição', 'valor' => 'Valor (€)', 'data' => 'Data', 'status' => 'Estado'];
    protected $formFields = [
        'id_condominio' => ['label' => 'ID Condomínio', 'type' => 'number'],
        'descricao' => ['label' => 'Descrição', 'type' => 'text'],
        'valor' => ['label' => 'Valor', 'type' => 'number'],
        'data' => ['label' => 'Data', 'type' => 'date'],
        'status' => ['label' => 'Estado', 'type' => 'select', 'options' => ['pendente' => 'Pendente', 'paga' => 'Paga']]
    ];
}