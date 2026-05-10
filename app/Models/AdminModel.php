<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table         = 'admins';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'nom',
        'prenom',
        'email',
        'password'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';          // pas de colonne updated_at dans la table

    protected $validationRules = [
        'nom'      => 'required|min_length[2]',
        'prenom'   => 'required|min_length[2]',
        'email'    => 'required|valid_email|is_unique[admins.email]',
        'password' => 'required|min_length[6]',
        
    ];

    // ---------------------------------------------------------------
    // Récupérer un user par email
    // ---------------------------------------------------------------
    public function getByEmail(string $email)
    {
        return $this->where('email', $email)->first();
    }

    // ---------------------------------------------------------------
    // Connexion : vérifier email + password
    // password_verify(texte_brut, hash_en_base) → true/false
    // ---------------------------------------------------------------
    public function findByEmailEtPassword(string $email, string $password): ?array
    {
        $admin = $this->getByEmail($email);

        if (!$admin) return null;

        return password_verify($password, $admin['password']) ? $admin : null;
    }

}