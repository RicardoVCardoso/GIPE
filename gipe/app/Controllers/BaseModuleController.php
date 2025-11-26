<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourcePresenter;

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
        $data = [
            'title' => $this->title,
            'route' => $this->baseRoute,
            'columns' => $this->listColumns,
            'data' => $model->findAll()
        ];
        return view('template/list', $data);
    }

    public function new()
    {
        $data = [
            'title' => 'Novo ' . $this->title,
            'route' => $this->baseRoute,
            'fields' => $this->formFields,
            'action' => 'create',
            'item' => []
        ];
        return view('template/form', $data);
    }

    public function create()
    {
        $model = new $this->modelName();
        $data = $this->request->getPost();
        
        // Tratamento especial para passwords
        if(isset($data['senha']) && !empty($data['senha'])) {
            $data['senha'] = password_hash($data['senha'], PASSWORD_DEFAULT);
        }

        if (!$model->save($data)) {
            return redirect()->back()->withInput()->with('error', 'Erro ao guardar. Verifique os dados.');
        }
        return redirect()->to('/' . $this->baseRoute)->with('success', 'Registo criado com sucesso!');
    }

    public function edit($id = null)
    {
        $model = new $this->modelName();
        $item = $model->find($id);
        
        if (!$item) return redirect()->to('/' . $this->baseRoute)->with('error', 'Não encontrado.');

        $data = [
            'title' => 'Editar ' . $this->title,
            'route' => $this->baseRoute,
            'fields' => $this->formFields,
            'action' => 'update/' . $id,
            'item' => $item
        ];
        return view('template/form', $data);
    }

    public function update($id = null)
    {
        $model = new $this->modelName();
        $data = $this->request->getPost();
        $data['id'] = $id;

        // Se a senha vier vazia no update, removemos para não sobrepor com hash vazio
        if(isset($data['senha']) && empty($data['senha'])) {
            unset($data['senha']);
        } elseif (isset($data['senha'])) {
            $data['senha'] = password_hash($data['senha'], PASSWORD_DEFAULT);
        }

        if (!$model->save($data)) {
            return redirect()->back()->withInput()->with('error', 'Erro ao atualizar.');
        }
        return redirect()->to('/' . $this->baseRoute)->with('success', 'Atualizado com sucesso!');
    }

    public function delete($id = null)
    {
        $model = new $this->modelName();
        $model->delete($id);
        return redirect()->to('/' . $this->baseRoute)->with('success', 'Registo apagado.');
    }

    // Métodos obrigatórios do ResourcePresenter
    public function show($id = null) { return $this->index(); }
    public function remove($id = null) { return $this->delete($id); }
}