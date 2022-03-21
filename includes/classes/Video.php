<?php
class Video{
    private $con, $data, $entity;
    public function __construct($con, $input) {
        $this->con = $con;
        
        if(is_array($input)){
            $this->data = $input;
        }
        else{
            $query = $this->con->prepare("SELECT * FROM videos WHERE id=:id");
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
    public function getSeasonNumber(){
        return $this->data["season"];
    }
    public function getEntityId(){
        return $this->data["entityId"];
    }

    public function incrementViews(){
        $query = $this->con->prepare("UPDATE videos SET views=views+1 WHERE id=:id");
        $query->bindValue(":id",$this->getId());
        $query->execute();
    }

    public function getSeasonAndEpisode(){
        if($this->isMovie()){
            return;
        }
        $season = $this->getSeasonNumber();
        $episode = $this->getEpisodeNumber();

        return "Season $season, Episode $episode";
    }
    
    public function isMovie(){
        return $this->data["isMovie"] == 1;
    }

    public function isInProgress($username){
        $query = $this->con->prepare("SELECT * FROM videoProgress 
                                      WHERE videoId=:videoId AND username=:username
                                      AND finished=0");

        $query->bindValue(":videoId", $this->getId());
        $query->bindValue(":username", $username);
        $query->execute();

        return $query->rowCount() != 0;

        
    }
}


?>