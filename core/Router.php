<?php

class Router {
    private $routes = [];
    //take an array of routes and store it
    function setRoutes(Array $routes) {
        $this->routes = $routes;
    }
    //decide which file to serve again URL
    function getFilename(string $url) {
        foreach($this->routes as $route => $file) {
            if(strpos($url, $route) !== false){
            return $file;
            }
        }
    }
}

?>