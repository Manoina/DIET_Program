<?php

namespace App\Controllers\Frontoffice;

use App\Controllers\BaseController;
use App\Models\CreditModel;
use App\Models\Credit_userModel;

class CreditController extends BaseController
{
    protected CreditModel      $creditModel;
    protected Credit_userModel $creditUserModel;

    public function __construct()
    {
        $this->creditModel     = new CreditModel();
        $this->creditUserModel = new Credit_userModel();
    }


    // =============================================================
    //  POST /frontoffice/credit/demander
    //  User soumet un code → insertion dans credit_user en attente
    //  estAccepte = null, date_reponse = null
    // =============================================================
    public function demanderCredit()
    {
        $userId = session()->get('user_id');
        $code   = $this->request->getPost('code');

        // Vérifier que le code existe en base
        $credit = $this->creditModel->findByCode($code);

        if (!$credit) {
            return redirect()->back()
                             ->with('error', 'Code invalide.')
                             ->withInput();
        }

        // Vérifier que le user n'a pas déjà soumis ce même code
        $dejaEnvoyee = $this->creditUserModel
                            ->where('id_user',   $userId)
                            ->where('id_credit', $credit['id'])
                            ->first();

        if ($dejaEnvoyee) {
            return redirect()->back()
                             ->with('error', 'Vous avez déjà soumis ce code.');
        }

        // Insertion : estAccepte = null, date_reponse = null
        $this->creditUserModel->soumettreDemande($userId, $credit['id']);

        return redirect()->back()
                         ->with('success', 'Demande envoyée, en attente de validation.');
    }

    // =============================================================
    //  GET /frontoffice/credit/historique
    //  Historique des demandes du user connecté
    // =============================================================
    public function getCreditByUser()
    {
        $userId   = session()->get('user_id');
        $demandes = $this->creditUserModel->getDemandesUser($userId);

        return view('Credit/listUser', [
            'demandes' => $demandes,
        ]);
    }
}
