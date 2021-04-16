<?php
$title = $_GET['id'];
$searchVal2 = array(" ","'");
$searchID = str_replace($searchVal2, "+", $title);
$DZjson = file_get_contents('https://api.deezer.com/track/'.$searchID);
$DZdata = json_decode($DZjson);
$search_title_raw = $DZdata->title;
$search_artist_raw = $DZdata->artist->name;
$search_album_raw = $DZdata->album->title;
$search_title = str_replace($searchVal2, "+", $search_title_raw);
$search_artist = str_replace($searchVal2, "+", $search_artist_raw);
$search_album = str_replace($searchVal2, "+", $search_album_raw);
$apikey = 'AIzaSyBlVdUCpjrHipjsg52lTDH0aR5IbZ1sCrA';
$json = file_get_contents('https://www.googleapis.com/youtube/v3/search?part=snippet&q='.$search_title.'+'.$search_artist.'&key='.$apikey.'&part=snippet');
$ytdata = json_decode($json);
$result = $ytdata->items[0]->id->videoId;
$getmp3 = file_get_contents('https://api.download-lagu-mp3.com/@api/json/mp3/'.$result);
$mp3 = json_decode($getmp3, TRUE);
$file = $mp3['vidInfo'][0]['dloadUrl'];
header ("Location: https:".$file);
?>