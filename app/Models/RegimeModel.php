<?php

namespace App\Models;

use CodeIgniter\Model;

class RegimeModel extends Model
{
    protected $table         = 'regime';
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