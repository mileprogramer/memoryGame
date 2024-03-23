<?php

class Upload{

    function __construct($accepted_extesions, $files){
        
        $this->accepted_extesions = $accepted_extesions;
        $this->files = $files;
        $this->uploaded_files = [];
    }

    function is_right_extension(){

        foreach ($this->files['name'] as $fileName) {

            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

            if (array_search($fileExtension, $this->accepted_extesions) === false) {
                return false;
            }

        }
        return true;
    }

    public function store_on_server(array $files, string $folder_to_store){
        $document_root = $_SERVER['DOCUMENT_ROOT'];
        $absolute_path = $document_root . "/" . root_folder;

        for($i = 0; $i<count($files["tmp_name"]); $i++){
            
            $name_file = $files["name"][$i];
            $path_file = $absolute_path."/".$folder_to_store."/".$name_file;
            
            move_uploaded_file($files["tmp_name"][$i], $path_file);
            $this->uploaded_files[] = $folder_to_store."/".$name_file;
        }

    }

}
?>