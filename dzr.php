<h3 class="bold">Search results for « <?php echo $_GET['sq']; ?> »</h3>
<hr>
<div class="row cat" id="ref">
  <div class='col-12'>
    <?php if($_GET['sq']!="") {
      include("mainresult.php");
    } ?>
  </div>
  <div class='col-12'>
    <table class="table table-borderless" id="tracks">
      <?php
      error_reporting(0);
      $title = $_GET['sq'];
      $searchVal2 = array(' ');
      $searchTxt = str_replace($searchVal2, "+", $title);
      $DZjson = file_get_contents('https://api.deezer.com/search?q=' . $searchTxt . '&output=JSON');
      $DZdata = json_decode($DZjson);$id = 0;
      foreach ($DZdata->data as $mydata) {
        
        echo '
  <tr onclick="showDetails(this);"  data-index="'.$id++.'" data-id="' . $mydata->id . '" data-song="' . $mydata->title . '" data-artist="' . $mydata->artist->name . '" data-album="' . $mydata->album->title . '" data-cover="' . $mydata->album->cover_small . '" class="d-flex">
    <th class="col-1" style="vertical-align: middle;"><ion-icon name="play" style="color: #fafafa;"></ion-icon></th>
    <th class="col-4 table-text" style="vertical-align: middle;">' . $mydata->title . '</th>
    <th class="col-4 table-text" style="vertical-align: middle;">' . $mydata->artist->name . '</th>
    <th class="col-3 table-text" style="vertical-align: middle;">' . $mydata->album->title . '</th>
  </tr>    
     ';}
     if($title == ""){
       echo "<h1>Sin Resultados</h1>";
     }
      ?>
    </table>
  </div>
</div>
<hr>
<p>Powered by Deezer and YouTube, Made in Colombia</p>