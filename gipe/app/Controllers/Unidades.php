<?php namespace App\Controllers;
use App\Models\UnidadeModel;

class Unidades extends BaseModuleController {
    protected $modelName = UnidadeModel::class;
    protected $title = 'Unidades';
    protected $baseRoute = 'unidades';
    
    protected $listColumns = ['numero'=>'Número', 'tipo'=>'Tipo', 'fracao'=>'Fração'];
    
    protected $formFields = [
        'id_condominio' => [
            'label' => 'Condomínio', 
            'relation' => ['model' => 'CondominioModel', 'field' => 'nome'] // <--- MÁGICA AQUI
        ],
        'proprietario_id' => [
            'label' => 'Proprietário', 
            'relation' => ['model' => 'UtilizadorModel', 'field' => 'nome']
        ],
        'numero' => ['label'=>'Número da Porta', 'type'=>'text'],
        'tipo'   => ['label'=>'Tipo', 'type'=>'select', 'options'=>['apartamento'=>'Apartamento', 'casa'=>'Casa', 'cobertura'=>'Cobertura']],
        'fracao' => ['label'=>'Fração (%)', 'type'=>'number', 'step'=>'0.01']
    ];
}