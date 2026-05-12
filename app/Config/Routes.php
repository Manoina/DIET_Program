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

    // Suggestions de programme
    $routes->get('suggestions/regimes', 'Frontoffice\Suggested_ProgramController::getAllRegimeBy_varPoids_jour');
    $routes->post('suggestions/regimes', 'Frontoffice\Suggested_ProgramController::getAllRegimeBy_varPoids_jour');
    $routes->get('suggestions/sports', 'Frontoffice\Suggested_ProgramController::getAllSportBy_varPoids_jour');
    $routes->post('suggestions/sports', 'Frontoffice\Suggested_ProgramController::getAllSportBy_varPoids_jour');
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
    // Régimes
    $routes->get('regimes', 'RegimeController::list');
    $routes->get('regimes/new', 'RegimeController::newForm');
    $routes->post('regimes/new', 'RegimeController::submitNewForm');
    $routes->get('regimes/(:num)/edit', 'RegimeController::editForm/$1');
    $routes->post('regimes/(:num)/edit', 'RegimeController::submitEditForm/$1');
    $routes->post('regimes/(:num)/delete', 'RegimeController::delete/$1');

    //  Sports
    $routes->get('sports', 'SportController::list');
    $routes->get('sports/new', 'SportController::newForm');
    $routes->post('sports/new', 'SportController::submitNewForm');
    $routes->get('sports/(:num)/edit', 'SportController::editForm/$1');
    $routes->post('sports/(:num)/edit', 'SportController::submitEditForm/$1');
    $routes->post('sports/(:num)/delete', 'SportController::delete/$1');

    // Crédits
    $routes->get('credits', 'CreditController::list');
    $routes->get('credits/new', 'CreditController::newForm');
    $routes->post('credits/new', 'CreditController::submitNewForm');
    $routes->get('credits/(:num)/edit', 'CreditController::editForm/$1');
    $routes->post('credits/(:num)/edit', 'CreditController::submitEditForm/$1');
    $routes->post('credits/(:num)/delete', 'CreditController::delete/$1');

    // Settings
    $routes->get('settings', 'Backoffice\SettingsController::editForm');
    $routes->post('settings/edit', 'Backoffice\SettingsController::submitEditForm');
});
