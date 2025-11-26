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

    public function attemptLogin()
    {
        $session = session();
        $model = new UtilizadorModel();
        
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('senha');
        
        $user = $model->where('email', $email)->first();
        
        if ($user) {
            // 1. Verificar Senha
            if (password_verify($password, $user['senha'])) {
                
                // 2. Verificar se está Aprovado
                if ($user['status'] === 'pendente') {
                    return redirect()->back()->withInput()->with('error', 'A sua conta ainda está a aguardar aprovação do Administrador.');
                }
                
                if ($user['status'] === 'bloqueado') {
                    return redirect()->back()->withInput()->with('error', 'A sua conta foi bloqueada.');
                }

                // Login Sucesso
                $ses_data = [
                    'id'         => $user['id'],
                    'nome'       => $user['nome'],
                    'email'      => $user['email'],
                    'tipo'       => $user['tipo'], // admin, gestor, morador
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/dashboard');
            }
        }
        
        return redirect()->back()->withInput()->with('error', 'Email ou senha incorretos.');
    }

    public function attemptRegister()
    {
        $model = new UtilizadorModel();

        // Regras de validação
        $rules = [
            'nome' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[Utilizadores.email]',
            'senha' => 'required|min_length[6]',
            'confirma_senha' => 'matches[senha]',
            'tipo' => 'required|in_list[gestor,morador]' // PROIBIDO REGISTAR COMO ADMIN AQUI
        ];

        if (!$this->validate($rules)) {
            return view('auth/register', ['validation' => $this->validator]);
        }

        $data = [
            'nome'     => $this->request->getVar('nome'),
            'email'    => $this->request->getVar('email'),
            'senha'    => $this->request->getVar('senha'),
            'tipo'     => $this->request->getVar('tipo'),
            'status'   => 'pendente' // <--- IMPORTANTE: Entra sempre como pendente
        ];

        $model->save($data);

        return redirect()->to('/auth/login')->with('success', 'Registo efetuado! A sua conta aguarda aprovação do Administrador.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login');
    }
    
    // Método auxiliar para listar utilizadores (usado pelo admin)
    public function index() {
        // (Este método será substituído pelo controlador Utilizadores.php se usar o presenter, 
        // mas mantemos aqui para compatibilidade com rotas antigas se existirem)
    }
}