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

    protected $useTimestamps = false;

    // Insérer un nouveau crédit (code + valeur)
    // Inutile peut etre mais bon bref
    public function ajouter(array $donnees): int|false
    {
        return $this->insert($donnees);
    }
 
    // Modifier un crédit existant
    public function modifier(int $id, array $donnees): bool
    {
        return $this->update($id, $donnees);
    }
 
    // Supprimer un crédit
    public function supprimer(int $id): bool
    {
        return $this->delete($id);
    }
 
    // Récupérer tous les crédits
    public function findAll(?int $limit = null, int $offset = 0): array
    {
        return parent::findAll($limit, $offset);
    }
 
    // Récupérer un crédit par son id
    public function findById(int $id): ?array
    {
        return $this->find($id);
    }
 
    // =============================================================
    //  MÉTHODES UTILES
    // =============================================================
 
    // Récupérer un crédit par son code (pour vérification)
    public function findByCode(string $code): ?array
    {
        return $this->where('code', $code)->first();
    }
}
