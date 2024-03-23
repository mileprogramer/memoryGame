<?php 

class Level_Provider extends Connection{

    function __construct(){
        parent::__construct();
    }

    function get_level_by_id($id){
        $sql = "CALL select_by_id_level($id);";
        $query = new Query_Builder($this->db, $sql);
        return $this->put_chunks_together($query->select());
    }

    function get_all_levels() :array{

        $sql = "CALL select_all_levels();";
        $query = new Query_Builder($this->db, $sql);
        return $this->put_chunks_together($query->select());
    }

    private function put_chunks_together($data){

        $return_array = [];

        for($i = 0; $i<count($data); $i++){
            
            if($this->exist_level($return_array, $data[$i]->id_level)){
                foreach ($return_array as &$level) {

                    if ($level->id_level === $data[$i]->id_level) {
                        $level->images[] = [
                            "id_image" => $data[$i]->id_image,
                            "image_path" => $data[$i]->image_path,
                        ];
                        break;
                    }
                }

            }else{

                $one_object = new stdClass();
                $one_object->id_level = $data[$i]->id_level;
                $one_object->num_rows = $data[$i]->num_rows;
                $one_object->num_columns = $data[$i]->num_columns;
                $one_object->time_to_solve = $data[$i]->time_to_solve;
                $one_object->unit = $data[$i]->unit;
                $one_object->images = [
                    ["id_image"=>$data[$i]->id_image,
                    "image_path"=>$data[$i]->image_path]
                ];
                $return_array[] = $one_object;

            }
        }
        return (isset($return_array[1]))? $return_array : $return_array[0];
    }

    private function exist_level($array, $val) :bool{

        if (empty($array)) return false;

        foreach ($array as $level) {
            if ($level->id_level === $val) {
                return true;
            }
        }
        return false;
    }
}




?>