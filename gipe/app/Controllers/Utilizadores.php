<?php namespace App\Controllers;
use App\Models\UtilizadorModel;

class Utilizadores extends BaseModuleController {
    protected $modelName = UtilizadorModel::class;
    protected $title = 'Gestão de Utilizadores';
    protected $baseRoute = 'utilizadores';
    
    protected $listColumns = ['nome'=>'Nome', 'email'=>'Email', 'tipo'=>'Função', 'status'=>'Estado'];
    
    protected $formFields = [
        'nome'  => ['label'=>'Nome Completo', 'type'=>'text'],
        'email' => ['label'=>'Email', 'type'=>'email'],
        'senha' => ['label'=>'Senha (Nova)', 'type'=>'password'],
        'tipo'  => ['label'=>'Tipo de Conta', 'type'=>'select', 'options'=>['morador'=>'Morador', 'gestor'=>'Gestor', 'admin'=>'Admin']],
        'status'=> ['label'=>'Estado da Conta', 'type'=>'select', 'options'=>['pendente'=>'Pendente (Aguardando)', 'ativo'=>'Ativo (Aprovado)', 'bloqueado'=>'Bloqueado']]
    ];
}