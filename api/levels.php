<?php

require_once "../backend/config/config.php";
require_once "../backend/classes/Connection.php";
require_once "../backend/classes/Level_Provider.php";
require_once "../backend/classes/Query_Builder.php";

function get_levels() : array{

    $instace = new Level_Provider();
    $levels = $instace->get_all_levels();

    return [
        "number_of_levels"=> count($levels),
        "levels" => $levels
    ];
}

return get_levels();

?>