<?php
  error_reporting(0);
  $sq = $_GET['id'];
  $DZjson = file_get_contents('https://api.deezer.com/artist/'.$sq);
  $DZdata = json_decode($DZjson);
  $pic = $DZdata->picture_xl;
  header('Content-Type: image/jpeg');
  readfile($pic);
  ?>
  