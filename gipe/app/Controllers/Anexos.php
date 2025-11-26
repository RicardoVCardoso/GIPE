<?php namespace App\Controllers;
use App\Models\AnexoModel;

class Anexos extends BaseModuleController {
    protected $modelName = AnexoModel::class;
    protected $title = 'Gestão de Anexos';
    protected $baseRoute = 'anexos';
    
    protected $listColumns = [
        'arquivo' => 'Nome do Ficheiro', 
        'data_upload' => 'Data Upload'
    ];
    
    protected $formFields = [
        'id_ocorrencia' => ['label' => 'ID Ocorrência (Opcional)', 'type' => 'number'],
        'id_comunicado' => ['label' => 'ID Comunicado (Opcional)', 'type' => 'number'],
        'id_reuniao'    => ['label' => 'ID Reunião (Opcional)', 'type' => 'number'],
        'arquivo'       => ['label' => 'Nome do Ficheiro', 'type' => 'text'] // Idealmente seria um input type="file"
    ];
}