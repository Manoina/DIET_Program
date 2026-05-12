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

    protected $validationRules = [
        'nom'             => 'required|min_length[2]|max_length[30]',
        'var_poids_jour'  => 'required|numeric',
    ];

    protected $validationMessages = [
        'nom' => [
            'required'    => 'Le nom du sport est requis.',
            'min_length'  => 'Le nom doit avoir au moins 2 caractères.',
            'max_length'  => 'Le nom ne doit pas dépasser 30 caractères.',
        ],
    ];

    public function getByIds(array $ids): array
    {
        if (empty($ids)) {
            return [];
        }

        return $this->whereIn('id', $ids)->findAll();
    }
}
