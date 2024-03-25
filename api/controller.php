<?php 


$array =  [
    "num_rows"=>  $route["params"]->num_rows,
    "num_columns"=>  $route["params"]->num_columns,
    "time_to_solve"=>  $route["params"]->time_to_solve,
    "unit"=>  $route["params"]->unit,
    "images"=>  $route["params"]->images,
];
echo(json_encode($array));


?>