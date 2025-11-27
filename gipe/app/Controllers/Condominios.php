<?php namespace App\Controllers;

use App\Models\CondominioModel;
use App\Models\UtilizadorModel;
use CodeIgniter\Database\Exceptions\DatabaseException; // Necessário para apanhar erros de SQL

class Condominios extends BaseModuleController {
    protected $modelName = CondominioModel::class;
    protected $title = 'Condomínios';
    protected $baseRoute = 'condominios';

    // 1. LISTAGEM (Index)
    public function index()
    {
        $model = new CondominioModel();
        $dataList = $model->findAll(); 
        $trashList = $model->onlyDeleted()->findAll(); 

        $data = [
            'title'       => 'Gestão de Condomínios',
            'condominios' => $dataList,
            'trashData'   => $trashList
        ];

        return view('condominios/index', $data);
    }

    // 2. NOVO
    public function new()
    {
        $data = [
            'title'      => 'Novo Condomínio',
            'action'     => 'create',
            'admins'     => $this->getAdmins(),
            'condominio' => [],
            'errors'     => []
        ];
        return view('condominios/form', $data);
    }

    // 3. CRIAR
    public function create()
    {
        $model = new CondominioModel();
        $data = $this->request->getPost();

        if (!$model->save($data)) {
            return view('condominios/form', [
                'title'      => 'Novo Condomínio',
                'action'     => 'create',
                'admins'     => $this->getAdmins(),
                'condominio' => $data,
                'errors'     => $model->errors()
            ]);
        }
        return redirect()->to('/condominios')->with('success', 'Condomínio criado com sucesso!');
    }

    // 4. EDITAR
    public function edit($id = null)
    {
        $model = new CondominioModel();
        $condominio = $model->find($id);
        
        if (!$condominio) {
            return redirect()->to('/condominios')->with('error', 'Condomínio não encontrado.');
        }

        $data = [
            'title'      => 'Editar Condomínio',
            'action'     => 'update/' . $id,
            'admins'     => $this->getAdmins(),
            'condominio' => $condominio,
            'errors'     => []
        ];
        return view('condominios/form', $data);
    }

    // 5. ATUALIZAR
    public function update($id = null)
    {
        $model = new CondominioModel();
        $data = $this->request->getPost();
        $data['id'] = $id;

        if (!$model->save($data)) {
            return view('condominios/form', [
                'title'      => 'Editar Condomínio',
                'action'     => 'update/' . $id,
                'admins'     => $this->getAdmins(),
                'condominio' => $data,
                'errors'     => $model->errors()
            ]);
        }
        return redirect()->to('/condominios')->with('success', 'Condomínio atualizado!');
    }

    // --- GESTÃO DE ESTADO E ARQUIVO (Lógica Específica) ---

    // 6. MOVER PARA ARQUIVO (Soft Delete)
    public function delete($id = null)
    {
        $model = new CondominioModel();
        // O delete simples apenas preenche o 'deleted_at'
        if ($model->delete($id)) {
            return redirect()->to('/condominios')->with('success', 'Condomínio movido para o Arquivo.');
        }
        return redirect()->to('/condominios')->with('error', 'Erro ao arquivar.');
    }

    // 7. RESTAURAR DO ARQUIVO
    public function restore($id = null)
    {
        $model = new CondominioModel();
        // Atualizar 'deleted_at' para NULL restaura o registo
        $model->update($id, ['deleted_at' => null]);
        return redirect()->to('/condominios')->with('success', 'Condomínio restaurado com sucesso!');
    }

    // 8. APAGAR DEFINITIVAMENTE (Purge)
    // ... (restante código do controlador acima) ...

    // 8. APAGAR DEFINITIVAMENTE (Eliminação em Cascata)
    public function purge($id = null)
    {
        $condominioModel = new CondominioModel();
        
        // Se o ID não existir, aborta
        if (!$condominioModel->find($id) && !$condominioModel->onlyDeleted()->find($id)) {
            return redirect()->to('/condominios')->with('error', 'Condomínio não encontrado.');
        }

        // --- INÍCIO DA LIMPEZA PROFUNDA (CASCATA) ---
        // Carregar modelos necessários
        $modelosDependentes = [
            new \App\Models\UnidadeModel(),      // Unidades
            new \App\Models\DespesaModel(),      // Despesas
            new \App\Models\ReceitaModel(),      // Receitas
            new \App\Models\ComunicadoModel(),   // Comunicados
            new \App\Models\OcorrenciaModel(),   // Ocorrências
            new \App\Models\ReuniaoModel(),      // Reuniões
            new \App\Models\ServicoModel(),      // Serviços
            new \App\Models\PagamentoModel(),    // Pagamentos
            new \App\Models\GestorModel(),       // Gestores
            new \App\Models\PrestadorModel(),    // Prestadores
        ];

        // 1. Apagar Dados Associados (Dependentes Diretos)
        foreach ($modelosDependentes as $model) {
            // Verifica se o modelo tem o campo 'id_condominio'
            // Nota: Para Unidades e Obras, a lógica pode ser mais complexa, mas isto cobre 90%
            if ($model->table === 'Unidades' || $model->table === 'Obras') {
                 // Unidades requerem tratamento especial (têm Quartos/Obras associados)
                 // Para simplificar, apagamos direto pelo ID do condomínio se a coluna existir
                 $model->where('id_condominio', $id)->delete(null, true);
            } else {
                 // Padrão: Apagar tudo onde id_condominio = $id
                 // O 'true' ativa o Purge (Hard Delete) ignorando o Soft Delete
                 $model->where('id_condominio', $id)->delete(null, true);
            }
        }

        // Nota: Se quiseres ser perfeccionista, deverias apagar também 'Quartos' que dependem de 'Unidades',
        // mas como já apagámos as Unidades, os Quartos ficam órfãos de pai mas invisíveis no site.
        // --- FIM DA LIMPEZA ---

        // 2. Finalmente, Apagar o Condomínio (O Pai)
        if ($condominioModel->delete($id, true)) {
            return redirect()->to('/condominios')->with('success', 'Condomínio e TODOS os dados associados foram eliminados para sempre.');
        }

        return redirect()->to('/condominios')->with('error', 'Erro ao tentar eliminar o registo principal.');
    }

    // Método Auxiliar
    private function getAdmins() {
        $userModel = new UtilizadorModel();
        return $userModel->where('tipo', 'admin')->findAll();
    }
}