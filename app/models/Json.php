<?php
    
namespace App\Models;

use core\Database;
use PDO;

date_default_timezone_set('America/Sao_Paulo');

class Json {

    public function disposeJson($table, $username, $token) {
        $message;

        if($table !== null && $this->existUser($username, $token) === true) {
            
            $pdo = Database::getConnection();

            header('Content-Type: application/json; charset=utf-8');

            try {
                $stmt = $pdo->query("SELECT * FROM `$table`");
                $json = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (!empty($json)) {
                    $message = 'Dados retornados com sucesso!';
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                } else {
                    $message = 'A tabela informada não possui dados ou não existe!';
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode(['message' => $message], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                }
            } catch (\Throwable $th) {
                $message = 'A tabela informada é inexistente, ou não foi encontrada!';
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(['message' => $message], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            }
        } else {
            $message = 'O usuário pode ter sido informado incorretamente ou não existe!';

            header('Content-Type: application/json; charset=utf-8');

            echo json_encode([
                'message' => $message
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            
        }
    }

     public function existUser($username, $token) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('SELECT * FROM user_access where username = :username and token = :token');
        $stmt->execute(['username' => $username, 'token' => $token]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC) ?: null;

        $message = 'O usuário pode ter sido informado incorretamente ou não existe!';

        if($row > 0) {
            return true;
        } else {
            return false;
        }
    }

}










?>