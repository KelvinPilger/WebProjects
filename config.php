<?php 

use Dotenv\Dotenv;

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

return [
    'db' => [
        'host'    => $_ENV['DB_HOST'] ?? 'localhost',
        'dbname'  => $_ENV['DB_NAME'] ?? '',
        'user'    => $_ENV['DB_USER'] ?? 'root',
        'pass'    => $_ENV['DB_PASS'] ?? '',
        'charset' => $_ENV['DB_CHARSET'] ?? 'utf8mb4',
    ],
    'base_url' => $_ENV['BASE_URL'] ?? 'http://localhost'
];

?>