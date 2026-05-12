<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramModel extends Model
{
    protected $table         = 'programs';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'id_user',
        'objectif',
        'poids_cible',
        'regime_id',
        'duree_regime',
        'date_debut',
        'date_fin',
    ];

    protected $useTimestamps = true;

    public function getLatestByUserId(int $userId): ?array
    {
        return $this->where('id_user', $userId)
                    ->orderBy('id', 'DESC')
                    ->first();
    }

}