<?php
error_reporting(1);
$title = $_GET['sq'];
$searchVal2 = array(' ');
$searchTxt = str_replace($searchVal2, "+", $title);
$DZjson = file_get_contents('https://api.deezer.com/search?q=' . $searchTxt . '&output=JSON');
$DZdata = json_decode($DZjson);
$title = $DZdata->data[0]->title;
$artist = $DZdata->data[0]->artist->name;
$pic = 'artpic.php?id='.$DZdata->data[0]->artist->id;
$pic_s = $DZdata->data[0]->album->cover_xl;
if($title) {
  echo'
  <div class="jumbotron" id="top"
  style="background-image: linear-gradient(141deg, rgba(177, 37, 37, 0.25),rgba(239, 79, 79, 1)), url( '.$pic.'); background-size: cover; background-position: center;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-8">
        <h1 class="display-4 bold header-text">Main Result</h1>
        <h4 class="header-text">'.$artist.' - '.$title.'</h4>
      </div>
      <div class="col">
        <img src="'.$pic_s.'" align="right" srcset="" class="img-fluid image">
      </div>
    </div>
  </div>
</div>
  ';
} else {
  echo "<h1>Sin Resultados</h1>";
}
?>
