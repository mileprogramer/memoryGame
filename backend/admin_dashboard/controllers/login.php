<?php

// check is user logged 
// if yes than redirect to the admin page
// if not and then display login form 

require_once "config/config.php";
require_once "classes/Connection.php";
require_once "classes/Auth_Service.php";
require_once "classes/Query_Builder.php";
require_once "classes/User.php";
require_once "helpers/functions.php";
require_once "admin_dashboard/models/Login.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{

    // user submitted form
    $user_data = [
        "email_or_username"=> $_POST["email-username"],
        "password"=> $_POST["password"]
    ];

    $login = new Login($user_data);

    if ($login->try_login()) {
        header("Location: ./");
        exit();

    }

}
// Show login form
require_once "views/auth/login.view.php";


?>