<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Vérifie que l'admin back office est bien connecté
        $admin = session()->get('admin');

        if (!$admin || empty($admin['admin_connecte'])) {
            return redirect()->to('/backoffice/login')
                             ->with('error', 'Accès réservé aux administrateurs.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Rien à faire après
    }
}