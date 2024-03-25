<?php 

// route
require_once "./classes/Route.php";
require_once "./helpers/functions.php";
require_once "./config/config.php";


$router = new Route();

$router->get("/", "admin_dashboard/controllers/is_logged.php");
$router->get("/login", "admin_dashboard/controllers/login.php");
$router->get("/logout", "admin_dashboard/controllers/logout.php");
$router->get("/add_level", "admin_dashboard/controllers/add_level.php");
$router->get("/edit_level", "admin_dashboard/controllers/edit_level.php");

$router->post("/edit_level", "admin_dashboard/controllers/edit_level.php");
$router->post("/login", "admin_dashboard/controllers/login.php");
$router->post("/add_level", "admin_dashboard/controllers/add_level.php");

$router->run();

?>