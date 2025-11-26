<?php namespace App\Controllers;
use App\Models\ReuniaoModel;

class Reunioes extends BaseModuleController {
    protected $modelName = ReuniaoModel::class;
    protected $title = 'Reuniões de Condomínio';
    protected $baseRoute = 'reunioes';
    
    protected $listColumns = [
        'data_reuniao' => 'Data', 
        'hora_reuniao' => 'Hora', 
        'local' => 'Local'
    ];
    
    protected $formFields = [
        'id_condominio' => ['label' => 'ID Condomínio', 'type' => 'number'],
        'data_reuniao'  => ['label' => 'Data', 'type' => 'date'],
        'hora_reuniao'  => ['label' => 'Hora', 'type' => 'time'],
        'local'         => ['label' => 'Local', 'type' => 'text'],
        'pauta'         => ['label' => 'Pauta / Assuntos', 'type' => 'textarea']
    ];
}