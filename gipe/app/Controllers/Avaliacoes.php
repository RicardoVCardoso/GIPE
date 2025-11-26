<?php namespace App\Controllers;
use App\Models\AvaliacaoModel;

class Avaliacoes extends BaseModuleController {
    protected $modelName = AvaliacaoModel::class;
    protected $title = 'Avaliações de Serviços';
    protected $baseRoute = 'avaliacoes';
    
    protected $listColumns = [
        'nota' => 'Nota (1-5)', 
        'comentario' => 'Opinião', 
        'data_avaliacao' => 'Data'
    ];
    
    protected $formFields = [
        'id_utilizador' => ['label' => 'ID Utilizador', 'type' => 'number'],
        'id_servico'    => ['label' => 'ID Serviço', 'type' => 'number'],
        'nota'          => ['label' => 'Nota', 'type' => 'select', 'options' => ['1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5']],
        'comentario'    => ['label' => 'Comentário', 'type' => 'textarea'],
        'data_avaliacao'=> ['label' => 'Data', 'type' => 'date']
    ];
}