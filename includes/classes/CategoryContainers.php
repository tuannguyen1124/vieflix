<?php

class CategoryContainers
{

    private $con, $username;
    public function __construct($con, $username)
    {
        $this->con = $con;
        $this->username = $username;
    }

    public function showAllCategories() {
        $query = $this->con->prepare("SELECT * FROM categories");
        $query->execute();

        $html = "<div class='previewCategories'>";
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $html .= $this->getCategoryHtml($row, null, true, true);
        }

        return $html . "</div>";
    }

    private function getCategoryHtml($data, $title, $tvShows, $movies) {

        $categoryId = $data["id"];
        $title = $title == null ? $data["name"] : $title; 


        if($tvShows && $movies) {
        $entities = EntityProvider::getEntities($this->con, $categoryId, 10);
        }
        else if($tvShows) {
            
        }
        else {
            
        }

        if(sizeof($entities) == 0){
            return;
        }
        
        $entitiesHtml = "";
        $previewProvider = new PreviewProvider($this->con, $this->username);
        foreach($entities as $entity){
            $entitiesHtml .= $previewProvider->createEntityPreviewSquare($entity);
        }
        return "<div class='category'> 
                 <a href='category.php?id=$categoryId'>
                 <h3>$title</h3>
                 </a>
                 <div class='entities'>
                    $entitiesHtml
                 </div>        
        
             </div>";
        
        return $entitiesHtml . "<br>";
        
    }
}