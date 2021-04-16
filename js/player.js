var playlist = localStorage.getItem('currentPlaylist');
playlist = JSON.parse(playlist);
var index = parseInt(localStorage.getItem('index'));
var currentSong = playlist[index];
var localStorage = window.localStorage;
window.onload = () => {
  document.getElementById("artist-title").innerHTML = currentSong.artist;
  document.getElementById("song-title").innerHTML = currentSong.title;
  document.getElementById('cover').src = currentSong.cover;
}
function showDetails(track) {
  addToArray();
  var playlist = localStorage.getItem('currentPlaylist');
  playlist = JSON.parse(playlist);
  var index = parseInt(track.getAttribute("data-index"));
  var currentSong = playlist[index];
  var yt = "gettrack.php?id=" + currentSong.trackid;
  console.log(playlist[index]);
  var videoid;
  $.ajax({
    url: yt,
    success: function (data) {
      videoid = data;
      console.log(videoid);
      document.getElementById("artist-title").innerHTML = currentSong.artist;
      document.getElementById("song-title").innerHTML = currentSong.title;
      document.getElementById('cover').src = currentSong.cover;
      player.loadVideoById(videoid);
    }
  });
  $("#tracks").on("click", "tr", function () {
    $(this).toggleClass("selected");
    $(this).siblings(".selected").removeClass("selected");
  });
  localStorage.setItem('index', index);
}
function addToArray() {
  var playlist = [];
  $(".d-flex").each(function (i, value) {
    const song = new Object();
    song.trackid = this.getAttribute("data-id");
    song.title = this.getAttribute("data-song");
    song.artist = this.getAttribute("data-artist");
    song.index = i;
    song.cover = this.getAttribute("data-cover");
    playlist.push(song);
  });
  console.log(playlist);
  localStorage.setItem('currentPlaylist', JSON.stringify(playlist));
}
function getImage(img) {
  var baseURL = img.getAttribute("data-url");
  console.log(baseURL);
  var getImg = "getartistpic.php?sq=" + baseURL;
  $.ajax({
    url: getImg,
    success: function (uri) {
      img = uri;
      console.log(img);
      $('#artist-image').attr('src', img);
    }
  });
}
function updateTimerDisplay() {
  // Update current time text display.
  $('#current-time').html(formatTime(player.getCurrentTime()));
  $('#duration').html(formatTime(player.getDuration()));
}

function formatTime(time) {
  time = Math.round(time);

  var minutes = Math.floor(time / 60),
    seconds = time - minutes * 60;

  seconds = seconds < 10 ? '0' + seconds : seconds;

  return minutes + ":" + seconds;
}
setInterval(updateTimerDisplay, 1000);
function time() {
  $('#progbar').val((player.getCurrentTime() / player.getDuration()) * 100);
  $('#progbar').on('mouseup', function (e) {
    // Calculate the new time for the video.
    // new time in seconds = total duration in seconds * ( value of range input / 100 )
    var newTime = player.getDuration() * (e.target.value / 100);
    // Skip video to new time.
    player.seekTo(newTime);
    setInterval(updateTimerDisplay, 1000);
  });
}
function next() {
  var next = $("tr.selected").next();
  var playlist = localStorage.getItem('currentPlaylist');
  playlist = JSON.parse(playlist);
  var oldIndex = parseInt(localStorage.getItem('index'));
  var index = oldIndex + 1;
  var currentSong = playlist[index];
  var playnext = "gettrack.php?id=" + currentSong.trackid;
  console.log(playlist[index]);
  $.ajax({
    url: playnext,
    success: function (data) {
      playnext = data;
      console.log(playnext);
      next.prev().removeClass("selected");
      next.toggleClass("selected");
      next.siblings(".selected").removeClass("selected");
      document.getElementById("artist-title").innerHTML = currentSong.artist;
      document.getElementById("song-title").innerHTML = currentSong.title;
      document.getElementById('cover').src = currentSong.cover;
      player.loadVideoById(playnext);
    }
  })
  localStorage.setItem('index', index);
}
function back() {
  var next = $("tr.selected").prev();
  var playlist = localStorage.getItem('currentPlaylist');
  playlist = JSON.parse(playlist);
  var oldIndex = parseInt(localStorage.getItem('index'));
  var index = oldIndex - 1;
  var currentSong = playlist[index];
  var playnext = "gettrack.php?id=" + currentSong.trackid;
  console.log(playlist[index]);
  $.ajax({
    url: playnext,
    success: function (data) {
      playnext = data;
      console.log(playnext);
      next.prev().removeClass("selected");
      next.toggleClass("selected");
      next.siblings(".selected").removeClass("selected");
      document.getElementById("artist-title").innerHTML = currentSong.artist;
      document.getElementById("song-title").innerHTML = currentSong.title;
      document.getElementById('cover').src = currentSong.cover;
      player.loadVideoById(playnext);
    }
  })
  if (index > 0) {
    localStorage.setItem('index', index);
  }
}

// 2. This code loads the IFrame Player API code asynchronously.
var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
// 3. This function creates an <iframe> (and YouTube player)
//    after the API code downloads.
var player;
function onYouTubeIframeAPIReady() {
  player = new YT.Player('player', {
    height: '200',
    width: '200',
    loop: 1,
    events: {
      'onReady': onPlayerReady,
      'onStateChange': onPlayerStateChange,
      'onError': onPlayerError
    }
  });
}

// 4. The API will call this function when the video player is ready.
function onPlayerReady(event) {
  event.target.playVideo();
  time();
  setVideoVolume(100);
  updateTimerDisplay();
}

// 5. The API calls this function when the player's state changes.
var done = false;
function onPlayerStateChange(event) {
  if (event.data == YT.PlayerState.PLAYING) {
    time();
    setInterval(time, 1000);
    document.getElementById('play').style.display = 'none';
    document.getElementById('pause').style.display = 'block';
  }
  if (event.data == YT.PlayerState.PAUSED) {
    document.getElementById('play').style.display = 'block';
    document.getElementById('pause').style.display = 'none';
  }
  if (event.data == YT.PlayerState.BUFFERING) {
    document.getElementById('play').style.display = 'block';
    document.getElementById('pause').style.display = 'none';
  }
  if (event.data == YT.PlayerState.ENDED) {
    document.getElementById('play').style.display = 'block';
    document.getElementById('pause').style.display = 'none';
    document.getElementById('progbar').value = "0";
    if (index <= playlist.length){
      next();
    }
  }
}
function onPlayerError(event) {
}

function stopVideo() {
  player.stopVideo();
}
function playVideo() {
  player.playVideo();
}
function pauseVideo() {
  player.pauseVideo();
}
function setVideoVolume(vol) {
  document.querySelector('#volume').value = vol;
  player.setVolume(vol);
}
