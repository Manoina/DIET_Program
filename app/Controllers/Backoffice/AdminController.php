<?php

namespace App\Controllers\Backoffice;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class AdminController extends BaseController
{
    protected AdminModel $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    // =============================================================
    //  LOGIN
    // =============================================================

    // GET /backoffice/login
    public function loginForm()
    {
        // Vérification sans crash si 'admin' est null en session
        $admin = session()->get('admin');
        if ($admin && !empty($admin['admin_connecte'])) {
            return redirect()->to('/backoffice/dashboard');
        }

        return view('Admin/loginForm');
    }

    // POST /backoffice/login
    public function submitLoginForm()
    {
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Étape 1 — Vérifier si l'email existe
        $admin = $this->adminModel->getByEmail($email);

        if (!$admin) {
            return redirect()->back()
                             ->with('error', 'Email non existante.')
                             ->withInput();
        }

        // Étape 2 — Vérifier le mot de passe
        if (!password_verify($password, $admin['password'])) {
            return redirect()->back()
                             ->with('error', 'Mot de passe incorrect.')
                             ->withInput();
        }

        // Tout est bon → session admin (clé séparée du front office)
        session()->set('admin', [
            'id'             => $admin['id'],
            'nom'            => $admin['nom'],
            'admin_connecte' => true,
        ]);

        return redirect()->to('/backoffice/dashboard');
    }

    // =============================================================
    //  LOGOUT
    // =============================================================

    // GET /backoffice/logout
    public function logout()
    {
        session()->remove('admin');
        return redirect()->to('/backoffice/login');
    }

    // =============================================================
    //  DASHBOARD
    // =============================================================

    // GET /backoffice/dashboard
    public function dashboard()
    {
        return view('Admin/dashboard');
    }
}
