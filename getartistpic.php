
<?php
include_once('simple_html_dom.php');
// URL
$sq = $_GET['sq'];
$sq = preg_replace("/ /", "+", $sq);
$url = $sq . '/+images';
$opts = array('http' => array('header' => "User-Agent:MyAgent/1.0\r\n"));
$context = stream_context_create($opts);
$html = file_get_html($url, false, $context);
$cover = 'main.jpg';
$img = $html->find('img');
$pic = $img['2']->src;
if ($pic == false) {
    header('Location: '.$cover);
    exit(); 
} else {
    header('Location:' . $pic);
}
?>