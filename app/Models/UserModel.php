<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'nom',
        'prenom',
        'email',
        'password',
        'genre',
        'taille',
        'poids',
        'imc',
        'objectif',
        'solde',
        'is_gold',
    ];

    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = '';

    protected $validationRules = [
        'nom'      => 'required|min_length[2]',
        'prenom'   => 'required|min_length[2]',
        'email'    => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[6]',
        'genre'    => 'required|in_list[homme,femme]',
        'taille'   => 'required|numeric',
        'poids'    => 'required|numeric',
        'objectif' => 'required|in_list[augmenter,reduire,imc_ideal]',
    ];

    
    public function getByEmail(string $email)
    {
        return $this->where('email', $email)->first();
    }

    public function findByEmailEtPassword(string $email, string $password): ?array
    {
        $user = $this->where('email', $email)->first();

        if (!$user) {
            return null;
        }

        return password_verify($password, $user['password_hash']) ? $user : null;
    }
    
    public function calculerIMC(float $poids, float $taille): float
    {
        $tailleEnMetre = $taille / 100;
        return round($poids / ($tailleEnMetre * $tailleEnMetre), 2);
    }

    
    public function crediterSolde(int $userId, float $montant): bool
    {
        $user = $this->find($userId);
        if (!$user) return false;

        return $this->update($userId, [
            'solde' => $user['solde'] + $montant
        ]);
    }

    // ---------------------------------------------------------------
    // Débiter le solde (lors d'un achat de régime)
    // ---------------------------------------------------------------
    public function debiterSolde(int $userId, float $montant): bool
    {
        $user = $this->find($userId);
        if (!$user || $user['solde'] < $montant) return false;

        return $this->update($userId, [
            'solde' => $user['solde'] - $montant
        ]);
    }

    // ---------------------------------------------------------------
    // Activer l'option Gold
    // ---------------------------------------------------------------
    public function activerGold(int $userId): bool
    {
        return $this->update($userId, ['is_gold' => 1]);
    }
}
