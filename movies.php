<?php
require_once("includes/header.php");


$preview = new PreviewProvider($con, $userLoggedIn);
echo $preview->createMoviePreviewVideo(null);


 $container = new CategoryContainers($con, $userLoggedIn);
 echo $container->showAllMovies();


?>