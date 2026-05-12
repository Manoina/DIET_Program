<?php

namespace App\Models;

use CodeIgniter\Model;

class AchatGoldModel extends Model
{
    protected $table         = 'achats_gold';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'id_user',
        'date_achat',
        'prix',
    ];

    protected $useTimestamps = false;

    public function enregistrer(int $userId, float $prix): int|false
    {
        return $this->insert([
            'id_user'    => $userId,
            'date_achat' => date('Y-m-d H:i:s'),
            'prix'       => $prix,
        ]);
    }

    public function dejaAchete(int $userId): bool
    {
        return $this->where('id_user', $userId)->first() !== null;
    }
}