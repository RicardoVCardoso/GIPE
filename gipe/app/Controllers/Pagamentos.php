<?php namespace App\Controllers; 

use App\Models\PagamentoModel;
use App\Models\HistoricoPagamentoModel; // Assumindo que existe este modelo

class Pagamentos extends BaseModuleController {
    protected $modelName = PagamentoModel::class; 
    protected $title = 'Pagamentos'; 
    protected $baseRoute = 'pagamentos';
    
    protected $listColumns = [
        'valor' => 'Valor (€)', 
        'data_pagamento' => 'Data', 
        'descricao' => 'Ref.',
        'status' => 'Estado'
    ];

    protected $formFields = [
        'id_condominio' => ['label'=>'Condomínio', 'relation'=>['model'=>'CondominioModel', 'field'=>'nome']],
        'id_utilizador' => ['label'=>'Pagador', 'relation'=>['model'=>'UtilizadorModel', 'field'=>'nome']],
        'valor' => ['label'=>'Valor (€)', 'type'=>'number', 'step'=>'0.01'],
        'data_pagamento' => ['label'=>'Data', 'type'=>'date'],
        'descricao' => ['label'=>'Notas', 'type'=>'text'],
        'status' => ['label'=>'Estado', 'type'=>'select', 'options'=>['pendente'=>'Pendente', 'pago'=>'Pago']]
    ];

    // 1. ARQUIVAR (Soft Delete)
    public function delete($id = null)
    {
        $model = new PagamentoModel();
        if ($model->delete($id)) {
            return redirect()->to('/pagamentos')->with('success', 'Pagamento arquivado.');
        }
        return redirect()->to('/pagamentos')->with('error', 'Erro ao arquivar.');
    }

    // 2. ELIMINAR DEFINITIVAMENTE (Purge)
    // app/Controllers/Condominios.php

    public function purge($id = null)
    {
        $model = new PagamentoModel();
        
        try {
            // O segundo parâmetro 'true' ativa o Hard Delete.
            // O MySQL vai apagar automaticamente Unidades, Despesas, etc. graças ao CASACADE.
            if ($model->delete($id, true)) {
                return redirect()->to('/pagamentos')->with('success', 'Pagamento eliminado permanentemente.');
            }
        } catch (\Exception $e) {
            return redirect()->to('/pagamentos')->with('error', 'Erro ao eliminar.');
        }
        
        return redirect()->to('/pagamentos')->with('error', 'Erro desconhecido.');
    }

    // 3. RESTAURAR
    public function restore($id = null)
    {
        $model = new PagamentoModel();
        $model->update($id, ['deleted_at' => null]);
        return redirect()->to('/pagamentos')->with('success', 'Pagamento restaurado.');
    }
}