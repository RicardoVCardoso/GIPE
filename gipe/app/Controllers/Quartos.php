<?php namespace App\Controllers;
use App\Models\QuartoModel;

class Quartos extends BaseModuleController {
    protected $modelName = QuartoModel::class;
    protected $title = 'Quartos';
    protected $baseRoute = 'quartos';
    
    protected $listColumns = ['numero' => 'Número', 'tipo' => 'Tipo', 'area' => 'Área'];
    
    protected $formFields = [
        'id_unidade' => [
            'label' => 'Pertence à Unidade (ID)', 
            'relation' => ['model' => 'UnidadeModel', 'field' => 'numero'] // Mostra o numero da unidade
        ],
        'numero' => ['label' => 'Número do Quarto', 'type' => 'text'],
        'tipo'   => ['label' => 'Tipo', 'type' => 'select', 'options' => ['quarto' => 'Quarto Simples', 'suite' => 'Suite']],
        'area'   => ['label' => 'Área (m²)', 'type' => 'number']
    ];
}