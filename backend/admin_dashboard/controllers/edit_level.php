<?php 

require_once "helpers/functions.php"; 
require_once "config/config.php"; 
require_once "classes/Upload.php";
require_once "classes/Connection.php";
require_once "classes/Query_Builder.php";
require_once "classes/Level_Service.php";
require_once "classes/Level_Provider.php";
require_once "admin_dashboard/models/Edit_Level.php";

if($_SERVER["REQUEST_METHOD"] === "GET"){
    handle_get_method();
}
elseif($_SERVER["REQUEST_METHOD"] === "POST"){
    handle_post_method();
}

function handle_get_method(){

    if(isset($_GET["id_level"])){
        // show admin form to change level 
        $instace = new Level_Provider();
        $level = $instace->get_level_by_id(intval($_GET["id_level"]));

        require_once "views/level/edit_level.view.php";
    
    }
    else{
        // show admin all levels
        require_once "admin_dashboard/controllers/all_levels.php";
        
    }
}

function handle_post_method(){
    

    if(is_array_empty($_POST)){
        header("Location: /?success=true");
        die();
    }

    $user_input = [
        
        "id" => $_POST["id_level"],
        "time_to_solve"=> intval($_POST["time_to_solve"]),
        "pictures" => $_FILES["images"],
        "unit" => $_POST["unit"],
        "replace_images_ids" => $_POST["checkboxes"] ?? null
    ];

    $extesions = ["png", "jpeg", "jpg", "webp", "avif"];

    $instace = new Edit_Level($extesions, $user_input);
    $instace->edit_level();
}
?>