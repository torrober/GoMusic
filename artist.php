
<?php
error_reporting(0);
$title = $_GET['sq'];
$searchVal2 = array(' ');
$searchTxt = str_replace($searchVal2, "+", $title);
$url = 'http://ws.audioscrobbler.com/2.0/?method=artist.search&artist='.$searchTxt.'&api_key=5d6b232816a986e7b0a005b632c8a51d&format=json&limit=3';
$getData = file_get_contents($url);
$getArtists = json_decode ($getData);
foreach ($getArtists->results->artistmatches->artist as $artist){
    echo '
    <div class="col">
    <div class="card blue-card">
    <div class="card-body">
    <img class="img-fluid card-img" src="getartistpic.php?sq='.$artist->url.'" data-url="'.$artist->url.'" width="50" height="50"></img>
    '.$artist->name.'
    </div>
    </div>
    </div>
    ';
}