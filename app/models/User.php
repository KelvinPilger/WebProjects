<?php

namespace App\Models;

use Core\Database;
use PDO;

date_default_timezone_set('America/Sao_Paulo');

class User
{
    public function findUser(string $user): ?array
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT id, username, email, password_hash FROM clients WHERE username = :user LIMIT 1");
        $stmt->execute(['user' => $user]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ?: null;
    }

    public function saveToken(int $userId, string $token): bool
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("UPDATE clients SET token = :token WHERE id = :id");
        return $stmt->execute(['token' => $token, 'id' => $userId]);
    }

    public function createUser(string $user, string $password_plain, string $email): array
    {
        $pdo = Database::getConnection();

        $hash = password_hash($password_plain, PASSWORD_BCRYPT);
        $token = bin2hex(random_bytes(16));

        // CORREÇÃO: faltava fechar parêntese no SQL
        $stmt = $pdo->prepare("
            INSERT INTO USER_ACCESS (user, password_hash, token, email)
            VALUES (:user, :password, :token, :email)
        ");

        $ok = $stmt->execute([
            'user' => $user,
            'password' => $hash,
            'token' => $token,
            'email' => $email
        ]);

        return [
            'status' => $ok ? 'success' : 'error',
            'message' => $ok ? 'Usuário registrado com sucesso!' : 'Falha ao registrar o usuário.'
        ];
    }
}
