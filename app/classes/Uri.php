<?php 

namespace app\classes;

class Uri {
    public static function uri()
    {
        $requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $scriptName  = str_replace('\\', '/', BASE_URL);

        if (strpos($requestPath, $scriptName) === 0) {
            $uri = substr($requestPath, strlen($scriptName));
        } else {
            $baseDir = dirname($scriptName);
            if (strpos($requestPath, $baseDir) === 0) {
                $uri = substr($requestPath, strlen($baseDir));
            } else {
                $uri = $requestPath;
            }
        }

        return '/' . trim($uri, '/');
    }
}

?>