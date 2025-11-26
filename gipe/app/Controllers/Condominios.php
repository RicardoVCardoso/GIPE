<?php namespace App\Controllers; use App\Models\CondominioModel;
class Condominios extends BaseModuleController {
    protected $modelName = CondominioModel::class; protected $title = 'Condomínios'; protected $baseRoute = 'condominios';
    protected $listColumns = ['nome'=>'Nome', 'endereco'=>'Endereço', 'telefone'=>'Telefone'];
    protected $formFields = [
        'nome'=>['label'=>'Nome', 'type'=>'text'], 'endereco'=>['label'=>'Endereço', 'type'=>'text'],
        'telefone'=>['label'=>'Telefone', 'type'=>'text'], 'administrador_id'=>['label'=>'ID Admin', 'type'=>'number']
    ];
}