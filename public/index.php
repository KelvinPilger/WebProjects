<?php 

require __DIR__ . '/../vendor/autoload.php';
use core\Controller;

try{
    $controller = new Controller;
    $controller = $controller->load();
    var_dump($controller);
} catch (\Exception $e) {
    ($e->getMessage());
}

?>