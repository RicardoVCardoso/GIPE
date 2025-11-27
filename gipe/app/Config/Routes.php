<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// --- PÚBLICO ---
$routes->get('/', 'Auth::login');
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/attemptLogin', 'Auth::attemptLogin');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/attemptRegister', 'Auth::attemptRegister');
$routes->get('auth/logout', 'Auth::logout');

// --- PROTEGIDO ---
$routes->group('', ['filter' => 'authGuard'], function($routes) {
    
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('profile', 'Profile::index');
    $routes->post('profile/update', 'Profile::update');

    // LISTA DE MÓDULOS
    $modules = [
        'condominios', 'unidades', 'utilizadores', 'quartos', 'despesas', 
        'receitas', 'reservas', 'comunicados', 'ocorrencias', 'prestadores', 
        'pagamentos', 'notificacoes', 'reunioes', 'anexos', 'feedback', 
        'gestores', 'servicos', 'avaliacoes', 'obras', 'historico_pagamentos'
    ];

    foreach($modules as $module) {
        // 1. Rotas Padrão
        $routes->presenter($module);
        
        $controller = str_replace(' ', '', ucwords(str_replace('_', ' ', $module)));
        
        // 2. Rotas de Gestão de Estado (Admin/Gestor)
        // Nota: Adicionámos 'trash' e 'restore'
        $routes->group('', ['filter' => 'roleGuard:admin,gestor'], function($routes) use ($module, $controller) {
            $routes->get($module.'/delete/(:num)', $controller.'::delete/$1'); // Mover para lixo
            $routes->get($module.'/purge/(:num)', $controller.'::purge/$1');   // Apagar para sempre
            $routes->get($module.'/status/(:num)/(:segment)', $controller.'::status/$1/$2'); // Mudar status
            
            // --- NOVAS ROTAS DE ARQUIVO ---
            $routes->get($module.'/trash', $controller.'::trash');             // Ver Lixo
            $routes->get($module.'/restore/(:num)', $controller.'::restore/$1'); // Restaurar
        });
    }
});