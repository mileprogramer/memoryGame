<?php

class Route{

    public function __construct() {
        
        $this->routes = [];

    }


    public function get(string $path, string $controller){

        $this->routes[] = [

            "uri" => $path,
            "controller" => $controller,
            "method" => "GET"

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
        $method = $_SERVER['REQUEST_METHOD'];

        
/*         echo("<pre>");
        var_dump($path);
        echo("</pre>"); */


        foreach ($this->routes as $route) {

/*             echo("<pre>");
            var_dump($route);
            echo("</pre>"); */

            if ($route['uri'] === $path && $route['method'] === $method) {
                $controller = $route['controller'];
                require_once $controller;
                return;
            }
        }

        http_response_code(404);
        /* echo $_SERVER['REQUEST_URI']."<br>"; */
        echo "404 Not Found";
    }

}







?>