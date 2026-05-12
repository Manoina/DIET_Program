<?php

namespace App\Models;

use CodeIgniter\Model;

class SportModel extends Model
{
    protected $table         = 'sports';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'nom',
        'var_poids_jour',
    ];

    protected $useTimestamps = false;

    public function getByIds(array $ids): array
    {
        if (empty($ids)) {
            return [];
        }

        return $this->whereIn('id', $ids)->findAll();
    }
}