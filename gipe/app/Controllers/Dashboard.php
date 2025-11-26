<?php

namespace App\Controllers;

use App\Models\CondominioModel;
use App\Models\UtilizadorModel;
use App\Models\UnidadeModel;
use App\Models\OcorrenciaModel;

class Dashboard extends BaseController
{
    public function index()
    {
        // Carregar Modelos
        $condominioModel = new CondominioModel();
        $userModel = new UtilizadorModel();
        $unidadeModel = new UnidadeModel();
        $ocorrenciaModel = new OcorrenciaModel();

        // Dados Estatísticos Reais
        $data = [
            'total_condominios' => $condominioModel->countAll(),
            'total_users'       => $userModel->countAll(),
            'total_unidades'    => $unidadeModel->countAll(),
            'ocorrencias_pendentes' => $ocorrenciaModel->where('status', 'pendente')->countAllResults(),
            
            // Dados para o Gráfico (Ex: Unidades por Tipo)
            'tipos_unidades' => $unidadeModel->select('tipo, COUNT(*) as total')
                                             ->groupBy('tipo')
                                             ->findAll()
        ];

        return view('dashboard/index', $data);
    }
}