<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ============================================================================
// ROTAS PÚBLICAS (Login/Registo)
// ============================================================================
$routes->get('/', 'Auth::login');
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/attemptLogin', 'Auth::attemptLogin');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/attemptRegister', 'Auth::attemptRegister');
$routes->get('auth/logout', 'Auth::logout');

// ============================================================================
// ROTAS PROTEGIDAS (Requer Login)
// ============================================================================
$routes->group('', ['filter' => 'authGuard'], function($routes) {
    
    // --- Dashboard ---
    $routes->get('dashboard', 'Dashboard::index');

    // --- GESTÃO PRINCIPAL ---
    
    // 1. Condominios (Rota manual ou presenter - vamos uniformizar para presenter)
    // Se já tiver métodos manuais no controller Condominios, mantenha as rotas manuais. 
    // Se mudou para BaseModuleController, use presenter:
    // $routes->presenter('condominios'); 
    // Mantendo o manual como estava no exemplo anterior para não quebrar seu código antigo:
    $routes->get('condominios', 'Condominios::index');
    $routes->get('condominios/create', 'Condominios::create');
    $routes->post('condominios/store', 'Condominios::store');

    // 2. Unidades
    $routes->get('unidades', 'Unidades::index');
    $routes->get('unidades/create', 'Unidades::create');
    $routes->post('unidades/store', 'Unidades::store');

    // 3. Utilizadores (CORREÇÃO AQUI)
    // Antes estava: $routes->get('utilizadores', 'Auth::index'); -> ERRO 404
    // Mudamos para presenter para ter CRUD completo (Listar, Criar, Editar, Apagar)
    $routes->presenter('utilizadores'); 

    // --- MÓDULOS GERAIS (Usando o BaseModuleController) ---
    
    $routes->presenter('quartos');
    $routes->presenter('despesas');
    $routes->presenter('receitas');
    $routes->presenter('reservas');
    $routes->presenter('comunicados');
    $routes->presenter('ocorrencias');
    $routes->presenter('prestadores');
    $routes->presenter('pagamentos');
    $routes->presenter('notificacoes');
    $routes->presenter('reunioes');
    $routes->presenter('anexos');
    $routes->presenter('feedback');
    $routes->presenter('gestores');
    $routes->presenter('servicos');
    $routes->presenter('avaliacoes');
    $routes->presenter('obras');

    // Histórico (Apenas leitura)
    $routes->get('historico_pagamentos', 'HistoricoPagamentos::index');
});