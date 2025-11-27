<?php namespace App\Controllers;

use App\Models\UtilizadorModel;
use App\Models\CondominioModel;
// Importar todos os modelos necessários para a limpeza profunda
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

class Utilizadores extends BaseModuleController {
    protected $modelName = UtilizadorModel::class;
    protected $title = 'Gestão de Utilizadores';
    protected $baseRoute = 'utilizadores';
    
    protected $listColumns = ['nome'=>'Nome', 'email'=>'Email', 'tipo'=>'Função', 'status'=>'Estado'];
    
    protected $formFields = [
        'nome'  => ['label'=>'Nome Completo', 'type'=>'text'],
        'email' => ['label'=>'Email', 'type'=>'email'],
        'senha' => ['label'=>'Senha (Nova)', 'type'=>'password'],
        'tipo'  => ['label'=>'Tipo de Conta', 'type'=>'select', 'options'=>['morador'=>'Morador', 'gestor'=>'Gestor', 'admin'=>'Admin']],
        'status'=> ['label'=>'Estado da Conta', 'type'=>'select', 'options'=>['pendente'=>'Pendente', 'ativo'=>'Ativo', 'bloqueado'=>'Bloqueado']]
    ];

    // --- MÉTODOS DE ELIMINAÇÃO (Lógica Específica) ---

    // 1. ARQUIVAR (Soft Delete)
    public function delete($id = null)
    {
        $model = new UtilizadorModel();
        // Arquivar utilizador
        if ($model->delete($id)) {
            // Arquivar também os condomínios que ele gere (Soft Delete)
            $condominioModel = new CondominioModel();
            $condominios = $condominioModel->where('administrador_id', $id)->findAll();
            foreach ($condominios as $cond) {
                $condominioModel->delete($cond['id']);
            }
            return redirect()->to('/utilizadores')->with('success', 'Utilizador e condomínios associados arquivados.');
        }
        return redirect()->to('/utilizadores')->with('error', 'Erro ao arquivar.');
    }

    // 2. ELIMINAR DEFINITIVAMENTE (Purge - Cascata Total)
    // app/Controllers/Condominios.php

    public function purge($id = null)
    {
        $model = new UtilizadorModel();
        
        try {
            // O segundo parâmetro 'true' ativa o Hard Delete.
            // O MySQL vai apagar automaticamente Unidades, Despesas, etc. graças ao CASACADE.
            if ($model->delete($id, true)) {
                return redirect()->to('/utilizadores')->with('success', 'Utilizador eliminado permanentemente.');
            }
        } catch (\Exception $e) {
            return redirect()->to('/utilizadores')->with('error', 'Erro ao eliminar.');
        }
        
        return redirect()->to('/utilizadores')->with('error', 'Erro desconhecido.');
    }
    // Função Auxiliar para limpar dependências (Reutilizável)
    private function limparDadosDoCondominio($condominioId) {
        $dependentes = [
            new UnidadeModel(), new DespesaModel(), new ReceitaModel(),
            new ComunicadoModel(), new OcorrenciaModel(), new ReuniaoModel(),
            new ServicoModel(), new PagamentoModel(), new GestorModel(),
            new PrestadorModel()
        ];

        foreach ($dependentes as $model) {
            // Hard delete em tudo o que pertença a este condomínio
            $model->where('id_condominio', $condominioId)->delete(null, true);
        }
    }
    
    // Métodos restore, status, etc herdados ou implementados conforme necessário...
    public function restore($id = null) {
        $model = new UtilizadorModel();
        $model->update($id, ['deleted_at' => null]);
        return redirect()->to('/utilizadores')->with('success', 'Utilizador restaurado.');
    }
}