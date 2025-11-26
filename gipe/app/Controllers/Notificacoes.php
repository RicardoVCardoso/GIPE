<?php namespace App\Controllers;
use App\Models\NotificacaoModel;

class Notificacoes extends BaseModuleController {
    protected $modelName = NotificacaoModel::class;
    protected $title = 'Notificações do Sistema';
    protected $baseRoute = 'notificacoes';
    
    protected $listColumns = [
        'mensagem' => 'Mensagem', 
        'data_notificacao' => 'Data Envio', 
        'lida' => 'Lida?'
    ];
    
    protected $formFields = [
        'id_utilizador'    => ['label' => 'ID Destinatário', 'type' => 'number'],
        'mensagem'         => ['label' => 'Mensagem', 'type' => 'textarea'],
        'data_notificacao' => ['label' => 'Data Envio', 'type' => 'date'], // Pode ser automático no Model
        'lida'             => ['label' => 'Lida', 'type' => 'select', 'options' => ['0' => 'Não', '1' => 'Sim']]
    ];
}