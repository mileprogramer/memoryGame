<?php

class Route{

    public function __construct() {
        
        $this->routes = [];

    }


    public function get(string $path, string $controller, $params = []){

        $this->routes[] = [

            "uri" => $path,
            "controller" => $controller,
            "method" => "GET",
            "params" => $params
        ];
    }

    public function post(string $path, string $controller){

        $this->routes[] = [

            "uri" => $path,
            "controller" => $controller,
            "method" => "POST"

        ];
    }

    public function run(){

        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = str_replace("memoryGame/backend/", "", $path);
        $path = str_replace("memoryGame/api/", "", $path);
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {

            if ($route['uri'] === $path && $route['method'] === $method) {

                $controller = $route['controller'];
                require_once $controller;
                return;
            }
        }
        http_response_code(404);
        echo "404 Not Found";
    }

}







?>