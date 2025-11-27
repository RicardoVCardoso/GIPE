<?php

namespace App\Controllers;

use App\Models\CondominioModel;
use App\Models\UtilizadorModel;
use App\Models\OcorrenciaModel;
use App\Models\UnidadeModel; // Adicionado

class Dashboard extends BaseController
{
    public function index()
    {
        $tipo = session()->get('tipo');
        $idUser = session()->get('id');

        // Carregar Modelos
        $condominioModel = new CondominioModel();
        $ocorrenciaModel = new OcorrenciaModel();
        $userModel = new UtilizadorModel();
        $unidadeModel = new UnidadeModel(); // Instanciar sempre

        // Valores padrão para evitar erros "Undefined variable" na view
        $data = [
            'total_condominios' => 0,
            'total_users' => 0,
            'total_unidades' => 0,
            'ocorrencias_pendentes' => 0,
            'users_pendentes' => 0,
            'tipos_unidades' => []
        ];

        if ($tipo === 'morador') {
            // Dashboard do Morador
            // Para já, vamos passar os totais a 0 ou dados específicos
            // Se tiver uma view específica para morador, redirecionar aqui
            // return view('dashboard/morador', $data);
            
            // Se usar a mesma view index, passamos dados vazios ou limitados
            return view('dashboard/index', $data);
        
        } elseif ($tipo === 'gestor') {
            // Dashboard do Gestor
            $data['total_condominios'] = $condominioModel->countAll(); // Idealmente filtrar por ID gestor
            $data['total_unidades'] = $unidadeModel->countAll(); // Filtrar por condominios do gestor
            $data['ocorrencias_pendentes'] = $ocorrenciaModel->where('status', 'pendente')->countAllResults();
            $data['total_users'] = $userModel->where('tipo', 'morador')->countAllResults(); // Apenas conta moradores
            
            // Dados para o gráfico
            $data['tipos_unidades'] = $unidadeModel->select('tipo, COUNT(*) as total')->groupBy('tipo')->findAll();

            return view('dashboard/index', $data);
        
        } else {
            // Dashboard Admin (Vê tudo)
            $data['total_condominios'] = $condominioModel->countAll();
            $data['total_users'] = $userModel->countAll();
            $data['total_unidades'] = $unidadeModel->countAll(); // <--- A LINHA QUE FALTAVA
            $data['users_pendentes'] = $userModel->where('status', 'pendente')->countAllResults();
            $data['ocorrencias_pendentes'] = $ocorrenciaModel->where('status', 'pendente')->countAllResults();
            
            // Gráfico
            $data['tipos_unidades'] = $unidadeModel->select('tipo, COUNT(*) as total')->groupBy('tipo')->findAll();

            return view('dashboard/index', $data);
        }
    }
}