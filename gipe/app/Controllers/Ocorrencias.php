<?php namespace App\Controllers;
use App\Models\OcorrenciaModel;

class Ocorrencias extends BaseModuleController {
    protected $modelName = OcorrenciaModel::class;
    protected $title = 'Registo de Ocorrências';
    protected $baseRoute = 'ocorrencias';
    
    protected $listColumns = ['descricao'=>'Problema', 'status'=>'Estado', 'data_ocorrencia'=>'Data'];
    
    protected $formFields = [
        'id_condominio' => ['label'=>'Condomínio', 'relation'=>['model'=>'CondominioModel', 'field'=>'nome']],
        'id_unidade' => ['label'=>'A sua Unidade', 'relation'=>['model'=>'UnidadeModel', 'field'=>'numero']],
        'descricao' => ['label'=>'Descreva o Problema', 'type'=>'textarea'],
        'status' => ['label'=>'Estado (Apenas Admin)', 'type'=>'select', 'options'=>['pendente'=>'Pendente', 'resolvida'=>'Resolvida']]
    ];
    
    // No futuro, pode adicionar aqui lógica para o Morador não poder mudar o 'status' no create
}