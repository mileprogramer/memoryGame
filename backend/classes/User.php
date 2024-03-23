<?php 

class User{

    function __construct($user_data){

        $this->email = $user_data->email;
        $this->username = $user_data->username;
        $this->role = $user_data->role;

    }
}


?>