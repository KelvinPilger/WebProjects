<?php 

namespace core;
use app\classes\Uri;

class Parameters {

    private $uri;

    public function __construct()
    {
        
        $this->uri = Uri::uri();
    }

    public function load(){

        $params = $this->getParameter();
        return $params ?? (object)[
            'parameter' => null,
            'next'      => null,
        ];

    }

    public function getParameter() {

        $segments = array_values(array_filter(explode('/', $this->uri)));

        if (count($segments) > 2) {
            $current = strip_tags($segments[2]);
            $nextRaw = $this->getNextParameter($segments, 2);
            $next    = $nextRaw !== null ? strip_tags($nextRaw) : null;

            return (object)[
                'parameter' => $current,
                'next'      => $next,
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