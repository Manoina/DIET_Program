<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// =============================================================
//  FRONT OFFICE — Authentification
// =============================================================

// Login
$routes->get('frontoffice/login',  'Frontoffice\AuthController::loginForm');
$routes->post('frontoffice/login', 'Frontoffice\AuthController::loginTraiter');

// Signup étape 1 — infos personnelles
$routes->get('frontoffice/signup',  'Frontoffice\AuthController::signupForm');
$routes->post('frontoffice/signup', 'Frontoffice\AuthController::signupTraiter');

// Signup étape 2 — infos santé
$routes->get('frontoffice/signup/sante',  'Frontoffice\AuthController::signupSanteForm');
$routes->post('frontoffice/signup/sante', 'Frontoffice\AuthController::signupSanteTraiter');

// Logout
$routes->get('frontoffice/logout', 'Frontoffice\AuthController::logout');

// =============================================================
//  FRONT OFFICE — Profil utilisateur
// =============================================================
$routes->get('frontoffice/profil',           'Frontoffice\UserController::profile');
$routes->get('frontoffice/profil/modifier',  'Frontoffice\UserController::editForm');
$routes->post('frontoffice/profil/modifier', 'Frontoffice\UserController::submitEditForm');




//  BACK OFFICE — Gestion des
// Régimes
$routes->get('/backoffice/regimes', 'RegimeController::list');
$routes->get('/backoffice/regimes/new', 'RegimeController::newForm');
$routes->post('/backoffice/regimes/new', 'RegimeController::submitNewForm');
$routes->get('/backoffice/regimes/(:num)/edit', 'RegimeController::editForm/$1');
$routes->post('/backoffice/regimes/(:num)/edit', 'RegimeController::submitEditForm/$1');
$routes->post('/backoffice/regimes/(:num)/delete', 'RegimeController::delete/$1');

//  Sports
$routes->get('/backoffice/sports', 'SportController::list');
$routes->get('/backoffice/sports/new', 'SportController::newForm');
$routes->post('/backoffice/sports/new', 'SportController::submitNewForm');
$routes->get('/backoffice/sports/(:num)/edit', 'SportController::editForm/$1');
$routes->post('/backoffice/sports/(:num)/edit', 'SportController::submitEditForm/$1');
$routes->post('/backoffice/sports/(:num)/delete', 'SportController::delete/$1');

// Crédits
$routes->get('/backoffice/credits', 'CreditController::list');
$routes->get('/backoffice/credits/new', 'CreditController::newForm');
$routes->post('/backoffice/credits/new', 'CreditController::submitNewForm');
$routes->get('/backoffice/credits/(:num)/edit', 'CreditController::editForm/$1');
$routes->post('/backoffice/credits/(:num)/edit', 'CreditController::submitEditForm/$1');
$routes->post('/backoffice/credits/(:num)/delete', 'CreditController::delete/$1');
