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
        $clientObj = json_decode($client, true);
        var_dump($clientObj);

        if($clientObj['cpf'] !== null) {
            $nat = 'F';
        } else {
            $nat = 'J';
        }
        
        $bornDate = DateTime::createFromFormat('d/m/Y', $clientObj['bornDate']);
        $now = new DateTime();
        $age = $bornDate ? $bornDate->diff($now)->y : null;

        $pdo = Database::getConnection();

        if($clientObj['action'] === 'edit') {
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
        } else {
            $stmt = $pdo->prepare('INSERT INTO CLIENTS (name, inserted_at, cpf, cnpj, born_at, age, nat_registration) VALUES (:name, :nowDateTime , :bornDate, :cpf, :cnpj, :age, :nat)');

            if($stmt->execute([
                'name' => $clientObj['name'],
                'nowDateTime' => $nowDateTime,
                'bornDate' => $clientObj['bornDate'],
                'cpf' => $clientObj['cpf'], 
                'cnpj' => $clientObj['cnpj'], 
                'age' => $age,
                'nat' => $nat, 'id' => $clientObj['id']
            ])) {
                header('Location: ../client/index');
            } else {
                echo 'Não foi possível salvar o registro';
            }
        }
    }
?>
<!-- 
  `id` int(11) not null auto_increment,
  `name` varchar(50) not null,
  `inserted_at` datetime not null,
  `cpf` varchar(14) default null,
  `cnpj` varchar(17) default null,
  `born_at` date default null,
  `age` smallint(6) default null,
  `email` varchar(75) default null,
  `nat_registration` char(1) not null, -->

<!-- // string(114) "{"name":"gabriela mendes","borndate":"1996-03-08","cpf":"67890123467","cnpj":"","ctt_type":"celular","contact":""}" -->