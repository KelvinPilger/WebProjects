<?php 

namespace core;
use app\classes\Uri;

class Parameters {

    private $uri;

    public function __construct()
    {
        
        $this->uri = Uri::uri();
    }

    public function load(): \stdClass {

        $params = $this->getParameter();

        if($params === null) {
            return $params ?? (object)[
                'parameter' => null,
                'next'      => null,
            ];
        }

        return $params;
    }

    public function getParameter() {

         $cleanPath = trim(preg_replace('#/+#','/',$this->uri), '/');


         $segments = explode('/', $cleanPath);
 
         if (count($segments) >= 3) {
             return (object)[
                 'parameter' => strip_tags($segments[2]),
                 'next'      => isset($segments[3]) 
                                   ? strip_tags($segments[3]) 
                                   : null,
             ];
         }
 
         return null;
    }

    public function getNextParameter($segments, $index) {

        if (isset($segments[$index + 1])) {
            return $segments[$index + 1];
        }

        return $segments[$index] ?? null;

    }
}
?>