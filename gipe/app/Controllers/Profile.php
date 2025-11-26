<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UtilizadorModel;

class Profile extends BaseController
{
    public function index()
    {
        $model = new UtilizadorModel();
        // Busca o utilizador logado
        $user = $model->find(session()->get('id'));

        return view('profile/show', ['user' => $user]);
    }

    public function update()
    {
        $model = new UtilizadorModel();
        $id = session()->get('id');
        
        // Regras de validação
        $rules = [
            'nome' => 'required|min_length[3]',
            'email' => "required|valid_email|is_unique[Utilizadores.email,id,{$id}]",
        ];

        // Se o utilizador preencheu a senha, validar
        $senha = $this->request->getPost('senha');
        if (!empty($senha)) {
            $rules['senha'] = 'min_length[6]';
            $rules['confirm_senha'] = 'matches[senha]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Erro na validação. Verifique os dados.');
        }

        $data = [
            'id' => $id,
            'nome' => $this->request->getPost('nome'),
            'email' => $this->request->getPost('email'),
        ];

        if (!empty($senha)) {
            $data['senha'] = password_hash($senha, PASSWORD_DEFAULT);
        }

        $model->save($data);

        // Atualizar sessão com novos dados
        session()->set(['nome' => $data['nome'], 'email' => $data['email']]);

        return redirect()->to('/profile')->with('success', 'Perfil atualizado com sucesso!');
    }
}