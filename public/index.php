<?php 

require __DIR__ . '/../vendor/autoload.php';

use core\Controller;
use core\Method;
use core\Parameters;
use app\Controllers\Main\ClientController;

try{

    // ini_set('display_errors', 1);
    // error_reporting(E_ALL);

    $controller = (new Controller())->load();

    $method = (new Method())->load($controller);

    $params = (new Parameters())->load();

    $controller->{$method}($params);

} catch (\Exception $e) {

    echo '<pre>Erro: '.$e->getMessage().'</pre>';
    exit;
}

?>