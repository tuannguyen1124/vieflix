<?php
$hideNav = true;
require_once("includes/header.php");

if(!isset($_GET["id"])){
    ErrorMessage::show("No ID passed into page");
}

$video = new Video($con, $_GET["id"]);
$video->incrementViews();
$upNextVideo = VideoProvider::getUpNextVideo($con, $video);

?>


<div class="watchContainer">
    <div class="videoControls watchNav">
        <button class="transparent iconButton" onclick="goBack()"><i class="fas fa-arrow-left"></i></button>
        <h2>
            <?php echo $video->getTitle(); ?></h2>
    </div>

    <div class="videoControls upNext" style="display: none">
        <button onclick="restartVideo();">
            <i class="fa fa-redo ">
            </i>
        </button>
        <div class="upNextContainer">
            <h2>Up Next:</h2>
            <h3><?php   echo $upNextVideo->getTitle(); ?></h3>
            <h3><?php   echo $upNextVideo->getSeasonAndEpisode(); ?></h3>
            <button class="playNext" onclick="watchVideo(<?php echo $upNextVideo->getId();?>)">
                <i class="fas fa-play"> Play</i>
            </button>
        </div>
    </div>
    <video controls autoplay controlsList=" nodownload" onended="showUpNext();">
        <source src='<?php echo $video->getFilePath(); ?>' type='video/mp4'>
    </video>
</div>

<script>
initVideo(" <?php echo $video->getId(); ?>", "<?php echo $userLoggedIn; ?>");
</script>