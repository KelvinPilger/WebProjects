<?php 

require __DIR__ . '/../vendor/autoload.php';

use core\Controller;
use core\Method;
use core\Parameters;

try{

    $controller = new Controller;
    $controller = $controller->load();

    $method = new Method;
    $method = $method->load($controller);

    $parameters = new Parameters;
    $parameters = $parameters->load();

    $controller->$method($parameters);

} catch (\Exception $e) {

    echo '<pre>Erro: '.$e->getMessage().'</pre>';
    exit;
}

?>