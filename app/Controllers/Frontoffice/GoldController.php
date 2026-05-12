<?php

namespace App\Controllers\Frontoffice;

use App\Controllers\BaseController;
use App\Models\AchatGoldModel;
use App\Models\UserModel;

class GoldController extends BaseController
{
    protected AchatGoldModel $achatGoldModel;
    protected UserModel      $userModel;

    // Prix de configuration
    const PRIX_GOLD = 50000;

    public function __construct()
    {
        $this->achatGoldModel = new AchatGoldModel();
        $this->userModel      = new UserModel();
    }

    public function goldInfo()
    {
        $userId = session()->get('user_id');
        $user   = $this->userModel->find($userId);

        return view('Gold/info', [
            'user'      => $user,
            'prix_gold' => self::PRIX_GOLD,
        ]);
    }


    public function buyGold()
    {
        $userId = session()->get('user_id');
        $user   = $this->userModel->find($userId);

        // Vérification 1 — déjà Gold
        if ($user['est_gold']) {
            return redirect()->back()
                             ->with('error', 'Vous avez déjà l’option Gold.');
        }

        // Vérification 2 — solde suffisant
        if ($user['solde'] < self::PRIX_GOLD) {
            return redirect()->back()
                             ->with('error', 'Solde insuffisant. Rechargez votre portefeuille.');
        }

        // Étape 1 — Insérer dans achats_gold
        $this->achatGoldModel->enregistrer($userId, self::PRIX_GOLD);

        // Étape 2 — Débiter le solde
        $this->userModel->debiterSolde($userId, self::PRIX_GOLD);

        // Étape 3 — Activer est_gold
        $this->userModel->activerGold($userId);

        // Mettre à jour est_gold en session
        $adminSession = session()->get('admin');
        session()->set('est_gold', 1);

        return redirect()->to('/frontoffice/gold')
                         ->with('success', 'Option Gold activée ! Vous bénéficiez de 15% de remise sur tous les régimes.');
    }
}
