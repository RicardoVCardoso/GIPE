<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\NotificacaoModel; // Importar Modelo

abstract class BaseController extends Controller
{
    protected $request;
    protected $helpers = ['form', 'url']; // Helpers globais

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // Lógica de Notificações Global
        $session = \Config\Services::session();
        $notificacoes = [];
        $totalNotificacoes = 0;

        if ($session->get('isLoggedIn')) {
            $model = new NotificacaoModel();
            // Buscar notificações não lidas do utilizador logado
            $notificacoes = $model->where('id_utilizador', $session->get('id'))
                                  ->where('lida', false) // Assume 0 ou false
                                  ->orderBy('data_notificacao', 'DESC')
                                  ->findAll(5); // Busca as 5 mais recentes
            
            $totalNotificacoes = $model->where('id_utilizador', $session->get('id'))
                                       ->where('lida', false)
                                       ->countAllResults();
        }

        // Partilhar com todas as views
        service('renderer')->setData([
            'notificacoes_topo' => $notificacoes,
            'total_notificacoes' => $totalNotificacoes
        ]);
    }
}