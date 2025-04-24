<?php
namespace App\Database;

class Connection {
    private static $connection = null;
    
    public static function openConn() {
        if (self::$connection === null) {
            // prefixe com a barra para usar a classe global mysqli
            self::$connection = new \mysqli(
                "localhost",
                "root",
                "",
                "db_servfacil",
                3306
            );
            
            if (self::$connection->connect_error) {
                die("Erro na conexão: " . self::$connection->connect_error);
            }
        }
        return self::$connection;
    }
}
?>