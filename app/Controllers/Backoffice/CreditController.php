<?php

namespace App\Controllers\Backoffice;

use App\Controllers\BaseController;
use App\Models\CreditModel;
use App\Models\Credit_userModel;
use App\Models\UserModel;

class CreditController extends BaseController
{
    protected CreditModel      $creditModel;
    protected Credit_userModel $creditUserModel;
    protected UserModel        $userModel;

    public function __construct()
    {
        $this->creditModel     = new CreditModel();
        $this->creditUserModel = new Credit_userModel();
        $this->userModel       = new UserModel();
    }

    // =============================================================
    //  GET /backoffice/credits/pending
    //  Liste toutes les demandes en attente (estAccepte = null)
    // =============================================================
    public function pendingList()
    {
        $demandes = $this->creditUserModel->getDemandesEnAttente();

        return view('Credit/pendingList', [
            'demandes' => $demandes,
        ]);
    }

    // =============================================================
    //  POST /backoffice/credits/accepter/:id
    //  Accepter une demande → créditer le user
    //                       → refuser les autres demandes avec le même crédit
    // =============================================================
    public function accepterCredit(int $id)
    {
        $adminId = session()->get('admin')['id'];

        // Récupérer la demande concernée
        $demande = $this->creditUserModel->findById($id);

        if (!$demande) {
            return redirect()->back()->with('error', 'Demande introuvable.');
        }

        // Récupérer la valeur du crédit
        $credit = $this->creditModel->findById($demande['id_credit']);

        // 1 — Accepter cette demande
        $this->creditUserModel->repondre($id, $adminId, true);

        // 2 — Refuser automatiquement toutes les autres demandes
        //     avec le même id_credit (un code = un seul usage)
        $this->creditUserModel
             ->where('id_credit', $demande['id_credit'])
             ->where('id !=',     $id)
             ->where('est_accepte', null)
             ->set([
                 'est_accepte'    => 0,
                 'id_admin'      => $adminId,
                 'date_reponse' => date('Y-m-d H:i:s'),
             ])
             ->update();

        // 3 — Créditer le solde du user
        $this->userModel->crediterSolde($demande['id_user'], $credit['valeur']);

        return redirect()->back()
                         ->with('success', 'Demande acceptée et solde crédité.');
    }

    // =============================================================
    //  POST /backoffice/credits/refuser/:id
    //  Refuser une demande → estAccepte = 0
    // =============================================================
    public function refuserCredit(int $id)
    {
        $adminId = session()->get('admin')['id'];

        $demande = $this->creditUserModel->findById($id);

        if (!$demande) {
            return redirect()->back()->with('error', 'Demande introuvable.');
        }

        $this->creditUserModel->repondre($id, $adminId, false);

        return redirect()->back()
                         ->with('success', 'Demande refusée.');
    }
}
