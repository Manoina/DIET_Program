<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramSportModel extends Model
{
    protected $table         = 'programmes_sports';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'id_programme',
        'id_sport',
        'quantite',
    ];

    protected $useTimestamps = false;

    public function getSportsByProgramId(int $programId): array
    {
        return $this->select('programmes_sports.*, sports.nom')
                    ->join('sports', 'sports.id = programmes_sports.id_sport')
                    ->where('id_programme', $programId)
                    ->findAll();
    }
}
