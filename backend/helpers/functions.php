<?php

function dd($what_to_print){

    echo("<pre>");
    var_dump($what_to_print);
    echo("</pre>");
    die();
}

function dd_more(array $args){

    for($i = 0; $i<count($args); $i++){
        echo("<pre>");
        var_dump($args[$i]);
        echo("</pre>");
    }

}


function is_set_session() :bool{
    
    return (session_status() === PHP_SESSION_NONE)? false : true;
}

function is_user_logged() : bool {

    if(isset($_SESSION["user"]) && !empty($_SESSION["user"])){

        $auth = new Auth_Service($_SESSION["user"]);
        if($auth->try_login() === true) return true;

    }
    return false;
}


function is_array_empty(array $assoc_array) : bool {

    foreach ($assoc_array as $value) {
        if (!isset($value) || empty($value)) {
            return true;
        }
    }
    return false;

}




?>