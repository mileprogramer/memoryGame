<?php 

// route 
require_once "../backend/classes/Route.php";
require_once "../backend/classes/Connection.php";
require_once "../backend/helpers/functions.php";

$levels = require_once "./levels.php";
$router = new Route();

$num_level = 1;

for($i = 0; $i<$levels["number_of_levels"]; $i++){

    $router->get("/{$num_level}", "controller.php", $levels["levels"][$i]);
    $num_level++;

}

$router->run();
?>