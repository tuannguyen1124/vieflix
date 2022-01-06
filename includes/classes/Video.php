<?php
class Video{
    private $con, $data, $entity;
    public function __construct($con, $input) {
        $this->con = $con;
        
        if(is_array($input)){
            $this->data = $input;
        }
        else{
            $query = $this->con->prepare("SELECT * FROM entities WHERE id=:id");
            $query->bindValue(':id', $input);
            $query->execute();

            $this->data = $query->fetch(PDO::FETCH_ASSOC);


            
        }
        $this->entity = new Entity($con, $this->data["entityId"]);
    }
    public function getId(){
        return $this->data["id"];
    }
    public function getTitle(){
        return $this->data["title"];
    }
    public function getDescription(){
        return $this->data["description"];
    
    }
    public function getFilePath(){
        return $this->data["filePath"];
    }
    public function getThumbnail(){
        return $this->entity->getThumbnail();
    }
    public function getEpisodeNumber(){
        return $this->data["episode"];
    }
}


?>