<?php

namespace App\Models;

use CodeIgniter\Model;

class Credit_userModel extends Model
{
    protected $table         = 'credits_users';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'id_user',
        'id_credit',
        'date_demande',
        'id_admin',
        'est_accepte',
        'date_reponse',
    ];

    protected $useTimestamps = false;

    // =============================================================
    //  CRUD DE BASE
    // =============================================================
    // Récupérer une demande par son id
    public function findById(int $id): ?array
    {
        return $this->find($id);
    }

    // Récupérer les demandes d'un user spécifique
    public function getDemandesUser(int $userId): array
    {
        return $this->select('credits_users.*, credits.code, credits.valeur')
                    ->join('credits', 'credits.id = credits_users.id_credit')
                    ->where('id_user', $userId)
                    ->orderBy('date_demande', 'DESC')
                    ->findAll();
    }

    // Récupérer toutes les demandes avec détails (user + credit)
    public function getAllAvecDetails(): array
    {
        return $this->select('credits_users.*, users.nom, credits.code, credits.valeur')
                    ->join('users',   'users.id   = credits_users.id_user')
                    ->join('credits', 'credits.id = credits_users.id_credit')
                    ->orderBy('date_demande', 'DESC')
                    ->findAll();
    }

    // Récupérer toutes les demandes en attente (pour le back office)
    public function getDemandesEnAttente(): array
    {
        return $this->select('credits_users.*, users.nom, credits.code, credits.valeur, credits_users.id as id_demande')
                    ->join('users',   'users.id   = credits_users.id_user')
                    ->join('credits', 'credits.id = credits_users.id_credit')
                    ->where('est_accepte', null)
                    ->findAll();
    }

    // Soumettre une demande de crédit par un user
    public function soumettreDemande(int $userId, int $creditId): int|false
    {
        return $this->insert([
            'id_user'      => $userId,
            'id_credit'    => $creditId,
            'date_demande' => date('Y-m-d H:i:s'),
            'est_accepte'   => null,   // null = en attente
            'id_admin'     => null,
            'date_reponse'=> null,
        ]);
    }

    // Admin répond à une demande (accepte ou refuse)
    public function repondre(int $id, int $adminId, bool $accepte): bool
    {
        return $this->update($id, [
            'id_admin'      => $adminId,
            'est_accepte'    => $accepte ? 1 : 0,
            'date_reponse' => date('Y-m-d H:i:s'),
        ]);
    }


}
