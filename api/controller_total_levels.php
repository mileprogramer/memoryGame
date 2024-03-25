<?php 

function check_data($data){

    return count($data);

}


$array =  [
    "total_levels" => check_data($route["params"])
];
echo(json_encode($array));


?>