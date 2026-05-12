<?php

namespace App\Controllers\Frontoffice;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // =============================================================
    //  LOGIN
    // =============================================================

    // GET /frontoffice/login
    public function loginForm()
    {
        if (session()->get('user_id')) {
            return redirect()->to('/frontoffice/profil');
        }

        return view('User/loginForm');
    }

    // POST /frontoffice/login
    public function loginTraiter()
    {
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Étape 1 — Vérifier si l'email existe
        $user = $this->userModel->getByEmail($email);

        if (!$user) {
            return redirect()->back()
                             ->with('error', 'Email non existante.')
                             ->withInput();
        }

        // Étape 2 — Vérifier maintenant le mot de passe
        if (!password_verify($password, $user['password'])) {
            return redirect()->back()
                             ->with('error', 'Mot de passe incorrect.')
                             ->withInput();
        }

        // Tout est bon → session
        session()->set([
            'user_id'  => $user['id'],
            'user_nom' => $user['nom'],
            'est_gold'  => $user['est_gold'],
            'connecte' => true,
        ]);

        return redirect()->to('/frontoffice/profil');
    }

    // =============================================================
    //  SIGNUP — Étape 1 : Infos personnelles
    // =============================================================

    // GET /frontoffice/signup
    public function signupForm()
    {
        if (session()->get('user_id')) {
            return redirect()->to('/frontoffice/profil');
        }

        $user = session()->get('signup_step1') ?? ['nom' => '', 'genre' => 'M', 'email' => '', 'password' => ''];
        $user['password'] = '';

        return view('User/signupFormStep1', ['user' => $user]);
    }

    // POST /frontoffice/signup
    public function signupTraiter1()
    {
        if (!$this->validate([
            'nom'      => 'required|min_length[2]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'genre'    => 'required|in_list[M,F]',
        ])) {
            return redirect()->back()
                             ->with('errors', $this->validator->getErrors())
                             ->withInput();
        }

        // Stocker en session temporaire pour l'étape 2
        session()->set('signup_step1', [
            'nom'      => $this->request->getPost('nom'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'genre'    => $this->request->getPost('genre'),
        ]);

        return redirect()->to('/frontoffice/signup/sante');
    }

    // =============================================================
    //  SIGNUP — Étape 2 : Infos santé
    // =============================================================

    // GET /frontoffice/signup/sante
    public function signupSanteForm()
    {
        if (!session()->get('signup_step1')) {
            return redirect()->to('/frontoffice/signup');
        }

        return view('User/signupFormStep2');
    }

    // POST /frontoffice/signup/sante
    public function signupTraiter2()
    {
        $step1 = session()->get('signup_step1');

        if (!$step1) {
            return redirect()->to('/frontoffice/signup');
        }

        if (!$this->validate([
            'taille'   => 'required|numeric',
            'poids'    => 'required|numeric',
        ])) {
            return redirect()->back()
                             ->with('errors', $this->validator->getErrors())
                             ->withInput();
        }

        $taille = (float) $this->request->getPost('taille');
        $poids  = (float) $this->request->getPost('poids');

        $donnees = array_merge($step1, [
            'taille'   => $taille,
            'poids'    => $poids,
            'solde'    => 0,
            'est_gold'  => 0,
        ]);

        $this->userModel->insert($donnees);

        session()->remove('signup_step1');

        return redirect()->to('/frontoffice/login')
                         ->with('success', 'Inscription réussie ! Connectez-vous.');
    }

    // =============================================================
    //  LOGOUT
    // =============================================================

    // GET /frontoffice/logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/frontoffice/login');
    }
}
