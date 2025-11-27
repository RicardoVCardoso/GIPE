<?php namespace App\Controllers;

use App\Models\CondominioModel;
use App\Models\UtilizadorModel;
// Modelos dependentes
use App\Models\UnidadeModel;
use App\Models\DespesaModel;
use App\Models\ReceitaModel;
use App\Models\ComunicadoModel;
use App\Models\OcorrenciaModel;
use App\Models\ReuniaoModel;
use App\Models\ServicoModel;
use App\Models\PagamentoModel;
use App\Models\GestorModel;
use App\Models\PrestadorModel;

class Condominios extends BaseModuleController {
    protected $modelName = CondominioModel::class;
    protected $title = 'Condomínios';
    protected $baseRoute = 'condominios';

    // ... (index, new, create, edit, update iguais aos que já tinhas) ...
    // Vou focar apenas na lógica de ELIMINAÇÃO aqui:

    // 1. MOVER PARA ARQUIVO
    public function delete($id = null)
    {
        $model = new CondominioModel();
        if ($model->delete($id)) {
            return redirect()->to('/condominios')->with('success', 'Condomínio movido para o Arquivo.');
        }
        return redirect()->to('/condominios')->with('error', 'Erro ao arquivar.');
    }

    // 2. ELIMINAR DEFINITIVAMENTE (Purge)
    // app/Controllers/Condominios.php

    public function purge($id = null)
    {
        $model = new CondominioModel();
        
        try {
            // O segundo parâmetro 'true' ativa o Hard Delete.
            // O MySQL vai apagar automaticamente Unidades, Despesas, etc. graças ao CASACADE.
            if ($model->delete($id, true)) {
                return redirect()->to('/condominios')->with('success', 'Condomínio eliminado permanentemente.');
            }
        } catch (\Exception $e) {
            return redirect()->to('/condominios')->with('error', 'Erro ao eliminar.');
        }
        
        return redirect()->to('/condominios')->with('error', 'Erro desconhecido.');
    }

    public function restore($id = null)
    {
        $model = new CondominioModel();
        $model->update($id, ['deleted_at' => null]);
        return redirect()->to('/condominios')->with('success', 'Condomínio restaurado!');
    }
    
    // Método auxiliar para o form
    private function getAdmins() {
        $userModel = new UtilizadorModel();
        return $userModel->where('tipo', 'admin')->findAll();
    }
}