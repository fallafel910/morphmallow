$(document).ready(function(){
    StoreItemsSlider.populate();
    SpriteToolBar.init();
    $(document).click(function(e) {
      if($(e.target).hasClass("slide-toggle-glyphicon"))
        return;
      if($(e.target).parents(".video-grid-wrapper").length == 0 && !$(e.target).hasClass("video-grid-wrapper")){
        $('.video-list').removeClass('video-list-active');
        $('.slide-toggle').removeClass('top-50');
      }
    });
  });


var SpriteToolBar = {

  showing : false,

  show: function(){
    $('.shareImg').css('background', "url('images/share_menu_icon_selected-md.png') no-repeat center");
    $('.shareImg').css('background-color', "white");
    $('#sprite-list').show();
    SpriteToolBar.showing = true;
  },

  hide: function(){
    $('.shareImg').css('background', "url('images/share_menu_icon-md.png') no-repeat center");
    $('.shareImg').css('background-color', StoreItemsSlider.redColor);
    $('#sprite-list').hide();
    SpriteToolBar.showing = false;
  },

  init : function() {

    $("#sprite-list,.shareImg")
    .mouseenter(function() {
      SpriteToolBar.show();
    })
    .mouseleave(function() {
       SpriteToolBar.hide();
    });

    $(".shareImg").click(function(event){
        //event.stopPropagation();
        if(SpriteToolBar.showing)
          SpriteToolBar.hide();
        else  
          SpriteToolBar.show();
    });  
  }
}
 
 var recievedYoutubeJson = new $.Deferred();
 $.when(recievedYoutubeJson).done(function() {
   postYouTubePlayerReady();
   setUpPlayer();
 });

 function postYouTubePlayerReady() {
   updateNext(VideoHandler.getNext());
   updatePrev(VideoHandler.getPrev());

   $('#next').on({
     mouseenter: function() {
       $('#next').addClass("fillParent");
       $('.next-hover').css('z-index',100);
       $('.next-video').addClass("slideLeft");
       $('.next-video').show();
     }
   });

   $('.next-hover').on({
     mouseleave: function() {
       $('.next-video').hide();
       $('#next').removeClass("fillParent");
       $('.next-hover').css('z-index',"auto");
     }
   });

   $('#prev').on({
     mouseenter: function() {
       $('#prev').addClass("fillParent");
       $('.prev-hover').css('z-index',100);
       $('.prev-video').addClass("slideRight");
       $('.prev-video').show();
     }
   });

   $('.prev-hover').on({
     mouseleave: function() {
       $('.prev-video').hide();
       $('#prev').removeClass("fillParent");
       $('.prev-hover').css('z-index',"auto");
     }
   });

   $('#next, .next-video').on('click', function(event) {
     VideoHandler.next();
     updateAllThumbnails();
     $('.playable-element').trigger('click');
     //event.stopPropagation();
   });

   $('#prev, .prev-video').on('click', function(event) {
     VideoHandler.prev();
     updateAllThumbnails();
     $('.playable-element').trigger('click');
     //event.stopPropagation();
   });

   /*$('.share').on({
    mouseenter: function() {
      $('#share-icon').attr('src', 'images/share_menu_icon_selected-md.png');
      $('#share-menu').show();
    },
    mouseleave: function() {
      $('#share-icon').attr('src', 'images/share_menu_icon-md.png');
      $('#share-menu').hide();
    },
    click: function(e) {
      e.stopPropagation();
    }
   });*/

   function _topMenuTitle() {
     $('#top-menu-title').html(VideoHandler.getCurrent().getClippedTitle(40));
   }

   function updateAllThumbnails() {
     $('#thumbnail').show();
     _topMenuTitle();
     updateNext(VideoHandler.getNext());
     updatePrev(VideoHandler.getPrev());
     $('#player').hide();
     $('#fullscreen').hide();
     $('#play').show();
     stopVideo();
   }

   $('.slide-toggle').on('click', function(e) {
    new AnimOnScroll(document.getElementById('videos-grid-view'), {
      minDuration: 0.4,
      maxDuration: 0.7,
      viewportFactor: 0.2
    });
    if(!($('.video-list').hasClass('video-list-active')))
      updateAllThumbnails();
    else
      GridView.setCurrentVideo();

     $('.video-list').toggleClass('video-list-active');
     $('.slide-toggle').toggleClass('top-50');
     
   });
 }

 var firstScriptTag = document.getElementsByTagName('script')[0];
 firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

 var player;
 //var playerArea = document.getElementById("video-container");
 var playerArea = $(".playable-element");
 var nextButton = document.getElementById("next");
 var prevButton = document.getElementById("prev");
 var thumbnail = document.getElementById("thumbnail");
 var fullscreen_button = document.getElementById("fullscreen");
 var count = 0;

 function setUpPlayer() {

   player = new YT.Player('player', {
     height: '100%',
     width: '100%',
     playerVars: {
       'autohide': 1,
       'controls': 0,
       'showinfo': 0,
       'modesbranding': 1
     },
     events: {
       'onReady': onPlayerReady,
       'onStateChange': onPlayerStateChange
     }
   });
 }

 function onPlayerReady(event) {
  playerArea.on("click", function() {
    document.getElementById("play").style.display = "none";
    thumbnail.style.display = "none";
    document.getElementById("player").style.display = "block";
    document.getElementById("fullscreen").style.display = "block";

    event.target.loadVideoById({
      videoId: VideoHandler.getCurrent().videoId
    });
  });

   fullscreen_button.addEventListener("click", function() {
     if (document.getElementById("player").requsetFullScreen)
       document.getElementById("player").requsetFullScreen();
     else if (document.getElementById("player").webkitRequestFullScreen)
       document.getElementById("player").webkitRequestFullScreen();
     else if (document.getElementById("player").mozRequestFullScreen)
       document.getElementById("player").mozRequestFullScreen();
   });
 }

 function onPlayerStateChange(event) {
  if (event.data == YT.PlayerState.ENDED) {
    stopVideo();
  } else if (event.data == YT.PlayerState.PLAYING) {

  } else if (event.data == YT.PlayerState.BUFFERING) {
    $("#" + this.playerId).siblings(".video-title-container").hide();
  } else if (event.data == YT.PlayerState.CUED) {

  }
 }

 function stopVideo() {
   player.stopVideo();
 }

 function updateNext(video) {
   $('#showNext').css("background", 'url(' + video.getHdView() + ') no-repeat center');
   $('#nextVideoTitle').html(video.getClippedTitle());
 }

 function updatePrev(video) {
   $('#showPrev').css("background", 'url(' + video.getHdView() + ') no-repeat center');
   $('#prevVideoTitle').html(video.getClippedTitle());
 }