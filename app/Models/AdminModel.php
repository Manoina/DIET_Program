<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table         = 'admins';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'email',
        'password',
    ];

    protected $useTimestamps = false;

    // ---------------------------------------------------------------
    // Récupérer un admin par email (pour la connexion back office)
    // ---------------------------------------------------------------
    public function getByEmail(string $email)
    {
        return $this->where('email', $email)->first();
    }


    public function findByEmailEtPassword(string $email, string $password): ?array
    {
        $admin = $this->getByEmail($email);

        if (!$admin) return null;

        return password_verify($password, $admin['password']) ? $admin : null;
    }

}