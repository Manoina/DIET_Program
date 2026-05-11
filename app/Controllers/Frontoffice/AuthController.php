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

    // GET /backoffice/login
    public function loginForm()
    {
        $admin = session()->get('admin');
        if ($admin && !empty($admin['admin_connecte'])) {
            return redirect()->to('/backoffice/dashboard');
        }

        return view('Backoffice/login');
    }

    // POST /backoffice/login
    public function submitLoginForm()
    {
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $admin = $this->adminModel->getByEmail($email);

        if (!$admin) {
            return redirect()->back()
                             ->with('error_email', 'Email non existante.')
                             ->withInput();
        }

        if (!password_verify($password, $admin['password'])) {
            return redirect()->back()
                             ->with('error_password', 'Mot de passe incorrect.')
                             ->withInput();
        }

        session()->set('admin', [
            'id'             => $admin['id'],
            'nom'            => $admin['nom'],
            'admin_connecte' => true,
        ]);

        return redirect()->to('/backoffice/dashboard');
    }

    // GET /backoffice/logout
    public function logout()
    {
        session()->remove('admin');
        return redirect()->to('/backoffice/login');
    }

    // GET /backoffice/dashboard
    public function dashboard()
    {
        // AdminFilter a déjà vérifié l'auth avant d'arriver ici
        return view('Backoffice/dashboard');
    }
}