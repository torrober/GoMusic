<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php
$query = 'http://api.soundcloud.com/tracks.json?client_id='.$scid.'&q='.$sq.'&limit='.$results;
$response = file_get_contents($query);
$data = json_decode($response, true);
if (!empty($data)) {
  echo '
  <!-- Hay un total de '.count($data).' canciones. -->';
    foreach($data as $sound){if(!empty($sound['stream_url'])){echo '
        <div class="song">
<strong> '.$sound['title'].'</strong>
<a class="right button button-green button-icon-compartir" id="shareButton_1" href="javascript:;" title="Compartir '.$sound['title'].'">Compartir</a>
<a class="right button button-pink button-icon-descargar" rel="nofollow" href="download.php?n='.$sound['title'].'&t='.$sound['stream_url'].'?client_id='.$scid.'" title="Descargar '.$sound['title'].'">Descargar</a>
<a class="right button button-blue button-icon-reproducir" href="javascript:;" id="playSong_1" title="Escuchar '.$sound['title'].'">Reproducir</a>
<div class="clear">&nbsp;</div>
<div class="reproducir" id="boxPlayer_1">
<div id="embedPlayer_1" class="embedPlayer" style="height: 115px; background: #000;"><embed src="'.$sound['stream_url'].'?client_id='.$scid.'" width="300" height="60"></embed></div>
</div>
</div>';}
    }
  } else {
    echo 'Hubo un drama, no podemos continuar. '.$data['error'];
    exit;
  } 