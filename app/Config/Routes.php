<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// =============================================================
//  FRONT OFFICE — Routes publiques (sans filtre)
// =============================================================

$routes->get('frontoffice/login',  'Frontoffice\AuthController::loginForm');
$routes->post('frontoffice/login', 'Frontoffice\AuthController::loginTraiter');

$routes->get('frontoffice/signup',  'Frontoffice\AuthController::signupForm');
$routes->post('frontoffice/signup', 'Frontoffice\AuthController::signupTraiter1');

$routes->get('frontoffice/signup/sante',  'Frontoffice\AuthController::signupSanteForm');
$routes->post('frontoffice/signup/sante', 'Frontoffice\AuthController::signupTraiter2');

$routes->get('frontoffice/logout', 'Frontoffice\AuthController::logout');

// =============================================================
//  FRONT OFFICE — Routes protégées (filtre 'auth')
//  AuthFilter vérifie session 'connecte' avant chaque requête
// =============================================================

$routes->group('frontoffice', ['filter' => 'auth'], function ($routes) {
    $routes->get('profil',           'Frontoffice\UserController::profile');
    $routes->get('profil/modifier',  'Frontoffice\UserController::editForm');
    $routes->post('profil/modifier', 'Frontoffice\UserController::submitEditForm');

    // Crédits
    $routes->post('credit/demander',   'Frontoffice\CreditController::demanderCredit');
    $routes->get('credit/historique',  'Frontoffice\CreditController::getCreditByUser');

    // Gold
    $routes->get('gold',          'Frontoffice\GoldController::goldInfo');
    $routes->post('gold/acheter', 'Frontoffice\GoldController::buyGold');

    // Programme
    $routes->get('programme',         'Frontoffice\ProgramController::programList');
    $routes->get('programmes/new',    'Frontoffice\ProgramController::createProgram');
    $routes->post('programmes/new',   'Frontoffice\ProgramController::createProgram');
    $routes->get('programmes/user',   'Frontoffice\ProgramController::getProgramByUserId');
    $routes->get('programmes/user/(:num)', 'Frontoffice\ProgramController::getProgramByUserId/$1');
    $routes->get('programmes/(:num)/sports', 'Frontoffice\Program_sportController::getSportsByProgramId/$1');
});

// =============================================================
//  BACK OFFICE — Routes publiques (sans filtre)
// =============================================================

$routes->get('backoffice/login',  'Backoffice\AdminController::loginForm');
$routes->post('backoffice/login', 'Backoffice\AdminController::submitLoginForm');
$routes->get('backoffice/logout', 'Backoffice\AdminController::logout');

// =============================================================
//  BACK OFFICE — Routes protégées (filtre 'admin')
//  AdminFilter vérifie session 'admin.admin_connecte' avant chaque requête
// =============================================================

$routes->group('backoffice', ['filter' => 'admin'], function ($routes) {
    $routes->get('dashboard', 'Backoffice\AdminController::dashboard');

    // Crédits
    $routes->get('credits/pending',          'Backoffice\CreditController::pendingList');
    $routes->post('credits/accepter/(:num)', 'Backoffice\CreditController::accepterCredit/$1');
    $routes->post('credits/refuser/(:num)',  'Backoffice\CreditController::refuserCredit/$1');

    // Régimes & sports
    $routes->get('regimes', 'Frontoffice\RegimeController::regimeList');
    $routes->get('sports',  'Frontoffice\SportController::sportList');
});