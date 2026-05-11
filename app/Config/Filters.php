<?php

namespace Config;

use App\Filters\AuthFilter;
use App\Filters\AdminFilter;
use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
    // Déclaration des alias des filtres
    public array $aliases = [
        'csrf'  => \CodeIgniter\Filters\CSRF::class,
        'auth'  => AuthFilter::class,   // front office users
        'admin' => AdminFilter::class,  // back office admins
    ];

    // Filtres globaux appliqués à toutes les routes
    public array $globals = [
        'before' => [
            'csrf',
        ],
    ];

    public array $methods = [];
    public array $filters = [];
}