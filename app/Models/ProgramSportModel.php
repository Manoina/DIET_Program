<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramSportModel extends Model
{
    protected $table         = 'program_sport';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'id_program',
        'id_sport',
        'quantite',
    ];

    protected $useTimestamps = false;

    public function getSportsByProgramId(int $programId): array
    {
        return $this->select('program_sport.*, sports.nom')
                    ->join('sports', 'sports.id = program_sport.id_sport')
                    ->where('id_program', $programId)
                    ->findAll();
    }
}
