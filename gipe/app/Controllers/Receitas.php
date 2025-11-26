<?php namespace App\Controllers;
use App\Models\ReceitaModel;

class Receitas extends BaseModuleController {
    protected $modelName = ReceitaModel::class;
    protected $title = 'Receitas';
    protected $baseRoute = 'receitas';
    protected $listColumns = ['descricao' => 'Descrição', 'valor' => 'Valor (€)', 'data' => 'Data'];
    protected $formFields = [
        'id_condominio' => ['label' => 'ID Condomínio', 'type' => 'number'],
        'descricao' => ['label' => 'Descrição', 'type' => 'text'],
        'valor' => ['label' => 'Valor', 'type' => 'number'],
        'data' => ['label' => 'Data', 'type' => 'date']
    ];
}