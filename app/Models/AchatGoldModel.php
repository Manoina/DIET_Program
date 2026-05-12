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

    public function getDailyPurchaseCounts(int $days = 7): array
    {
        $startDate = date('Y-m-d', strtotime('-' . ($days - 1) . ' days'));

        return $this->select('DATE(date_achat) AS periode, COUNT(*) AS total', false)
                    ->where('date_achat >=', $startDate)
                    ->groupBy('periode')
                    ->orderBy('periode', 'ASC')
                    ->findAll();
    }

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