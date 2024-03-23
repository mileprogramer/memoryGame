<?php 

$possible_views = [
    "success" => "views/success.php"
];

function render_view($possible_views){

    if($possible_views === null) return "";

    for($i = 0; $i< count($possible_views); $i++){


        if(isset($_GET["view"])){
            require_once $possible_views[$_GET["view"]];
            break;
        }
        
    }
}

require_once "views/level/admin.view.php";




?>