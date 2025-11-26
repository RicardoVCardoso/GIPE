<?php

namespace App\Controllers;

use App\Models\CondominioModel;
use App\Models\UtilizadorModel;
use App\Models\OcorrenciaModel;

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

        $data = [];

        if ($tipo === 'morador') {
            // Dashboard do Morador (Limitado)
            $data['minhas_ocorrencias'] = $ocorrenciaModel->where('status', 'pendente')->countAllResults(); // Idealmente filtraria por ID usuario, mas o modelo atual Ocorrencia só tem id_unidade. 
            // Assumindo lógica futura.
            return view('dashboard/morador', $data);
        
        } elseif ($tipo === 'gestor') {
            // Dashboard do Gestor
            $data['total_condominios'] = $condominioModel->countAll(); // Idealmente filtraria pelos dele
            $data['ocorrencias_pendentes'] = $ocorrenciaModel->where('status', 'pendente')->countAllResults();
            return view('dashboard/index', $data); // Usa a view completa que já tínhamos
        
        } else {
            // Dashboard Admin (Vê tudo + Utilizadores Pendentes)
            $data['total_condominios'] = $condominioModel->countAll();
            $data['total_users'] = $userModel->countAll();
            $data['users_pendentes'] = $userModel->where('status', 'pendente')->countAllResults();
            $data['ocorrencias_pendentes'] = $ocorrenciaModel->where('status', 'pendente')->countAllResults();
            
            // Gráfico
            $unidadeModel = new \App\Models\UnidadeModel();
            $data['tipos_unidades'] = $unidadeModel->select('tipo, COUNT(*) as total')->groupBy('tipo')->findAll();

            return view('dashboard/index', $data);
        }
    }
}