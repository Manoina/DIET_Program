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

    // GET /frontoffice/profil
    public function profile()
    {
        $user = $this->userModel->find(session()->get('user_id'));
        $imc  = $this->userModel->calculerIMC((float) $user['poids'], (float) $user['taille']);

        return view('User/profile', [
            'user' => $user,
            'imc'  => $imc,
        ]);
    }

    // GET /frontoffice/profil/modifier
    public function editForm()
    {
        $user = $this->userModel->find(session()->get('user_id'));

        return view('User/editForm', [
            'user' => $user,
        ]);
    }

    // POST /frontoffice/profil/modifier
    public function submitEditForm()
    {
        $userId = session()->get('user_id');

        if (!$this->validate([
            'nom'      => 'required|min_length[2]',
            'genre'    => 'required|in_list[M,F]',
            'taille'   => 'required|numeric',
            'poids'    => 'required|numeric',
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
        ];

        // Password mis à jour uniquement si l'user en saisit un nouveau
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
