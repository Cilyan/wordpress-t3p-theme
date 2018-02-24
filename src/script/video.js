import $ from 'jquery';
import YouTubeIframeLoader from 'youtube-iframe';

var tv;

function vidRescale(){
  var w = $(window).width()+200,
    h = $(window).height()+200;

  if (w/h > 16/9){
    tv.setSize(w, w/16*9);
    $('.tv .screen').css({'left': '0px'});
  } else {
    tv.setSize(h/9*16, h);
    $('.tv .screen').css({'left': -($('.tv .screen').outerWidth()-w)/2});
  }
}

YouTubeIframeLoader.load(function(YT) {
  var playerDefaults = {
    autoplay: 0,
    autohide: 1,
    modestbranding: 0,
    rel: 0,
    showinfo: 0,
    controls: 0,
    disablekb: 1,
    enablejsapi: 0,
    iv_load_policy: 3
  };

  tv = new YT.Player('tv', {events: {'onReady': onPlayerReady, 'onStateChange': onPlayerStateChange}, playerVars: playerDefaults});
  $(window).on('load resize', vidRescale);
});

function onPlayerReady(){
  var video = {
    'videoId': 'o--eZThXHYU',
    'startSeconds': 79,
    'endSeconds': 259,
    'suggestedQuality': 'hd720'
  };
  tv.loadVideoById(video);
  tv.mute();
}

function onPlayerStateChange(e) {
  if (e.data === 1){
    $('#tv').addClass('active');
  } else if (e.data === 2){
    $('#tv').removeClass('active');
    onPlayerReady();
    tv.loadVideoById(vid[currVid]);
    tv.seekTo(vid[currVid].startSeconds);
  }
}
