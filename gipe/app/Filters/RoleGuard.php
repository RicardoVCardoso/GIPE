<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // 1. Verificar Login (Redundância de segurança)
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }

        $userRole = session()->get('tipo'); // 'admin', 'gestor', 'morador'
        $allowedRoles = $arguments; // Ex: ['admin', 'gestor'] vindo das rotas

        // 2. Verificar Permissões
        if (empty($allowedRoles)) {
            // Se a rota não definiu quem entra, bloqueia por defeito
            return redirect()->to('/dashboard')->with('error', 'Erro de configuração de segurança.');
        }

        if (!in_array($userRole, $allowedRoles)) {
            return redirect()->to('/dashboard')->with('error', 'Acesso Negado: O seu perfil de ' . ucfirst($userRole) . ' não tem permissão.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nada a fazer
    }
}