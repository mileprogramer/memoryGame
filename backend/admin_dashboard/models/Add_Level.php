<?php 

class Add_Level extends Level_Service{

    function __construct($level_data){

        parent::__construct();
        $this->level_data = $level_data;
    }

    public function process($folder_to_store, $extesions) :bool{
        if($this->process_upload($extesions, $this->level_data["pictures"]) === false){
            $allowed_files_text = implode(",", $extensions);
            (is_set_session())? false : session_start();
            $_SESSION["mistake"] = "Allowed files are with extensions ".$allowed_files_text;
            return false;
        }

        $this->store_on_server($this->level_data["pictures"], $folder_to_store);
        $this->insert_level();

        return true;
    }

    private function insert_level() :void{

        $this->prepare_data();
        $query = new Query_Builder($this->db, $this->sql, $this->params);
        $result = $query->put();
    
        if($result === false){
            echo("Inserting new level failed");
            die();
        }
        else{
            is_set_session()? false : session_start();
            $_SESSION["msg"] = "Successfully added new level!!! <button><a href= 'edit_level?id_level={$this->level_data["id"]}'>View level</a></button>";
            header("Location: /memoryGame/backend?view=success");
        }
    
    }

    private function prepare_data(){

        $this->sql = "CALL insert_level(:rows, :columns, :images , :time_to_solve, :unit, :user)";
        $this->params = [
    
            ":rows"=> intval($this->level_data["rows"]),
            ":columns"=> intval($this->level_data["columns"]),
            ":images"=> $this->uploaded_files_json,
            ":time_to_solve"=> intval($this->level_data["time_to_solve"]),
            ":unit"=> $this->level_data["unit"],
            ":user" => $_SESSION["user"]
        
        ];
    }
}



?>