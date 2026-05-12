<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table         = 'users';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'nom',
        'email',
        'password',
        'genre',
        'taille',
        'poids',
        'solde',
        'est_gold',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';          // pas de colonne updated_at dans la table

    protected $validationRules = [
        'nom'      => 'required|min_length[2]',
        'email'    => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[6]',
        'genre'    => 'required|in_list[M,F]',
        'taille'   => 'required|numeric',
        'poids'    => 'required|numeric',
    ];

    // ---------------------------------------------------------------
    // Récupérer un user par email
    // ---------------------------------------------------------------
    public function getByEmail(string $email)
    {
        return $this->where('email', $email)->first();
    }

    // ---------------------------------------------------------------
    // Connexion : vérifier email + password
    // password_verify(texte_brut, hash_en_base) → true/false
    // ---------------------------------------------------------------
    public function findByEmailEtPassword(string $email, string $password): ?array
    {
        $user = $this->getByEmail($email);

        if (!$user) return null;

        return password_verify($password, $user['password']) ? $user : null;
    }

    // ---------------------------------------------------------------
    // Calcul IMC à la volée — pas stocké en base car dérivé de
    // taille et poids qui sont déjà en base
    // ---------------------------------------------------------------
    public function calculerIMC(float $poids, float $taille): float
    {
        $tailleEnMetre = $taille / 100;
        return round($poids / ($tailleEnMetre * $tailleEnMetre), 2);
    }

    // ---------------------------------------------------------------
    // Créditer le solde du portefeuille
    // ---------------------------------------------------------------
    public function crediterSolde(int $userId, float $montant): bool
    {
        $user = $this->find($userId);
        if (!$user) return false;

        return $this->update($userId, ['solde' => $user['solde'] + $montant]);
    }

    // ---------------------------------------------------------------
    // Débiter le solde (lors d'un achat de régime)
    // ---------------------------------------------------------------
    public function debiterSolde(int $userId, float $montant): bool
    {
        $user = $this->find($userId);
        if (!$user || $user['solde'] < $montant) return false;

        return $this->update($userId, ['solde' => $user['solde'] - $montant]);
    }

    // ---------------------------------------------------------------
    // Activer l'option Gold
    // ---------------------------------------------------------------
    public function activerGold(int $userId): bool
    {
        return $this->update($userId, ['est_gold' => 1]);
    }
}
