<?php 

namespace App\Models;
use core\Database;
use PDO;
use DateTime;

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
        $stmt = $pdo->query("SELECT * FROM clients");
        return $stmt->fetchAll();
    }

    public function countAll(): int {
        $pdo = Database::getConnection();
        $stmt = $pdo->query("SELECT COUNT(*) AS cnt FROM CLIENTS");
        return (int) $stmt->fetch(PDO::FETCH_ASSOC)['cnt'];
    }

    public function getPage(int $offset, int $limit): array {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("
            SELECT * FROM CLIENTS
            ORDER BY id
            LIMIT :limit OFFSET :offset
        ");
        $stmt->bindValue(':limit',  $limit,  PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        $clientObj = json_decode($client, true);
        var_dump($clientObj);

        if($clientObj['cpf'] !== null) {
            $nat = 'F';
        } else {
            $nat = 'J';
        }
        
        $bornDate = $clientObj['bornDate'];
        $age = (new DateTime())->diff(new DateTime($clientObj['bornDate']))->y;
        $now = (new DateTime())->getTimestamp();
        

        $pdo = Database::getConnection();

        var_dump($clientObj);

        if($clientObj['action'] == 'edit') {
            $stmt = $pdo->prepare('UPDATE CLIENTS SET name = :name, born_at = :bornDate, cpf = :cpf, cnpj = :cnpj, nat_registration = :nat where id = :id');

            if($stmt->execute([
                'name' => $clientObj['name'],
                'bornDate' => $clientObj['bornDate'],
                'cpf' => $clientObj['cpf'], 
                'cnpj' => $clientObj['cnpj'], 
                'nat' => $nat, 
                'id' => $clientObj['id']
            ])) {
                header('Location: ../client/index');
            } else {
                echo 'Não foi possível atualizar o registro!';
            }
        } else {
            $stmt = $pdo->prepare('INSERT INTO CLIENTS (name, inserted_at, cpf, cnpj, born_at, age, nat_registration) VALUES (:name, :nowDateTime , :cpf, :cnpj, :bornDate, :age, :nat)');

            if($stmt->execute([
                'name' => $clientObj['name'],
                'nowDateTime' => $now,
                'cpf' => $clientObj['cpf'], 
                'cnpj' => $clientObj['cnpj'],
                'bornDate' => $bornDate,
                'age' => $age,
                'nat' => $nat
            ])) {
                header('Location: ../client/index');
            } else {
                echo 'Não foi possível inserir o registro!';
            }
        }
    }
}
?>