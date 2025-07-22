<?php 

require __DIR__ . '/../vendor/autoload.php';

use core\Controller;
use core\Method;
use core\Parameters;
use app\Controllers\Main\ClientController;


define('BASE_URL', 'http://servfacil');


try{

    $controller = (new Controller())->load();

    $method = (new Method())->load($controller);

    $params = (new Parameters())->load();

    $controller->{$method}($params);

} catch (\Exception $e) {

    echo '<pre>Erro: '.$e->getMessage().'</pre>';
    exit;
}

?>