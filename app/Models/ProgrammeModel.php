<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgrammeModel extends Model
{
    protected $table         = 'programmes';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'id_user',
        'type',
        'poids_cible',
        'duree',
        'id_regime',
        'duree_regime',
    ];

    public function getGoalCountsByGender(): array
    {
        $rows = $this->select('programmes.type, users.genre, COUNT(*) AS total')
                     ->join('users', 'users.id = programmes.id_user')
                     ->groupBy('programmes.type, users.genre')
                     ->orderBy('programmes.type', 'ASC')
                     ->findAll();

        $counts = [
            'augmenter' => ['M' => 0, 'F' => 0],
            'reduire'   => ['M' => 0, 'F' => 0],
            'imc'       => ['M' => 0, 'F' => 0],
        ];

        foreach ($rows as $row) {
            $type = strtolower(trim($row['type'] ?? ''));
            $genre = strtoupper(trim($row['genre'] ?? ''));

            $type = match ($type) {
                'perte' => 'reduire',
                'gain' => 'augmenter',
                'augmenter' => 'augmenter',
                'reduire' => 'reduire',
                'imc' => 'imc',
                default => $type,
            };

            if (! array_key_exists($type, $counts) || ! array_key_exists($genre, $counts[$type])) {
                continue;
            }

            $counts[$type][$genre] = (int) $row['total'];
        }

        return $counts;
    }
}
