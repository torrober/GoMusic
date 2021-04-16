<?php

if(isset($_GET['sq']) and !isset($_GET['nextPage']))
{
	$keyword = $_GET['sq'];
	
	$keyword=preg_replace("/ /","+",$keyword);
	$api = "AIzaSyCiSfyMGIRWrKVIIIN9RjkQkJQgh18JJAg";
	$response = file_get_contents("https://www.googleapis.com/youtube/v3/search?part=snippet&q={$keyword}&type=video&key={$api}&maxResults=30");
	$searchResponse = json_decode($response,true);
	foreach ($searchResponse['items'] as $searchResult) {
	$a = $searchResult['id']['videoId'];
	$down = "javascript:convert2mp3('".$a."')";
	$b = preg_replace('/[^a-zA-Z0-9]/', '_', $searchResult['snippet']['title']);
	echo '<div class="row">
<div class="col-4"><img src="https://i.ytimg.com/vi/'.$a.'/default.jpg" width="100" height="100" class="img-fluid roundimg" ></img>
</div>
<div class="col-8">'.$searchResult['snippet']['title'].' 
<hr style="opacity: 0;">
<a href="https://www.convertmp3.io/fetch/?video=https://www.youtube.com/watch?v='.$a.'"> <button type="button" class="btn btn-outline-secondary">Descargar</button> </a>
</div>
</div>
<hr></hr>';
	} 

	?>


		<?php
			$nextPage = $searchResponse['nextPageToken'];
}
		?>