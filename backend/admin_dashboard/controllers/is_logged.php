<?php 

require_once "./helpers/functions.php";

is_set_session()? false : session_start();

if(isset($_SESSION["user"]) && !empty($_SESSION["user"])){

    require_once "admin_dashboard/controllers/admin.php";

}
else{

    require_once "./controllers/login.php";

}


?>