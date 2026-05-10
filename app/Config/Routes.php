<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// =============================================================
//  FRONT OFFICE — Authentification (AuthController)
// =============================================================

// Login
$routes->get('frontoffice/login',  'Frontoffice\AuthController::loginForm');
$routes->post('frontoffice/login', 'Frontoffice\AuthController::loginTraiter');

// Signup étape 1 — infos personnelles
$routes->get('frontoffice/signup',  'Frontoffice\AuthController::signupForm');
$routes->post('frontoffice/signup', 'Frontoffice\AuthController::signupTraiter1');

// Signup étape 2 — infos santé
$routes->get('frontoffice/signup/sante',  'Frontoffice\AuthController::signupSanteForm');
$routes->post('frontoffice/signup/sante', 'Frontoffice\AuthController::signupTraiter2');

// Logout
$routes->get('frontoffice/logout', 'Frontoffice\AuthController::logout');

// =============================================================
//  FRONT OFFICE — Profil utilisateur (UserController)
// =============================================================

$routes->get('frontoffice/profil',           'Frontoffice\UserController::profile');
$routes->get('frontoffice/profil/modifier',  'Frontoffice\UserController::editForm');
$routes->post('frontoffice/profil/modifier', 'Frontoffice\UserController::submitEditForm');

// =============================================================
//  BACK OFFICE — Authentification (AdminController)
// =============================================================

$routes->get('backoffice/login',  'Backoffice\AdminController::loginForm');
$routes->post('backoffice/login', 'Backoffice\AdminController::submitLoginForm');
$routes->get('backoffice/logout', 'Backoffice\AdminController::logout');

// =============================================================
//  BACK OFFICE — Dashboard (AdminController)
// =============================================================

$routes->get('backoffice/dashboard', 'Backoffice\AdminController::dashboard');