<?php
$mysqli = new mysqli("localhost", "root", '', "db_servfacil", 3306);
if ($mysqli->connect_error) {
    die("Erro na conexão: " . $mysqli->connect_error);
}
?>