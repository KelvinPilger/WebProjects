<?php

namespace App\Models;

use core\Database;
use PDO;
use DateTime;

date_default_timezone_set('America/Sao_Paulo');

class Product {
    public $id;
    public $product_name;
    public $gtin_barcode;
    public $ncm;
    public $cest;
    public float $quantity;
    public float $cost_price;
    public float $sell_price;
    public float $profit_percentual;
    public $cfop;
    public $csosn_cst;
    public $origin;

    public function findAll(): array {
        $pdo = Database::getConnection();
        $stmt = $pdo->query("SELECT * FROM products");
        return $stmt->fetchAll();
    }

    public function countAll(): int {
        $pdo = Database::getConnection();
        $stmt = $pdo->query("SELECT COUNT(*) AS prod FROM products");
        return (int) $stmt->fetch(PDO::FETCH_ASSOC)['prod'];
    }

    public function getPage(int $offset, int $limit): array
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("
            SELECT * FROM products
            ORDER BY id
            LIMIT :limit OFFSET :offset
        ");
        $stmt->bindValue(':limit',  $limit,  PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id): bool {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare('DELETE FROM products WHERE id = :id');

        return $stmt->execute(['id' => $id]) && $stmt->rowCount() > 0;
    }
}
?>