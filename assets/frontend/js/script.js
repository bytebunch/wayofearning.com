var Interval;
var seconds = 0;
var current_video_play_time = 0;
var player;
var is_new_video = false;

// 2. This code loads the IFrame Player API code asynchronously.
var tag = document.createElement('script');

tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

function startTimer () {
  seconds++;
  console.log(seconds);
}

function start_timer() {
   Interval = setInterval(startTimer, 1000);
}
function stop_timer() {
  clearInterval(Interval);
}

function onYouTubeIframeAPIReady() {
  player = new YT.Player('player', {
    height: '390',
    width: '640',
    videoId: 'o9aaoiyJlcM',
    playerVars: {
      'playsinline': 1
    },
    events: {
      //'onReady': onPlayerReady,
      'onStateChange': onPlayerStateChange
    }
  });
}

function onPlayerReady(event) {
  event.target.playVideo();
}

function onPlayerStateChange(event) {

  //console.log(event.data);
  if(event.data == 2){
    stop_timer();
  }

  if(event.data == 1){

    current_video_play_time = player.getDuration();
    if(is_new_video == true){
      is_new_video = false;
    }else{
      start_timer();
    }
    
  }
        
  if (event.data == 0) {
    watched_time = seconds;
    stop_timer();
    seconds = 0;
    is_new_video = true;
    if(watched_time+5 >= current_video_play_time){
      if(confirm("Play next video")){
        player.loadVideoById('pBSIUuwpijA');
      }
    }else{
      alert("You didn't wathed the full video, pelase watch full video to earn your money.");
    }
  }

}




$(document).ready(function(){
  $(".submit_plan").click(function(e){
    if(confirm('Are you sure?')){
      return true;
    }else{
      e.preventDefault();
      return false;
    }
  });
});