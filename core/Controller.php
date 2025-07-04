<?php 

namespace core;

use app\classes\Uri;
use app\exceptions\ControllerNotExistException;

class Controller {

    private $uri;
    private $controller;
    private $namespace;
    private $folders = [
        'app\controllers\main',
        'app\controllers\admin'
    ];

    public function __construct() {
        $this->uri = Uri::uri();
    }

    public function load() {
        if($this->isHome()) {
            return $this->controllerHome();
        }
        return $this->controllerNotHome();
    }

    private function controllerHome() {
        if(!$this->controllerExist('HomeController')) {
            throw new ControllerNotExistException("Error Processing Request");
        }

        return $this->instantiateController();
    }

    private function instantiateController() {
        $controller = $this->namespace.'\\'.$this->controller;
        return new $controller;
    }

    private function controllerExist($controller) {
        $controllerExist = false;

        foreach ($this->folders as $folder) {
            if(class_exists($folder.'\\'.$controller)){
                $controllerExist = true;
                $this->namespace = $folder;
                $this->controller = $controller;
            }
        }

        return $controllerExist;
    }


    private function controllerNotHome() {
        
            $controller = $this->getControllerNotHome();

            if(!$this->controllerExist($controller)) {
            throw new ControllerNotExistException("O controller repassado não é existente. {$controller}");
            }

        return $this->instantiateController();
    }

    private function getControllerNotHome() {
        
        $segs = array_values(array_filter(
            explode('/', $this->uri),
            fn($s) => $s !== '' && $s !== 'index.php'
        ));

        if(isset($segs[0])) {
            return ucfirst($segs[0]) . 'Controller';
        }

        return ucfirst(ltrim($this->uri, '/')) . 'Controller';
    }

    public function isHome() {
        return ($this->uri == '/');
    }

    protected function renderView(string $view, array $params = []) {
        extract($params, EXTR_SKIP);

        ob_start();
        require __DIR__ . '/../app/views/' . $view . '.php';
        $content = ob_get_clean();

        require __DIR__ . '/../app/views/layout.php';
    }
}

abstract class ControllerMethods {
    abstract public function index();
    abstract public function create();
    abstract public function show();
    abstract public function remove();
    abstract public function store();
}

?>