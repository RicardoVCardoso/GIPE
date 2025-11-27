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
    public function purge($id = null)
    {
        $model = new CondominioModel();
        
        try {
            // O segundo parâmetro 'true' força a eliminação real da base de dados
            if ($model->delete($id, true)) {
                return redirect()->to('/condominios')->with('success', 'Condomínio eliminado permanentemente.');
            }
            return redirect()->to('/condominios')->with('error', 'Não foi possível eliminar o registo.');
            
        } catch (DatabaseException $e) {
            // Captura erro de integridade referencial (ex: Condomínio tem Unidades associadas)
            // Código 1451 é comum em MySQL para Foreign Key Constraint
            return redirect()->to('/condominios')->with('error', 'ATENÇÃO: Não é possível apagar este condomínio porque existem Unidades, Despesas ou outros registos associados a ele. Apague esses registos primeiro.');
        }
    }

    // Método Auxiliar
    private function getAdmins() {
        $userModel = new UtilizadorModel();
        return $userModel->where('tipo', 'admin')->findAll();
    }
}