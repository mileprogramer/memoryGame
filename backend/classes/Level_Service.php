<?php 

class Level_Service extends Connection{

    function __construct(){

        parent::__construct();
        $this->uploaded_files_json = null;
        $this->processed = false;
        $this->upload = false;
    }


    public function process_upload($extensions, $files):bool{

        $this->upload = new Upload($extensions, $files);
        if(!$this->upload->is_right_extension()) return false;
        $this->processed = true;
        return true;
    }

    protected function store_on_server($files, $folder) :bool{
        if($this->processed === false){
            return false;
            die();
        }
        $this->upload->store_on_server($files, "$folder");
        $this->uploaded_files_json = json_encode($this->upload->uploaded_files);
        return true;
    }   
}
?>