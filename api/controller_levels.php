<?php 

function check_data($data){
    $right_num_of_pictures = ($data->num_rows * $data->num_columns) / 2;
    if(count($data->images) !== $right_num_of_pictures){
        
        http_response_code(404);
        die();
    }

}

function render_images_path($images_array) :array{
    $images = [];
    for($i = 0; $i<count($images_array); $i++){
        $images[] = path_for_pictures."".$images_array[$i]["image_path"];
    }
    return $images;
}


check_data($route["params"]);
$array =  [
    "num_rows"=>  $route["params"]->num_rows,
    "num_columns"=>  $route["params"]->num_columns,
    "time_to_solve"=>  $route["params"]->time_to_solve,
    "unit"=>  $route["params"]->unit,
    "card_size"=>  $route["params"]->card_size,
    "images"=>  render_images_path($route["params"]->images),
];
echo(json_encode($array));


?>