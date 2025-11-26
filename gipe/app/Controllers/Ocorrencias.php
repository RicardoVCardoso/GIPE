<?php namespace App\Controllers;
use App\Models\OcorrenciaModel;

class Ocorrencias extends BaseModuleController {
    protected $modelName = OcorrenciaModel::class;
    protected $title = 'Ocorrências';
    protected $baseRoute = 'ocorrencias';
    protected $listColumns = ['descricao' => 'Problema', 'status' => 'Estado', 'data_ocorrencia' => 'Data'];
    protected $formFields = [
        'id_condominio' => ['label' => 'ID Condomínio', 'type' => 'number'],
        'id_unidade' => ['label' => 'ID Unidade', 'type' => 'number'],
        'descricao' => ['label' => 'Descrição do Problema', 'type' => 'textarea'],
        'status' => ['label' => 'Estado', 'type' => 'select', 'options' => ['pendente' => 'Pendente', 'resolvida' => 'Resolvida']]
    ];
}