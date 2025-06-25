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

    public function save($product): bool {
        $saved = true;
        // Lógica da parte de inserção

        if($product['id'] == null) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('INSERT INTO products (product_name, product_application, gtin_barcode, ncm, cest, quantity, cost_price, sell_price, profit_percentual, cfop, csosn_cst, origin) VALUES (:name, :application, :gtin, :ncm, :cest, :quantity, :cost, :sell, :profit, :cfop, :csosn, :origin);');

        if($stmt->execute([
            'name' => $product['product_name'],
            'application' => $product['product_application'],
            'gtin' => $product['gtin_barcode'] ?? null,
            'ncm' => $product['ncm'],
            'cest' => $product['cest'] ?? null,
            'quantity' => $product['quantity'],
            'cost' => $product['cost_price'],
            'sell' => $product['sell_price'],
            'profit' => $product['profit_percentual'],
            'cfop' => $product['cfop'],
            'csosn' => $product['csosn_cst'],
            'origin' => $product['orgin']
        ])) {
            return $saved;
        } else {
            $saved = false;
            return $saved;
        };


        } else {
            // Lógica da parte de edição.
            return $saved;
        }
        return false;
    }
}
?>