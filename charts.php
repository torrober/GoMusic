<?php
  error_reporting(1);
  $DZjson = file_get_contents('https://api.deezer.com/chart/artists');
  $DZdata = json_decode($DZjson);
  foreach ($DZdata->tracks->data as $mydata) {
    $pic = 'artpic.php?id='.$mydata->artist->id;
    $comma = "'";
    echo '
      <div class="jumbotron header carousel-cell" id="top" style="background-image: linear-gradient(141deg, rgba(61, 90, 254, 0.25),rgba(3, 155, 229, 0.75)), url( '.$comma.''.$pic.''.$comma.');">
        <div class="container">
          <h1 class="display-4 bold">' .$mydata->artist->name. '</h1>
          <h4>' . $mydata->title . '</h4>
        </div>
        </div>
     ';
  }
?>
