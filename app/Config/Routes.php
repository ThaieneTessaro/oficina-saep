<?php
//Rotas Públicas
// Rotas Login
$routes->get('/', 'LoginController::index');
$routes->get('login', 'LoginController::index');
$routes->post('login/autenticar', 'LoginController::autenticar');
$routes->get('logout', 'LoginController::logout');

//Rotas Protegidas
$routes->group('', ['filter' => 'auth'], function($routes){
    // Rota Inicio
    $routes->get('inicio', 'InicioController::index');

    // Rotas responsavel
    $routes->match(['get', 'post'], 'responsavel',  'ResponsavelController::index');
    $routes->get('responsavel/novo',                'ResponsavelController::novo');
    $routes->post('responsavel/inserir',            'ResponsavelController::inserir');
    $routes->get('responsavel/editar/(:num)',       'ResponsavelController::editar/$1');
    $routes->post('responsavel/atualizar/(:num)',   'ResponsavelController::atualizar/$1');
    $routes->get('responsavel/excluir/(:num)',      'ResponsavelController::excluir/$1');

    // Rotas paciente
    $routes->match(['get', 'post'], 'paciente',  'PacienteController::index');
    $routes->get('paciente/novo',                'PacienteController::novo');
    $routes->post('paciente/inserir',            'PacienteController::inserir');
    $routes->get('paciente/editar/(:num)',       'PacienteController::editar/$1');
    $routes->post('paciente/atualizar/(:num)',   'PacienteController::atualizar/$1');
    $routes->get('paciente/excluir/(:num)',      'PacienteController::excluir/$1');

    // Rotas Agendamento
    $routes->match(['get', 'post'], 'agendamento',     'AgendamentoController::index');
    $routes->get('agendamento/novo',                   'AgendamentoController::novo');
    $routes->post('agendamento/inserir',               'AgendamentoController::inserir');
    $routes->get('agendamento/editar/(:num)',          'AgendamentoController::editar/$1');
    $routes->post('agendamento/atualizar/(:num)',      'AgendamentoController::atualizar/$1');
    $routes->get('agendamento/excluir/(:num)',         'AgendamentoController::excluir/$1');
});