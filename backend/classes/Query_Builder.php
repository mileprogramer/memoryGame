<?php 

class Query_Builder{

    function __construct($db ,string $sql, array $params = []){

        $this->db = $db;
        $this->sql = $sql;
        $this->params = $params;

    }

    public function select() {

        $query = $this->db->prepare($this->sql);
        $execute = $this->execute($query);
        $result = null;

        if ($execute) {
            $res = $this->is_more_records($query);
            if(count($res) > 1){
                return $this->fetch_all_data($res, $query);
            }
            else{
                return $res[0];
            }
        }
    }

    private function execute($query) :bool{

        try{
            if(!empty($this->params)){
                return $query->execute($this->params);
            }
            return $query->execute();
        }
        catch(PDOException $e){
            
            die("PDOException: ".$e->getMessage());
            return false;
        }
    }

    public function put(){

        $query = $this->db->prepare($this->sql);
        return $this->execute($query);

    }

    private function fetch_all_data($result, $query){

        while(true){
            $row = $query->fetch(PDO::FETCH_OBJ);
            if($row !== false){

                $result[] = $row;
            }
            else{
                break;
            }

        }
        return $result;
    }
    
    private function is_more_records($query){
        $first_row = $query->fetch(PDO::FETCH_OBJ);
        $secondRow = $query->fetch(PDO::FETCH_OBJ);

        return ($secondRow === false)? [$first_row] : [$first_row, $secondRow];
    }
}
?>