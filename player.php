</div>
<div id="player" style="opacity: 0;"></div>
<script src="js/player.js">
</script>
<div class="player-bar">
  <div class="container-fluid player-container">
    <div class="row">
      <div class="col info">
        <ul class="player-info">
          <li>
            <img src="https://via.placeholder.com/56" id="cover"></img>
          </li>
          <li class="info">
            <p id="song-title"></p>
            <p id="artist-title" class="bold"></p>
          </li>
        </ul>
      </div>
      <div class="col-6">
        <ul class="controls">
          <li>
            <ion-icon name="play-skip-back" onclick="back();" style="color: white;" size="large"></ion-icon>
          </li>
          <li>
            <div id="play">
              <ion-icon onclick="player.playVideo();" name="play" style="color: white;" size="large">
            </div>
            <div id="pause" style="display: none;">
              <ion-icon onclick="player.pauseVideo();" name="pause" style="color: white;" size="large">
            </div>
          </li>
          <li>
            <ion-icon name="play-skip-forward" onclick="next();" style="color: white;" size="large">
          </li>
        </ul>
        <div class="row">
          <div class="col">
            <p  id="current-time" style="margin: 0px">0:00</p>
          </div>
          <div class="col-9">
            <form>
              <div class="form-group">
                <input type="range" class="form-control-range range-slider__range" id="progbar" value="0" step="1">
              </div>
            </form>
          </div>
          <div class="col">
            <p id="duration" style="margin: 0px">0:00</p>
          </div>
        </div>

      </div>
      <div class="col">
        <ion-icon name="volume-high" style="color: white;" size="large" style="cursor: pointer;"></ion-icon>
        <input type="range" class="form-control-range" min="0" max="100" step="0" value="100" oninput="setVideoVolume(value)" style="cursor: pointer;">
        <output style="display:none;" for="fader" id="volume">99</output>
      </div>
    </div>
  </div>
</div>