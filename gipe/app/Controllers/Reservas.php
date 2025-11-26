<?php namespace App\Controllers;
use App\Models\ReservaModel;

class Reservas extends BaseModuleController {
    protected $modelName = ReservaModel::class;
    protected $title = 'Reservas de Espaços';
    protected $baseRoute = 'reservas';
    protected $listColumns = ['data_reserva' => 'Data', 'horario_inicio' => 'Início', 'descricao' => 'Evento'];
    protected $formFields = [
        'id_condominio' => ['label' => 'ID Condomínio', 'type' => 'number'],
        'id_unidade' => ['label' => 'ID Unidade', 'type' => 'number'],
        'data_reserva' => ['label' => 'Data', 'type' => 'date'],
        'horario_inicio' => ['label' => 'Hora Início', 'type' => 'time'],
        'horario_fim' => ['label' => 'Hora Fim', 'type' => 'time'],
        'descricao' => ['label' => 'Descrição', 'type' => 'text']
    ];
}