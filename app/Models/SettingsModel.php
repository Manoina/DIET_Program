<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingsModel extends Model
{
    protected $table            = 'settings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['prix_gold', 'reduction_gold'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'prix_gold'      => 'required|numeric|greater_than[0]',
        'reduction_gold' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]',
    ];
    protected $validationMessages = [
        'prix_gold' => [
            'required'     => 'Le prix est requis.',
            'greater_than' => 'Le prix doit être supérieur à 0',
        ],
        'reduction_gold' => [
            'required'              => 'La réduction est requis.',
            'greater_than_equal_to' => 'La réduction doit être entre 0 et 100',
            'less_than_equal_to'    => 'La réduction doit être entre 0 et 100',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    public function getPrixGold() {
        return $this->first()['prix_gold'];
    }

    public function getReductionGold() {
        return $this->first()['reduction_gold'];
    }
}
