<?php namespace App\Controllers;
use App\Models\ComunicadoModel;

class Comunicados extends BaseModuleController {
    protected $modelName = ComunicadoModel::class;
    protected $title = 'Quadro de Avisos';
    protected $baseRoute = 'comunicados';
    
    protected $listColumns = ['titulo'=>'Assunto', 'data_publicacao'=>'Data'];
    
    protected $formFields = [
        'id_condominio' => ['label'=>'Condomínio', 'relation'=>['model'=>'CondominioModel', 'field'=>'nome']],
        'titulo' => ['label'=>'Título do Aviso', 'type'=>'text'],
        'mensagem' => ['label'=>'Conteúdo', 'type'=>'textarea'],
        // data_publicacao é automático no SQL (timestamp) ou pode adicionar aqui
    ];
}