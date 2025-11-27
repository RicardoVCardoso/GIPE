<?php namespace App\Controllers; 
use App\Models\ReservaModel;

class Reservas extends BaseModuleController {
    protected $modelName = ReservaModel::class;
    protected $title = 'Reservas de Espaços';
    protected $baseRoute = 'reservas';
    
    protected $listColumns = ['descricao'=>'Espaço', 'data_reserva'=>'Data', 'horario_inicio'=>'Início'];
    
    protected $formFields = [
        'id_condominio' => ['label'=>'Condomínio', 'relation'=>['model'=>'CondominioModel', 'field'=>'nome']],
        'id_unidade' => ['label'=>'Unidade', 'relation'=>['model'=>'UnidadeModel', 'field'=>'numero']],
        'descricao' => ['label'=>'Espaço (Ex: Salão de Festas)', 'type'=>'text'],
        'data_reserva' => ['label'=>'Data Pretendida', 'type'=>'date'],
        'horario_inicio' => ['label'=>'Hora Início', 'type'=>'time'],
        'horario_fim' => ['label'=>'Hora Fim', 'type'=>'time'],
    ];
}