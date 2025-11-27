<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\Database\Exceptions\DatabaseException;

class BaseModuleController extends ResourcePresenter
{
    protected $modelName;
    protected $title;
    protected $baseRoute;
    protected $listColumns = [];
    protected $formFields = [];
    protected $helpers = ['form', 'url'];

    public function index()
    {
        $model = new $this->modelName();
        
        // 1. LISTA PRINCIPAL (Ativos)
        // O CodeIgniter filtra automaticamente os 'deleted_at' se useSoftDeletes=true no Model
        if (method_exists($model, 'findAllWithRelations')) {
            $dataList = $model->findAllWithRelations();
        } else {
            $dataList = $model->findAll();
        }

        // 2. LISTA DO LIXO (Para o Modal)
        // onlyDeleted() diz ao modelo: "Ignora os ativos, traz-me só os apagados"
        // Temporariamente clonamos o modelo ou limpamos o estado para buscar os apagados
        $modelTrash = new $this->modelName();
        if (method_exists($modelTrash, 'findAllWithRelations')) {
            // Nota: findAllWithRelations tem de suportar onlyDeleted, o que pode ser complexo
            // Simplificação: trazemos findAll normal para o lixo ou usamos onlyDeleted antes
            $trashList = $modelTrash->onlyDeleted()->findAll(); 
        } else {
            $trashList = $modelTrash->onlyDeleted()->findAll();
        }

        $data = [
            'title'     => $this->title,
            'route'     => $this->baseRoute,
            'columns'   => $this->listColumns,
            'data'      => $dataList,
            'trashData' => $trashList // <--- Enviamos o lixo para a view
        ];

        return view('template/list', $data);
    }

    public function new()
    {
        $this->loadSelectOptions();
        $data = ['title' => 'Novo ' . $this->title, 'route' => $this->baseRoute, 'fields' => $this->formFields, 'action' => 'create', 'item' => []];
        return view('template/form', $data);
    }

    public function create()
    {
        $model = new $this->modelName();
        $data = $this->request->getPost();
        if(isset($data['senha']) && !empty($data['senha'])) $data['senha'] = password_hash($data['senha'], PASSWORD_DEFAULT);
        if(!isset($data['status']) && in_array('status', $model->allowedFields)) $data['status'] = 'ativo'; 

        if (!$model->save($data)) {
            $this->loadSelectOptions();
            return view('template/form', ['title' => 'Novo', 'route' => $this->baseRoute, 'fields' => $this->formFields, 'action' => 'create', 'item' => $data, 'errors' => $model->errors()]);
        }
        return redirect()->to('/' . $this->baseRoute)->with('success', 'Criado com sucesso!');
    }

    public function edit($id = null)
    {
        $model = new $this->modelName();
        $item = $model->find($id);
        if (!$item) return redirect()->to('/' . $this->baseRoute)->with('error', 'Não encontrado.');
        $this->loadSelectOptions();
        $data = ['title' => 'Editar', 'route' => $this->baseRoute, 'fields' => $this->formFields, 'action' => 'update/' . $id, 'item' => $item];
        return view('template/form', $data);
    }

    public function update($id = null)
    {
        $model = new $this->modelName();
        $data = $this->request->getPost();
        $data['id'] = $id;
        if(isset($data['senha']) && empty($data['senha'])) unset($data['senha']);
        elseif (isset($data['senha'])) $data['senha'] = password_hash($data['senha'], PASSWORD_DEFAULT);

        if (!$model->save($data)) {
            $this->loadSelectOptions();
            return view('template/form', ['title' => 'Editar', 'route' => $this->baseRoute, 'fields' => $this->formFields, 'action' => 'update/' . $id, 'item' => $data, 'errors' => $model->errors()]);
        }
        return redirect()->to('/' . $this->baseRoute)->with('success', 'Atualizado!');
    }

    public function delete($id = null)
    {
        $model = new $this->modelName();
        try {
            // Soft Delete
            if (!$model->delete($id)) return redirect()->to('/' . $this->baseRoute)->with('error', 'Erro ao arquivar.');
            return redirect()->to('/' . $this->baseRoute)->with('success', 'Registo movido para o Arquivo.');
        } catch (DatabaseException $e) {
            if ($e->getCode() === 1451) return redirect()->to('/' . $this->baseRoute)->with('error', 'Bloqueado: Dados dependentes.');
            return redirect()->to('/' . $this->baseRoute)->with('error', 'Erro SQL.');
        }
    }

    // Rota de RESTAURAR (Vem do Modal)
    public function restore($id = null)
    {
        $model = new $this->modelName();
        // Update 'deleted_at' para NULL restaura o item
        $model->update($id, ['deleted_at' => null]);
        return redirect()->to('/' . $this->baseRoute)->with('success', 'Registo restaurado!');
    }

    // Rota de PURGE (Vem do Modal)
    public function purge($id = null)
    {
        $model = new $this->modelName();
        try {
            if (!$model->delete($id, true)) return redirect()->to('/' . $this->baseRoute)->with('error', 'Erro ao apagar.');
            return redirect()->to('/' . $this->baseRoute)->with('success', 'Apagado permanentemente.');
        } catch (DatabaseException $e) {
            return redirect()->to('/' . $this->baseRoute)->with('error', 'Bloqueado: Dependências SQL.');
        }
    }

    public function status($id = null, $newStatus = null)
    {
        $model = new $this->modelName();
        $model->save(['id' => $id, 'status' => $newStatus]);
        return redirect()->to('/' . $this->baseRoute)->with('success', "Estado alterado.");
    }

    protected function loadSelectOptions()
    {
        foreach ($this->formFields as &$field) {
            if (isset($field['relation'])) {
                $modelClass = 'App\Models\\' . $field['relation']['model'];
                if (class_exists($modelClass)) {
                    $m = new $modelClass();
                    $res = $m->findAll();
                    $options = [];
                    foreach ($res as $row) $options[$row['id']] = $row[$field['relation']['field']] ?? $row['id'];
                    $field['options'] = $options;
                    $field['type'] = 'select';
                }
            }
        }
    }
    public function show($id = null) { return $this->index(); }
    public function remove($id = null) { return $this->delete($id); }
}