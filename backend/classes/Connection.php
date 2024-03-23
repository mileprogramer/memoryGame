<?php
class Connection{
    protected $db = null;

    public function __construct(){
        $config = connection_to_db;
        try{
            $this->db = new PDO("mysql:host={$config["HOSTNAME"]};dbname={$config["DBNAME"]}", $config["USERNAME"], $config["PASSWORD"]);
        }
        catch(PDOException $eror){
            die($eror->getMessage());
        }

    }

    public function close_connection(){

        $this->db = null;

    }

}


?>