<?php
$itunes = file_get_contents('https://itunes.apple.com/us/rss/topsongs/genre=21/limit=10/explicit=true/xml');
include_once('simple_html_dom.php');
$xml = new SimpleXMLElement($itunes);
$lists = $xml->entry;
$total = sizeof($lists);
for($i=0; $i < $total; $i++){
$content = $lists[$i]->content;
$hey = str_get_html($content);
$titles = $hey->find('a');
$title1 = $titles['1']->innertext;
$title2 = $titles['3']->innertext;
$img = preg_match_all('#src="(.*?)"#', $content, $src);
$img = $src[1][0];
$searchVal = array("100x100");
$replaceVal = array("200x200");
$biggerImg = str_replace($searchVal, $replaceVal, $img);
echo '<div class="item">
<a href="search.php?sq='.$title1.'">
<figure class="imghvr-slide-up cover">
<img class="img-fluid" src="'.$biggerImg.'"></img>
<figcaption>
<p>'.$title1.'</p> <b>'.$title2.'</b>
</figcaption>
</figure>
</a>
</div>';
}
?>