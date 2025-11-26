<?php namespace App\Controllers; use App\Models\UtilizadorModel;
class Utilizadores extends BaseModuleController {
    protected $modelName = UtilizadorModel::class; protected $title = 'Utilizadores'; protected $baseRoute = 'utilizadores';
    protected $listColumns = ['nome'=>'Nome', 'email'=>'Email', 'tipo'=>'Tipo'];
    protected $formFields = [
        'nome'=>['label'=>'Nome', 'type'=>'text'], 'email'=>['label'=>'Email', 'type'=>'email'],
        'senha'=>['label'=>'Senha', 'type'=>'password'], 'tipo'=>['label'=>'Tipo', 'type'=>'select', 'options'=>['administrador'=>'Admin', 'morador'=>'Morador']]
    ];
}