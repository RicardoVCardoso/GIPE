<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Rotas Públicas
$routes->get('/', 'Auth::login');
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/attemptLogin', 'Auth::attemptLogin');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/attemptRegister', 'Auth::attemptRegister');
$routes->get('auth/logout', 'Auth::logout');

// Rotas Protegidas
$routes->group('', ['filter' => 'authGuard'], function($routes) {
    
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('profile', 'Profile::index');
    $routes->post('profile/update', 'Profile::update');

    $modules = [
        'condominios', 'unidades', 'utilizadores', 'quartos', 'despesas', 
        'receitas', 'reservas', 'comunicados', 'ocorrencias', 'prestadores', 
        'pagamentos', 'notificacoes', 'reunioes', 'anexos', 'feedback', 
        'gestores', 'servicos', 'avaliacoes', 'obras', 'historico_pagamentos'
    ];

    foreach($modules as $module) {
        $routes->presenter($module);
        
        $controllerName = str_replace(' ', '', ucwords(str_replace('_', ' ', $module)));
        
        // Rota para Desativar (Soft Delete)
        $routes->get($module . '/delete/(:num)', $controllerName . '::delete/$1');
        
        // Rota para Apagar Permanentemente (Hard Delete) - NOVO
        $routes->get($module . '/purge/(:num)', $controllerName . '::purge/$1');
    }
});