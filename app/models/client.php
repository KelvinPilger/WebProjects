<?php 

namespace App\Models;
use core\Database;
use PDO;

class Client {
    public $id;
    public $name;
    public $inseted_at;
    public $cpf;
    public $cnpj;
    public $born_at;
    public $age;
    public $email;
    public $nat_registration;

    public function findAll(): array {
        $pdo = Database::getConnection();
        $stmt = $pdo->query('SELECT * FROM clients');
        return $stmt->fetchAll();
    }

    public function searchById($id): array {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('SELECT * FROM clients where ID = :id');
		$stmt->execute(['id' => $id]);
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC) ?: null; 
		
		return $row !== false 
        ? $row 
        : [];
    }
}
?>