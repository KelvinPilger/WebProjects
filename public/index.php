<?php 

require __DIR__ . '/../vendor/autoload.php';

use core\Controller;
use core\Method;
use core\Parameters;
use app\Controllers\Main\ClientController;


$config = include __DIR__ . '/../config.php';

define('BASE_URL', $config['base_url']);


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