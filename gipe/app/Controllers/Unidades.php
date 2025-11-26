<?php namespace App\Controllers; use App\Models\UnidadeModel;
class Unidades extends BaseModuleController {
    protected $modelName = UnidadeModel::class; protected $title = 'Unidades'; protected $baseRoute = 'unidades';
    protected $listColumns = ['numero'=>'Porta', 'tipo'=>'Tipo', 'fracao'=>'Fração'];
    protected $formFields = [
        'id_condominio'=>['label'=>'ID Condomínio', 'type'=>'number'], 'numero'=>['label'=>'Número', 'type'=>'text'],
        'tipo'=>['label'=>'Tipo', 'type'=>'select', 'options'=>['apartamento'=>'Apartamento', 'casa'=>'Casa']],
        'proprietario_id'=>['label'=>'ID Proprietário', 'type'=>'number'], 'fracao'=>['label'=>'Fração', 'type'=>'text']
    ];
}