<?php 

namespace App\Models;
use core\Database;
use PDO;

class Client {
    public $id;
    public $name;
    public $inserted_at;
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
        $stmt = $pdo->prepare('SELECT * FROM clients where id = :id');
		$stmt->execute(['id' => $id]);
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC) ?: null; 
		
		return $row !== false 
        ? $row 
        : [];
    }

    public function delete($id): string {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('DELETE FROM clients WHERE id = :id');
        if($stmt->execute(['id' => $id])) {
            return "Cliente excluído com sucesso!";
        } else {
            return "Não foi possível excluir o cliente!";
        }
    }

    public function edit($id): array {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('SELECT id, name, inserted_at, cpf, cnpj, born_at, age, email, nat_registration FROM clients WHERE id = :id');
        
        if (! $stmt->execute(['id' => $id])) {
            return [];  
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: [];
    }

    public function save($client): void {
<<<<<<< HEAD
        $clientObj = json_decode($client, true);

        if($clientObj['cpf'] !== null) {
            $nat = 'F';
        } else {
            $nat = 'J';
        }

        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('UPDATE CLIENTS SET name = :name, born_at = :bornDate, cpf = :cpf, cnpj = :cnpj, nat_registration = :nat where id = :id');

        if($stmt->execute([
            'name' => $clientObj['name'],
            'bornDate' => $clientObj['bornDate'],
            'cpf' => $clientObj['cpf'], 
            'cnpj' => $clientObj['cnpj'], 
            'nat' => $nat, 'id' => $clientObj['id']
        ])) {
            header('Location: ../client/index');
        } else {
            echo 'Não foi possível salvar o registro';
        }
=======
        $updateClient = $client;

        $id = $updateClient->id;
        $name = $updateClient->name;

        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('UPDATE clients set name = :name, cpf = :cpf, cnpj = :cnpj, born_at = :bornDate, age = 18, nat_registration = :nat_registration where id = :id');

>>>>>>> 2df981beeb76bdebc204308a6234c5c8f636321e
    }
}
?>

<!-- // string(114) "{"name":"gabriela mendes","borndate":"1996-03-08","cpf":"67890123467","cnpj":"","ctt_type":"celular","contact":""}" -->