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
        
        // Usa findAll normal (pode melhorar com joins nos modelos específicos se quiser)
        $data = [
            'title'   => $this->title,
            'route'   => $this->baseRoute,
            'columns' => $this->listColumns,
            'data'    => $model->findAll()
        ];

        return view('template/list', $data);
    }

    public function new()
    {
        $this->loadSelectOptions();
        $data = [
            'title'  => 'Novo ' . $this->title,
            'route'  => $this->baseRoute,
            'fields' => $this->formFields,
            'action' => 'create',
            'item'   => []
        ];
        return view('template/form', $data);
    }

    public function create()
    {
        $model = new $this->modelName();
        $data = $this->request->getPost();
        
        // Hash de senha automático
        if(isset($data['senha']) && !empty($data['senha'])) {
            $data['senha'] = password_hash($data['senha'], PASSWORD_DEFAULT);
        }

        if (!$model->save($data)) {
            $this->loadSelectOptions();
            return view('template/form', [
                'title'  => 'Novo ' . $this->title,
                'route'  => $this->baseRoute,
                'fields' => $this->formFields,
                'action' => 'create',
                'item'   => $data,
                'errors' => $model->errors()
            ]);
        }
        return redirect()->to('/' . $this->baseRoute)->with('success', 'Registo criado com sucesso!');
    }

    public function edit($id = null)
    {
        $model = new $this->modelName();
        $item = $model->find($id);
        
        if (!$item) return redirect()->to('/' . $this->baseRoute)->with('error', 'Registo não encontrado.');

        $this->loadSelectOptions();
        $data = [
            'title'  => 'Editar ' . $this->title,
            'route'  => $this->baseRoute,
            'fields' => $this->formFields,
            'action' => 'update/' . $id,
            'item'   => $item
        ];
        return view('template/form', $data);
    }

    public function update($id = null)
    {
        $model = new $this->modelName();
        $data = $this->request->getPost();
        $data['id'] = $id;

        if(isset($data['senha']) && empty($data['senha'])) {
            unset($data['senha']);
        } elseif (isset($data['senha'])) {
            $data['senha'] = password_hash($data['senha'], PASSWORD_DEFAULT);
        }

        if (!$model->save($data)) {
            $this->loadSelectOptions();
            return view('template/form', [
                'title'  => 'Editar ' . $this->title,
                'route'  => $this->baseRoute,
                'fields' => $this->formFields,
                'action' => 'update/' . $id,
                'item'   => $data,
                'errors' => $model->errors()
            ]);
        }
        return redirect()->to('/' . $this->baseRoute)->with('success', 'Atualizado com sucesso!');
    }

    // --- CORREÇÃO PRINCIPAL AQUI ---
public function delete($id = null)
    {
        $model = new $this->modelName();
        
        try {
            // Tenta apagar o registo
            if (!$model->delete($id)) {
                return redirect()->to('/' . $this->baseRoute)->with('error', 'Não foi possível apagar o registo. Tente novamente.');
            }
            
            // Sucesso!
            return redirect()->to('/' . $this->baseRoute)->with('success', 'Registo eliminado com sucesso.');
            
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            // Captura erro 1451 do MySQL (Chave Estrangeira)
            // Isto acontece se tentar apagar um Condomínio que ainda tem Unidades, Gestores, ou Despesas.
            if ($e->getCode() === 1451) {
                return redirect()->to('/' . $this->baseRoute)->with('error', 'Operação Bloqueada: Este registo está a ser usado noutras partes do sistema (ex: tem Unidades, Despesas ou Gestores associados). Apague esses dados primeiro.');
            }
            
            // Outro erro qualquer de base de dados
            return redirect()->to('/' . $this->baseRoute)->with('error', 'Erro de base de dados ao tentar eliminar.');
        } catch (\Exception $e) {
            // Erro genérico
            return redirect()->to('/' . $this->baseRoute)->with('error', 'Erro inesperado: ' . $e->getMessage());
        }
    }
    protected function loadSelectOptions()
    {
        foreach ($this->formFields as $key => &$field) {
            if (isset($field['relation'])) {
                $modelClass = 'App\Models\\' . $field['relation']['model'];
                if (class_exists($modelClass)) {
                    $relatedModel = new $modelClass();
                    $results = $relatedModel->findAll();
                    $options = [];
                    foreach ($results as $row) {
                        $options[$row['id']] = $row[$field['relation']['field']];
                    }
                    $field['options'] = $options;
                    $field['type'] = 'select';
                }
            }
        }
    }

    // Stub methods for ResourcePresenter compliance
    public function show($id = null) { return $this->index(); }
    public function remove($id = null) { return $this->delete($id); }
    // ... (outros métodos acima)

    /**
     * Eliminação Permanente (Hard Delete)
     */
    public function purge($id = null)
    {
        $model = new $this->modelName();
        
        try {
            // O segundo parâmetro 'true' força a eliminação permanente
            // mesmo que useSoftDeletes esteja ligado.
            if (!$model->delete($id, true)) {
                return redirect()->to('/' . $this->baseRoute)->with('error', 'Não foi possível apagar o registo.');
            }
            return redirect()->to('/' . $this->baseRoute)->with('success', 'Registo apagado permanentemente da base de dados.');
            
        } catch (\Exception $e) {
            // Tratamento de erros de chave estrangeira
            if ($e->getCode() === 1451) {
                return redirect()->to('/' . $this->baseRoute)->with('error', 'Bloqueado: Existem dados associados a este registo. Apague os dependentes primeiro.');
            }
            return redirect()->to('/' . $this->baseRoute)->with('error', 'Erro: ' . $e->getMessage());
        }
    }
}