<?php 

namespace App\Models;

use Core\Database;
use PDO;
use DateTime;

date_default_timezone_set('America/Sao_Paulo');

class ServiceOrder {
    public $id;
    public $client_id;
    public $client_name;
    public float $items_value;
    public float $services_value;
    public float $total_value;
    public $object_id;
    public $object_name;
    public $observation;
    public $service_report;
    public $solicitation;
    public $created_at;
    public $forecast_date;
    public $situation_id;
    public $situation_description;

    public function findAll(): array {
        $pdo = Database::getConnection();
        $stmt = $pdo->query("SELECT * FROM service_order;");
        return $stmt->fetchAll();
    }

    public function countAll(): int {
        $pdo = Database::getConnection();
        $stmt = $pdo->query("SELECT COUNT(*) as os FROM service_order;");
        return (int) $stmt->fetch(PDO::FETCH_ASSOC)['os'];
    }

    public function getPage(int $offset, int $limit): array {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("
            SELECT * FROM service_order
            ORDER BY id
            LIMIT :limit OFFSET :offset
        ;");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}
?>