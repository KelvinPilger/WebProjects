<?php 

namespace App\Models;

use core\Database;
use Exception;
use PDO;
use Throwable;

date_default_timezone_set('America/Sao_Paulo');

class User {
    public $id;
    public string $username;
    public string $password_hash;
    public string $token;
    public string $email;

    public function findUsers($user, $password): array {
        
        try {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM clients WHERE username = :user AND password = :password");
        $stmt->execute(['user' => $user, 'password' => $password]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (\Throwable $th) {
            return ['status' => 'warning', 'message' => 'O log-in não foi efetuado com sucesso!'];
        }
    }

    public function createUser($user, $password_hash, $email): array {
        $token = ''; $message = '';

        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("INSERT INTO USER_ACCESS (user, password_hash, token, email) VALUES (:user, :password, :token, :email");

        if($stmt->execute(['user' => $user, 'password' => $password_hash,
        'token' => $token, 'email' => $email])) {
            $message = 'O usuário foi registrado com sucesso!';
            return ['message' => $message, 'status' => true];
        } else {
            $message = 'Não conseguimos cadastrar o usuário, tente novamente em instantes!';
            return ['message' => $message, 'status' => true];
        }

        
    }
}

?>