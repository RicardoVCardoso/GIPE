<?php namespace App\Controllers; use App\Models\ServicoModel;
class Servicos extends BaseModuleController {
    protected $modelName = ServicoModel::class; protected $title = 'Serviços'; protected $baseRoute = 'servicos';
    protected $listColumns = ['descricao'=>'Serviço', 'valor'=>'Custo', 'data_servico'=>'Data'];
    protected $formFields = [
        'id_condominio' => ['label'=>'Condomínio', 'relation'=>['model'=>'CondominioModel', 'field'=>'nome']],
        'descricao' => ['label'=>'Descrição', 'type'=>'text'],
        'valor' => ['label'=>'Custo Previsto', 'type'=>'number', 'step'=>'0.01'],
        'data_servico' => ['label'=>'Data Agendada', 'type'=>'date']
    ];
}