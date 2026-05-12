<?php

namespace App\Models;

use CodeIgniter\Model;

class RegimeModel extends Model
{
    protected $table         = 'regimes';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'nom',
        'taux_viande',
        'taux_poisson',
        'taux_volaille',
        'var_poids_jour',
        'prix_jour',
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'nom'              => 'required|min_length[2]|max_length[30]',
        'taux_viande'      => 'required|numeric',
        'taux_poisson'     => 'required|numeric',
        'taux_volaille'    => 'required|numeric',
        'var_poids_jour'   => 'required|numeric',
        'prix_jour'        => 'required|numeric',
    ];

    protected $validationMessages = [
        'nom' => [
            'required'    => 'Le nom du régime est requis.',
            'min_length'  => 'Le nom doit avoir au moins 2 caractères.',
            'max_length'  => 'Le nom ne doit pas dépasser 30 caractères.',
        ],
    ];

    public function getByObjectif(string $objectif): array
    {
        if ($objectif === 'augmenter') {
            return $this->where('var_poids_jour >', 0)
                        ->orderBy('var_poids_jour', 'DESC')
                        ->findAll();
        }

        if ($objectif === 'reduire') {
            return $this->where('var_poids_jour <', 0)
                        ->orderBy('var_poids_jour', 'ASC')
                        ->findAll();
        }

        return $this->orderBy('var_poids_jour', 'ASC')->findAll();
    }
}
