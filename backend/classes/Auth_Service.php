<?php

class Auth_Service extends Connection{

    public function __construct(){

        parent::__construct();

        $this-> status = null;
        $this-> output = null;
        
    }

    protected function user_exist(string $is_email_username, array $user_data) : bool {
        
        $sql = "SELECT * FROM user WHERE $is_email_username = :email_or_username";
        $params = [":email_or_username" => $user_data["email_or_username"]]; 

        $query = new Query_Builder($this->db, $sql, $params);
        
        if(empty($query->select()))return false;
        return true;

    }

    protected function is_email_username(string $email_or_username) :bool{

        return str_contains($email_or_username, "@");

    }

    protected function checkStringLength(array $assoc_array) : bool {
        
        foreach($assoc_array as $key=>$value){

            if(!strlen($value) >= 5) return false;
        }
        return true;
    }

    protected function is_input_data_empty($assoc_array, $rules){

        if(empty($rules)){
            if(!is_array_empty($assoc_array)){
                $result = $this->checkStringLength($assoc_array);
                return $result;
            }
        }
        // logic if user wants to validate with some addtional condition
        // To be added ...
        return false;
    }
}
?>