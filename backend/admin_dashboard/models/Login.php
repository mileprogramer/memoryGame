<?php 

class Login extends Auth_Service{

    public function __construct($user_data){

        parent::__construct();

        $this->user_data = $user_data;
        
    }

    function try_login(array $rules_to_validate = []) : bool{

        if(!$this->is_input_data_empty($this->user_data, $rules_to_validate)){
            $this->status = 403;
            $this->output = "Enter you login data";
            return false;
        }

        $is_email_username = ($this->is_email_username($this->user_data["email_or_username"]))? "email": "username";

        if($this->user_exist($is_email_username, $this->user_data)){

            if($this->is_true_password($this->user_data["password"], $is_email_username)){
                $this->status = 200;
                $this->output = "Successfully logged";

                $this->login();
                return true;
            }
            else{
                $this->status = 401;
                $this->output = "Wrong password";
                return false;
            }

        }else{
            
            $this->status = 404;
            $this->output = "There is not such a user";
            return false;
        }
    }

    protected function is_true_password(string $password, string $is_email_username) : bool{

        $sql = "SELECT * FROM user WHERE $is_email_username = :email_or_username AND password = :password_user";
        $params = [":email_or_username" => $this->user_data["email_or_username"], ":password_user"=>$password]; 
        
        $query = new Query_Builder($this->db, $sql, $params);
        $user = $query->select();

        if(empty($user)) return false;

        $this->user = $user;
        return true;

    }

    private function login(){

        (is_set_session())? false : session_start();

        $user = new User($this->user);
        $_SESSION["user"] = $user->username;
    }
}
?>