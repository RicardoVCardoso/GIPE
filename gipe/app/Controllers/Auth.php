<?php

namespace App\Controllers;

use App\Models\UtilizadorModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/login');
    }

    public function register()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/register');
    }

    public function attemptRegister()
    {
        $rules = [
            'nome'           => 'required|min_length[3]|max_length[100]',
            'email'          => 'required|min_length[6]|max_length[100]|valid_email|is_unique[Utilizadores.email]',
            'senha'          => 'required|min_length[6]|max_length[255]',
            'confirma_senha' => 'matches[senha]',
            'tipo'           => 'required|in_list[administrador,morador]'
        ];

        if (!$this->validate($rules)) {
            return view('auth/register', [
                'validation' => $this->validator
            ]);
        }

        $model = new UtilizadorModel();

        $data = [
            'nome'     => $this->request->getVar('nome'),
            'email'    => $this->request->getVar('email'),
            'senha'    => $this->request->getVar('senha'), // O Model fará o hash automaticamente
            'tipo'     => $this->request->getVar('tipo'),
        ];

        $model->save($data);

        return redirect()->to('/auth/login')->with('success', 'Registo efetuado com sucesso! Pode entrar.');
    }

    public function attemptLogin()
    {
        $session = session();
        $model = new UtilizadorModel();
        
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('senha');
        
        $user = $model->where('email', $email)->first();
        
        if ($user) {
            // Verifica a hash da senha
            if (password_verify($password, $user['senha'])) {
                $ses_data = [
                    'id'         => $user['id'],
                    'nome'       => $user['nome'],
                    'email'      => $user['email'],
                    'tipo'       => $user['tipo'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/dashboard');
            }
        }
        
        return redirect()->back()->withInput()->with('msg', 'Credenciais inválidas ou conta inexistente.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login');
    }
}