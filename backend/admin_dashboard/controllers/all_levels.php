<?php 


require_once "helpers/functions.php";
require_once "config/config.php";
require_once "classes/Connection.php";
require_once "classes/Query_Builder.php";
require_once "classes/Level_Provider.php";


$instace = new Level_Provider();
$all_levels = $instace->get_all_levels();

require_once "views/level/all_levels.view.php";


?>