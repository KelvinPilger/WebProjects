<?php 

namespace Core;

use PDO;
use PDOException;

class Database {
    private static $instance = null;

    private function __construct()
    {

    }
        public static function getConnection():PDO {

            if(self::$instance === null) {
            $config = include __DIR__ . '/../config.php';
            $db = $config['db'];

            $dsn = sprintf(
                'mysql:host=%s;dbname=%s;charset=%s',
                $db['host'],
                $db['dbname'],
                $db['charset']
            );

            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_PERSISTENT         => false,
            ];

            self::$instance = new PDO($dsn, $db['user'], $db['pass'], $options);
        }
        return self::$instance;
    }
}
?>