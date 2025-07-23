<?php 

namespace App\Models;

use core\Database;
use PDO;
use DateTime;

date_default_timezone_set('America/Sao_Paulo');

class ServiceOrderItems {
    public $id;
    public string $product_id;
    public string $product_name;
    public string $product_application;
    public float $unitary_value;
    public float $total_value;
    public float $quantity;
    public float $discount;
    public float $addition;
    public int $confirmal_status;
    public int $user_id;
    public string $user_person;
}



?>