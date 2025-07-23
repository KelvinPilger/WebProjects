<?php 


namespace App\Models;

use core\Database;
use PDO;
use DateTime;

date_default_timezone_set('America/Sao_Paulo');

class Objects {
    public int $id;
    public string $object;
    public $created_at;
    public bool $active;
}


?>