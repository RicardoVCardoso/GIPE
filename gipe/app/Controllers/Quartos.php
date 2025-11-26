<?php namespace App\Controllers;
use App\Models\QuartoModel;

class Quartos extends BaseModuleController {
    protected $modelName = QuartoModel::class;
    protected $title = 'Gestão de Quartos';
    protected $baseRoute = 'quartos';
    
    protected $listColumns = ['numero' => 'Número', 'tipo' => 'Tipo', 'area' => 'Área (m²)'];
    
    protected $formFields = [
        'id_unidade' => ['label' => 'ID Unidade', 'type' => 'number'], // Idealmente seria um select dinâmico
        'numero'     => ['label' => 'Número do Quarto', 'type' => 'text'],
        'tipo'       => ['label' => 'Tipo', 'type' => 'select', 'options' => ['quarto' => 'Quarto Simples', 'suite' => 'Suite']],
        'area'       => ['label' => 'Área', 'type' => 'number']
    ];
}