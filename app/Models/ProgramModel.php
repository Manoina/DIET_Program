<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramModel extends Model
{
    protected $table         = 'programmes';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'id_user',
        'objectif',
        'poids_cible',
        'id_regime',
        'duree_regime',
        'date_debut',
        'date_fin',
    ];

    public function getLatestByUserId(int $userId): ?array
    {
        return $this->where('id_user', $userId)
                    ->orderBy('id', 'DESC')
                    ->first();
    }

}
