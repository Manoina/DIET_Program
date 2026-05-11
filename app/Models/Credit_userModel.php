<?php

namespace App\Models;

use CodeIgniter\Model;

class Credit_userModel extends Model
{
    protected $table         = 'credit_user';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'user_id',
        'credit_id',
        'date_demande',
        'admin_id',
        'estAccepte',
        'date_response',
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
        return $this->where('user_id', $userId)
                    ->orderBy('date_demande', 'DESC')
                    ->findAll();
    }

    // Récupérer toutes les demandes avec détails (user + credit)
    public function getAllAvecDetails(): array
    {
        return $this->select('credit_user.*, users.nom, users.prenom, credits.code, credits.valeur')
                    ->join('users',   'users.id   = credit_user.user_id')
                    ->join('credits', 'credits.id = credit_user.credit_id')
                    ->orderBy('date_demande', 'DESC')
                    ->findAll();
    }

    // Récupérer toutes les demandes en attente (pour le back office)
    public function PendingList(): array
    {
        return $this->where('estAccepte', null)
                    ->findAll();
    }

    // Soumettre une demande de crédit par un user
    public function soumettreDemande(int $userId, int $creditId): int|false
    {
        return $this->insert([
            'user_id'      => $userId,
            'credit_id'    => $creditId,
            'date_demande' => date('Y-m-d H:i:s'),
            'estAccepte'   => null,   // null = en attente
            'admin_id'     => null,
            'date_response'=> null,
        ]);
    }

    // Admin répond à une demande (accepte ou refuse)
    public function repondre(int $id, int $adminId, bool $accepte): bool
    {
        return $this->update($id, [
            'admin_id'      => $adminId,
            'estAccepte'    => $accepte ? 1 : 0,
            'date_response' => date('Y-m-d H:i:s'),
        ]);
    }

    
}