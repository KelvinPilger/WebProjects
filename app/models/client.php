<?php

namespace App\Models;

use core\Database;
use PDO;
use DateTime;

date_default_timezone_set('America/Sao_Paulo');

class Client
{
    public $id;
    public $name;
    public $inserted_at;
    public $cpf;
    public $cnpj;
    public $born_at;
    public $age;
    public $email;
    public $nat_registration;

    public function findAll(): array
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->query("SELECT * FROM clients");
        return $stmt->fetchAll();
    }

    public function countAll(): int
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->query("SELECT COUNT(*) AS cnt FROM CLIENTS");
        return (int) $stmt->fetch(PDO::FETCH_ASSOC)['cnt'];
    }

    public function getPage(int $offset, int $limit): array
    {
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

    public function searchById($id): array
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('SELECT * FROM clients where id = :id');
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC) ?: null;

        return $row !== false
            ? $row
            : [];
    }

    public function delete($id): string
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('DELETE FROM clients WHERE id = :id');
        if ($stmt->execute(['id' => $id])) {
            return "Cliente excluído com sucesso!";
        } else {
            return "Não foi possível excluir o cliente!";
        }
    }

    public function edit($id): array
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('SELECT id, name, inserted_at, cpf, cnpj, born_at, age, email, nat_registration FROM clients WHERE id = :id');

        if (! $stmt->execute(['id' => $id])) {
            return [];
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: [];
    }

    public function save($client): string
    {
        $clientObj = json_decode($client, true);

        if ($clientObj['cpf'] !== null) {
            $nat = 'F';
        } else {
            $nat = 'J';
        }

        $bornDate = $clientObj['bornDate'];
        $age      = (new DateTime())->diff(new DateTime($clientObj['bornDate']))->y;
        $nowTs    = (new DateTime())->getTimestamp();

        $pdo = Database::getConnection();

        if ($clientObj['action'] == 'edit') {
            $stmt = $pdo->prepare(
                'UPDATE CLIENTS 
                SET name = :name,
                    born_at = :bornDate,
                    cpf = :cpf,
                    cnpj = :cnpj,
                    nat_registration = :nat
                WHERE id = :id'
            );

            if($stmt->execute([
                'name'     => $clientObj['name'],
                'bornDate' => $clientObj['bornDate'],
                'cpf'      => $clientObj['cpf'] ?? null,
                'cnpj'     => $clientObj['cnpj'] ?? null,
                'nat'      => $nat,
                'id'       => $clientObj['id']
            ])) {
            
            return "Cliente atualizado com sucesso!";
            };
        }

        $stmt = $pdo->prepare(
            'INSERT INTO CLIENTS (
                name, inserted_at, cpf, cnpj, born_at, age, nat_registration
            ) VALUES (
                :name, :nowDateTime, :cpf, :cnpj, :bornDate, :age, :nat
            )'
        );

        if($stmt->execute([
            'name'        => $clientObj['name'],
            'nowDateTime' => $nowTs,
            'cpf'         => $clientObj['cpf'] ?? null,
            'cnpj'        => $clientObj['cnpj'] ?? null,
            'bornDate'    => $bornDate,
            'age'         => $age,
            'nat'         => $nat
        ]));

        $clientId = $pdo->lastInsertId();
        $now = new DateTime();
        $stmtCtt = $pdo->prepare(
            'INSERT INTO CONTACTS (
                ctt_type, contact, person_id, created_at
            ) VALUES (
                :ctt_type, :contact, :person_id, :created_at
            )'
        );

        foreach ($clientObj['contacts'] as $ctt) {
            if($stmtCtt->execute([
                'ctt_type'   => $ctt['type'],
                'contact'    => $ctt['value'],
                'person_id'  => $clientId,
                'created_at' => $now->format('Y-m-d H:i:s')
            ]));
        }
        return "Cliente cadastrado com sucesso!";
    }
}
