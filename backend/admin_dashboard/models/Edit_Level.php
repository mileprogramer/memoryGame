<?php

class Edit_Level extends Level_Service{

    function __construct($extensions, $level_data){

        parent::__construct();
        $this->extensions = $extensions;
        $this->level_data = $level_data;
        $this->uploaded_files_json = null;
    }

    public function edit_level(){

        $this->what_is_changed();
        if($this->level_data["pictures"] !== null){
            $this->process_upload($this->extensions, $this->level_data["pictures"]);
            $this->store_on_server($this->level_data["pictures"], "levels_images");
            $this->level_data["pictures"] = $this->uploaded_files_json;
        }

        $this->prepare_data();

        $query = new Query_Builder($this->db, $this->sql, $this->params);
        $result = $query->put();
    
        if($result === false){
            echo("Editing level failed");
            die();
        }
        else{
            is_set_session()? false : session_start();
            $_SESSION["msg"] = "Successfully edited new level!!! <button><a href= 'edit_level?id_level={$this->level_data["id"]}'>View level</a></button>";
            header("Location: /memoryGame/backend?view=success");
        }
    }

    
    private function what_is_changed(){

        $level_now = $this->get_level(intval($this->level_data["id"]));
        $changes = $this->compare_before_after($level_now, $this->level_data);
        if($changes === false){
            (is_set_session())? false : session_start();
            $_SESSION["mistake"] = "You did not change anything";
            header("Location: " . $_SERVER['PHP_SELF']."?id_level=".$level_now->id_level);
            die();
        }
        
    }
    
    private function get_level($id){        
        $level = new Level_Provider();
        return $level->get_level_by_id($id);
    }
    
    private function compare_before_after($level_now, array $level_changed){
        
        // we look for = "time_to_solve, unit, pictures";
        
        if($level_now->time_to_solve === $level_changed["time_to_solve"] && $level_now->unit === $level_changed["unit"] && $level_changed["replace_images_ids"]===null){
            return false;
        }
        return true;
    }
    
    private function prepare_data(){

        $this->sql = "CALL edit_level(:id_level ,:images , :images_to_edit_ids ,:time_to_solve, :unit)";
        $this->params = [
            
            ":id_level" => $this->level_data["id"],
            ":images"=> $this->uploaded_files_json ?? null,
            ":images_to_edit_ids"=> json_encode($this->level_data["replace_images_ids"]) ?? null,
            ":time_to_solve"=> intval($this->level_data["time_to_solve"]) ?? null,
            ":unit"=> $this->level_data["unit"] ?? null
        
        ];
    }
}




?>