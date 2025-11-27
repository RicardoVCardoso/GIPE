<?php namespace App\Controllers; use App\Models\ReuniaoModel;
class Reunioes extends BaseModuleController {
    protected $modelName = ReuniaoModel::class; protected $title = 'Reuniões'; protected $baseRoute = 'reunioes';
    protected $listColumns = ['data_reuniao'=>'Data', 'hora_reuniao'=>'Hora', 'local'=>'Local'];
    protected $formFields = [
        'id_condominio' => ['label'=>'Condomínio', 'relation'=>['model'=>'CondominioModel', 'field'=>'nome']],
        'data_reuniao' => ['label'=>'Data', 'type'=>'date'],
        'hora_reuniao' => ['label'=>'Hora', 'type'=>'time'],
        'local' => ['label'=>'Local', 'type'=>'text'],
        'pauta' => ['label'=>'Ordem de Trabalhos', 'type'=>'textarea']
    ];
}