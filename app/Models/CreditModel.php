<?php

namespace App\Models;

use CodeIgniter\Model;

class CreditModel extends Model
{
    protected $table         = 'credits';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'valeur',
        'code',
    ];

    protected $validationRules = [
        'valeur' => 'required|numeric|greater_than[0]',
        'code'   => 'required|min_length[5]|max_length[14]|is_unique[credits.code]',
    ];

    protected $validationMessages = [
        'valeur' => [
            'required'      => 'La valeur du crédit est requise.',
            'numeric'       => 'La valeur doit être un nombre.',
            'greater_than'  => 'La valeur doit être supérieure à 0.',
        ],
        'code' => [
            'required'      => 'Le code du crédit est requis.',
            'min_length'    => 'Le code doit avoir au moins 5 caractères.',
            'max_length'    => 'Le code ne doit pas dépasser 14 caractères.',
            'is_unique'     => 'Ce code existe déjà.',
        ],
    ];
}
