<?php namespace App\Controllers; use App\Models\ObraModel;
class Obras extends BaseModuleController {
    protected $modelName = ObraModel::class; protected $title = 'Obras'; protected $baseRoute = 'obras';
    protected $listColumns = ['descricao'=>'Obra', 'status'=>'Estado', 'data_inicio'=>'Início'];
    protected $formFields = [
        'unidade_id'=>['label'=>'ID Unidade', 'type'=>'number'], 'descricao'=>['label'=>'Descrição', 'type'=>'textarea'],
        'data_inicio'=>['label'=>'Início', 'type'=>'date'], 'data_fim'=>['label'=>'Fim', 'type'=>'date'],
        'status'=>['label'=>'Estado', 'type'=>'select', 'options'=>['pendente'=>'Pendente', 'concluida'=>'Concluída']]
    ];
}