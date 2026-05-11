<?php

namespace App\Controllers\Frontoffice;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // ---------------------------------------------------------------
    // Vérification auth — appelée au début de chaque méthode
    // ---------------------------------------------------------------
    private function checkAuth()
    {
        if (!session()->get('connecte')) {
            return redirect()->to('/frontoffice/login');
        }
        return null;
    }

    // =============================================================
    //  PROFIL — Affichage
    // =============================================================

    // GET /frontoffice/profil
    public function profile()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $user = $this->userModel->find(session()->get('user_id'));

        // IMC calculé à la volée depuis poids et taille déjà en base
        $imc = $this->userModel->calculerIMC((float) $user['poids'], (float) $user['taille']);

        return view('Frontoffice/User/profile', [
            'user' => $user,
            'imc'  => $imc,
        ]);
    }

    // =============================================================
    //  EDIT — Affichage du formulaire
    // =============================================================

    // GET /frontoffice/profil/modifier
    public function editForm()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $user = $this->userModel->find(session()->get('user_id'));

        return view('Frontoffice/User/editForm', [
            'user' => $user,
        ]);
    }

    // =============================================================
    //  EDIT — Traitement du formulaire
    // =============================================================

    // POST /frontoffice/profil/modifier
    public function submitEditForm()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $userId = session()->get('user_id');

        if (!$this->validate([
            'nom'      => 'required|min_length[2]',
            'genre'    => 'required|in_list[homme,femme]',
            'taille'   => 'required|numeric',
            'poids'    => 'required|numeric',
            'objectif' => 'required|in_list[augmenter,reduire,imc_ideal]',
        ])) {
            return redirect()->back()
                             ->with('errors', $this->validator->getErrors())
                             ->withInput();
        }

        $donnees = [
            'nom'      => $this->request->getPost('nom'),
            'genre'    => $this->request->getPost('genre'),
            'taille'   => $this->request->getPost('taille'),
            'poids'    => $this->request->getPost('poids'),
            'objectif' => $this->request->getPost('objectif'),
        ];

        // Password : mis à jour uniquement si l'user en saisit un nouveau
        $nouveauPassword = $this->request->getPost('password');
        if (!empty($nouveauPassword)) {
            $donnees['password'] = password_hash($nouveauPassword, PASSWORD_DEFAULT);
        }

        $this->userModel->update($userId, $donnees);

        session()->set('user_nom', $donnees['nom']);

        return redirect()->to('/frontoffice/profil')
                         ->with('success', 'Profil mis à jour avec succès.');
    }
}