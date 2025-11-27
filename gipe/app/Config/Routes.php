<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// --- PÚBLICO (Acesso livre) ---
$routes->get('/', 'Auth::login');
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/attemptLogin', 'Auth::attemptLogin');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/attemptRegister', 'Auth::attemptRegister');
$routes->get('auth/logout', 'Auth::logout');

// --- PROTEGIDO (Requer Login) ---
$routes->group('', ['filter' => 'authGuard'], function($routes) {
    
    // Rotas Comuns a todos os utilizadores logados
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('profile', 'Profile::index');
    $routes->post('profile/update', 'Profile::update');

    // 1. MÓDULO EXCLUSIVO DE ADMINISTRAÇÃO (UTILIZADORES)
    // Apenas o perfil 'admin' consegue entrar aqui.
    $routes->group('', ['filter' => 'roleGuard:admin'], function($routes) {
        $routes->presenter('utilizadores');
        
        // Rotas extra de gestão para utilizadores (Arquivo e Status)
        $routes->get('utilizadores/delete/(:num)', 'Utilizadores::delete/$1');
        $routes->get('utilizadores/purge/(:num)', 'Utilizadores::purge/$1');
        $routes->get('utilizadores/status/(:num)/(:segment)', 'Utilizadores::status/$1/$2');
        $routes->get('utilizadores/trash', 'Utilizadores::trash');
        $routes->get('utilizadores/restore/(:num)', 'Utilizadores::restore/$1');
    });

    // 2. LISTA DE MÓDULOS GERAIS (Admin e Gestor)
    // 'utilizadores' foi removido desta lista para não dar conflito com a regra acima
    $modules = [
        'condominios', 'unidades', 'quartos', 'despesas', 
        'receitas', 'reservas', 'comunicados', 'ocorrencias', 'prestadores', 
        'pagamentos', 'notificacoes', 'reunioes', 'anexos', 'feedback', 
        'gestores', 'servicos', 'avaliacoes', 'obras', 'historico_pagamentos'
    ];

    foreach($modules as $module) {
        // 1. Rotas Padrão (index, show, new, create, edit, update)
        $routes->presenter($module);
        
        // Converter nome da rota para Controller (ex: historico_pagamentos -> HistoricoPagamentos)
        $controller = str_replace(' ', '', ucwords(str_replace('_', ' ', $module)));
        
        // 2. Rotas de Gestão de Estado (Apenas Admin e Gestor)
        // Moradores podem ver (index) e criar (new), mas não podem apagar nem gerir lixo
        $routes->group('', ['filter' => 'roleGuard:admin,gestor'], function($routes) use ($module, $controller) {
            $routes->get($module.'/delete/(:num)', $controller.'::delete/$1'); // Mover para lixo (Soft Delete)
            $routes->get($module.'/purge/(:num)', $controller.'::purge/$1');   // Apagar para sempre (Hard Delete)
            $routes->get($module.'/status/(:num)/(:segment)', $controller.'::status/$1/$2'); // Mudar status (ex: Pendente -> Pago)
            
            // --- ROTAS DE ARQUIVO (TRASH) ---
            $routes->get($module.'/trash', $controller.'::trash');             // Ver Lixo
            $routes->get($module.'/restore/(:num)', $controller.'::restore/$1'); // Restaurar do Lixo
        });
    }
});