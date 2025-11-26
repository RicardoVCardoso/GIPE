<?php namespace App\Controllers;
use App\Models\FeedbackModel;

class Feedback extends BaseModuleController {
    protected $modelName = FeedbackModel::class;
    protected $title = 'Feedback dos Utilizadores';
    protected $baseRoute = 'feedback';
    
    protected $listColumns = [
        'comentario' => 'Comentário', 
        'data_feedback' => 'Data'
    ];
    
    protected $formFields = [
        'id_utilizador' => ['label' => 'ID Utilizador', 'type' => 'number'],
        'comentario'    => ['label' => 'Comentário', 'type' => 'textarea'],
        'data_feedback' => ['label' => 'Data', 'type' => 'date']
    ];
}