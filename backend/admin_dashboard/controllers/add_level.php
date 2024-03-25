<?php

// validate data is there a empty input data
// Check is extesion of file good
// Move file in folder
// Query Builder (put level info in database)
// Output success or not

require_once "views/level/add_level.view.php";
require_once "helpers/functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{

    if(is_array_empty($_POST)){
        header("Location: ./add_level");
        die();
    }

    $user_input = [

        "columns"=> $_POST["columns"],
        "rows"=> $_POST["rows"],
        "time_to_solve"=> $_POST["time_to_solve"],
        "pictures" => $_FILES["pictures"],
        "unit" => $_POST["unit"]
    ];

    require_once "config/config.php"; 
    require_once "classes/Upload.php";
    require_once "classes/Connection.php";
    require_once "classes/Query_Builder.php";
    require_once "classes/Level_Service.php";
    require_once "admin_dashboard/models/Add_Level.php";

    $extesions = ["png", "jpeg", "jpg", "webp", "avif"];
    $add_level = new Add_Level($user_input);
    $folder_to_store = "levels_images";
    $wrong_files_redirect = "../controllers/admin.php?view=add_level";

    $result = $add_level->process($folder_to_store, $extesions);
    if(!$result){
        header("Location: $wrong_files_redirect");
        die();
    }
    else{
        var_dump("Sve je okej u elseeee");
        // "Uspesno dodat novi level"
    }
}
?>