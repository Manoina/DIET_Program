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

    public function getGoalCountsByGender(): array
    {
        $rows = $this->select('programmes.objectif, users.genre, COUNT(*) AS total')
                     ->join('users', 'users.id = programmes.id_user')
                     ->groupBy('programmes.objectif, users.genre')
                     ->orderBy('programmes.objectif', 'ASC')
                     ->findAll();

        $counts = [
            'augmenter' => ['M' => 0, 'F' => 0],
            'reduire'   => ['M' => 0, 'F' => 0],
            'imc'       => ['M' => 0, 'F' => 0],
        ];

        foreach ($rows as $row) {
            $objectif = strtolower(trim($row['objectif'] ?? ''));
            $genre = strtoupper(trim($row['genre'] ?? ''));

            if (! array_key_exists($objectif, $counts) || ! array_key_exists($genre, $counts[$objectif])) {
                continue;
            }

            $counts[$objectif][$genre] = (int) $row['total'];
        }

        return $counts;
    }
}
