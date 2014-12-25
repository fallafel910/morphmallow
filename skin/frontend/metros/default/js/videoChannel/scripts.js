j$(document).ready(function(){
    StoreItemsSlider.populate();
    SpriteToolBar.init();
    j$(document).click(function(e) {
      if(j$(e.target).hasClass("slide-toggle-glyphicon"))
        return;
      if(j$(e.target).parents(".video-grid-wrapper").length == 0 && !j$(e.target).hasClass("video-grid-wrapper")){
        j$('.video-list').removeClass('video-list-active');
        j$('.slide-toggle').removeClass('top-50');
      }
    });
  });


var SpriteToolBar = {

  showing : false,

  show: function(){
    // j$('.shareImg').css('background', "url('images/share_menu_icon_selected-md.png') no-repeat center");
    // j$('.shareImg').css('background-color', "white");
    j$('.shareImg').addClass("shareImg-selected");
    j$('.shareImg').removeClass("shareImg-not-selected");
    j$('#sprite-list').show();
    SpriteToolBar.showing = true;
  },

  hide: function(){
    j$('.shareImg').addClass("shareImg-not-selected");
    j$('.shareImg').removeClass("shareImg-selected");
    // j$('.shareImg').css('background', "url('images/share_menu_icon-md.png') no-repeat center");
    // j$('.shareImg').css('background-color', StoreItemsSlider.redColor);
    j$('#sprite-list').hide();
    SpriteToolBar.showing = false;
  },

  init : function() {

    j$("#sprite-list,.shareImg")
    .mouseenter(function() {
      SpriteToolBar.show();
    })
    .mouseleave(function() {
       SpriteToolBar.hide();
    });

    j$(".shareImg").click(function(event){
        //event.stopPropagation();
        if(SpriteToolBar.showing)
          SpriteToolBar.hide();
        else  
          SpriteToolBar.show();
    });  
  }
}
 
 var recievedYoutubeJson = new j$.Deferred();
 j$.when(recievedYoutubeJson).done(function() {
   postYouTubePlayerReady();
   setUpPlayer();
 });

 function postYouTubePlayerReady() {
   updateNext(VideoHandler.getNext());
   updatePrev(VideoHandler.getPrev());

   j$('#next').on({
     mouseenter: function() {
       j$('#next').addClass("fillParent");
       j$('.next-hover').css('z-index',100);
       j$('.next-video').addClass("slideLeft");
       j$('.next-video').show();
     }
   });

   j$('.next-hover').on({
     mouseleave: function() {
       j$('.next-video').hide();
       j$('#next').removeClass("fillParent");
       j$('.next-hover').css('z-index',"auto");
     }
   });

   j$('#prev').on({
     mouseenter: function() {
       j$('#prev').addClass("fillParent");
       j$('.prev-hover').css('z-index',100);
       j$('.prev-video').addClass("slideRight");
       j$('.prev-video').show();
     }
   });

   j$('.prev-hover').on({
     mouseleave: function() {
       j$('.prev-video').hide();
       j$('#prev').removeClass("fillParent");
       j$('.prev-hover').css('z-index',"auto");
     }
   });

   j$('#next, .next-video').on('click', function(event) {
     VideoHandler.next();
     updateAllThumbnails();
     j$('.playable-element').trigger('click');
     //event.stopPropagation();
   });

   j$('#prev, .prev-video').on('click', function(event) {
     VideoHandler.prev();
     updateAllThumbnails();
     j$('.playable-element').trigger('click');
     //event.stopPropagation();
   });

   /*j$('.share').on({
    mouseenter: function() {
      j$('#share-icon').attr('src', 'images/share_menu_icon_selected-md.png');
      j$('#share-menu').show();
    },
    mouseleave: function() {
      j$('#share-icon').attr('src', 'images/share_menu_icon-md.png');
      j$('#share-menu').hide();
    },
    click: function(e) {
      e.stopPropagation();
    }
   });*/

   function _topMenuTitle() {
     j$('#top-menu-title').html(VideoHandler.getCurrent().getClippedTitle(40));
   }

   function updateAllThumbnails() {
     j$('#thumbnail').show();
     _topMenuTitle();
     updateNext(VideoHandler.getNext());
     updatePrev(VideoHandler.getPrev());
     j$('#player').hide();
     j$('#fullscreen').hide();
     j$('#play').show();
     stopVideo();
   }

   j$('.slide-toggle').on('click', function(e) {
    new AnimOnScroll(document.getElementById('videos-grid-view'), {
      minDuration: 0.4,
      maxDuration: 0.7,
      viewportFactor: 0.2
    });
    if(!(j$('.video-list').hasClass('video-list-active')))
      updateAllThumbnails();
    else
      GridView.setCurrentVideo();

     j$('.video-list').toggleClass('video-list-active');
     j$('.slide-toggle').toggleClass('top-50');
     
   });
 }

 var firstScriptTag = document.getElementsByTagName('script')[0];
 firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

 var player;
 //var playerArea = document.getElementById("video-container");
 var playerArea = j$(".playable-element");
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
    j$("#" + this.playerId).siblings(".video-title-container").hide();
  } else if (event.data == YT.PlayerState.CUED) {

  }
 }

 function stopVideo() {
   player.stopVideo();
 }

 function updateNext(video) {
   j$('#showNext').css("background", 'url(' + video.getHdView() + ') no-repeat center');
   j$('#nextVideoTitle').html(video.getClippedTitle());
 }

 function updatePrev(video) {
   j$('#showPrev').css("background", 'url(' + video.getHdView() + ') no-repeat center');
   j$('#prevVideoTitle').html(video.getClippedTitle());
 }