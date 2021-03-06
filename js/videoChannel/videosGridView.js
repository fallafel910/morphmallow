var tag = document.createElement('script');
tag.src = "https://www.youtube.com/player_api";

var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

var key = "AIzaSyDpzUBZmHttFZZSiI1LEY7dY1U3sR7tmaE";
var channelId = "UCIqQhb_M6MhB2qQcfUGDfJg";
var query_url = "https://www.googleapis.com/youtube/v3/search?key=" + key + "&channelId=" + channelId + "&part=snippet,id&order=date&maxResults=50";
var videosList = new Array();


var VideoObject = function(videoId, thumbnails, videoTitle) {

  this.videoId = videoId;
  this.thumbnails = thumbnails;
  this.videoTitle = videoTitle;
  var self = this;

  this.getTitle = function() {
    return this.videoTitle;
  }

  this.getClippedTitle = function(len) {
    if (!len) {
      len = 28;
    }
    var title = this.videoTitle;
    if (title.length >= len) {
      title = title.substring(0, len - 1);
      title = title + "...";
    }
    return title;
  }

  this.getId = function() {
    return this.videoId;
  }
  this.getThumbnailView = function(quality) {

    if (quality == "high") {
      return this.getHdView();
    } else if (quality == "medium") {
      return this.getMediumView();
    } else if (quality == "default") {
      return this.getDefaultView();
    }
  }


  this.getDefaultView = function() {
    var ob = this.thumbnails.default.url;
    return ob;
  }

  this.getMediumView = function() {
    var ob = this.thumbnails.medium.url;
    if (ob == null)
      return getDefaultView();
    return ob;
  }

  this.getHdView = function() {
    var ob = this.thumbnails.high.url;
    if (ob == null)
      return getMediumView();
    return ob;
  }
}

var buildGridView = function(url) {

  $.getJSON(url, function(data) {

    var videoId;
    var videoObject;
    var item;
    var items = data.items;
    var nextPageToken = data.nextPageToken;
    for (item_index in items) {
      item = items[item_index];
      videoObject = new Object();
      videoId = item.id.videoId;

      if (videoId != null) {
        var videoObject = new VideoObject(videoId, item.snippet.thumbnails, item.snippet.title);
        videosList.push(videoObject);
      }
    }

    if (nextPageToken != null) {
      query_url_new = query_url + "&pageToken=" + nextPageToken;
      getvideosList(query_url_new);
    } else {
      VideoHandler.populate(videosList);
      VideoSlider.populate();
      GridView.populate();
    }
    recievedYoutubeJson.resolve();

  });
  new AnimOnScroll(document.getElementById('videos-grid-view'), {
    minDuration: 0.4,
    maxDuration: 0.7,
    viewportFactor: 0.2
  });
  return recievedYoutubeJson;
}


var GridView = {

  videoViewHtml: "<li class='col-md-3 col-sm-6 col-xs-12 video-container'> " +
    " <div class='video-title-container'> " +
    " <div class='video-title center-me'></div> </div>" +
    " <div class='video-thumbnail'></div> " +
    " <div class='video-playIcon'></div> " +
    " <div class='video-view'> " +
    " </div> </li>",

  thumbnailObject: undefined,

  print: function() {},

  populate: function() {
    for (i in videosList) {
      var divId = "video-" + i;
      var videoId = videosList[i].getId();
      var videoTitle = videosList[i].getTitle();
      var videoThumbnail = videosList[i].getMediumView();
      this.addVideoDiv(divId, videoId, videoTitle, videoThumbnail);
    }
  },

  setCurrentVideo: function(thumbnailObject) {
    this.thumbnailObject = thumbnailObject;
  },

  addVideoDiv: function(divId, videoId, vidTitle, videoThumbnail) {

    var gridView = $('#videos-grid-view');
    var vidView = $(this.videoViewHtml);

    vidView.children('.video-view').attr('id', divId);
    vidView.children('.video-thumbnail').attr('id', 'thumbnail-' + divId);
    vidView.children('.video-playIcon').attr('id', 'playIcon-' + divId);
    vidView.find('.video-title').html(vidTitle);

    gridView.append(vidView);

    var tv = new ThumbnailPlayerView(divId, videoId, videoThumbnail);
    tv.createVideoThumbnailView();
  }
}

var NavController = {

  updateLinks: function() {

    var updateHomeLink = function() {
      $('#top-menu-title').html(VideoHandler.getCurrent().getClippedTitle(40));
    };

    var updateNext = function(video) {
      $('#showNext').css("background", 'url(' + video.getHdView() + ') no-repeat center');
      $('#nextVideoTitle').html(video.getClippedTitle());
    };

    var updatePrev = function(video) {

      $('#showPrev').css("background", 'url(' + video.getHdView() + ') no-repeat center');
      $('#prevVideoTitle').html(video.getClippedTitle());
    };

    updateHomeLink();
    updateNext(VideoHandler.getNext());
    updatePrev(VideoHandler.getPrev());
    $('#player').hide();
    $('#fullscreen').hide();
    $('#play').show();
    $('.playable-element').trigger('click');
  }

}

var VideoSlider = {
  visibleWidth: 0,
  actualWidth: 0,
  currMarginLeft: 0,
  listItemWidth: 0,
  videosCount: 0,
  minMargin: 0,
  maxMargin: 0,

  populate: function() {
    $('#top-menu-title').html(VideoHandler.getCurrent().getClippedTitle(40));
    var listItemHtml = "<li> <div class='slider-item-container' >" +
      "<div class='slider-video-title-container'>" +
      "<div class='slider-video-title center-me'> </div> </div>" +
      "<img class='slider-item-thumbnail below'/>" +
      "</div> </li>";

    var sliderView = $('#video-list-slider');
    var listViewItem;
    var videoObject;

    for (var i = 0; i < VideoHandler.size(); i++) {

      listViewItem = $(listItemHtml);
      videoObject = VideoHandler.getFromIndex(i);

      listViewItem.find('.slider-video-title').html(videoObject.getTitle());
      listViewItem.find('.slider-item-thumbnail').attr('src', videoObject.getMediumView());
      listViewItem.find('.slider-item-container').attr('videoid', videoObject.videoId);
      sliderView.append(listViewItem);
    }

    this.bindEvents();

  },

  refreshSlider: function() {
    this.init();
    this.currMarginLeft = (this.currMarginLeft > this.minMargin) ? this.currMarginLeft : this.minMargin;
    this.refreshMarginLeft();
  },

  bindEvents: function() {

    $(window).resize(function() {
      VideoSlider.refreshSlider();
    });

    $('.slider-video-title-container')
      .mouseenter(function() {
        $('.slider-item-container, .slider-button').css('margin-top', 30);
        $('.slide-toggle .glyphicon').css('top', '-250px');
      });


    $('.slider-item-container')
      .mouseenter(function(e) {
        VideoSlider.init();
        $(this).css('margin-top', 0);

      })
      .mousemove(function(e) {

        var carouselPadding = 100;
        var x = e.pageX - this.offsetLeft;

        // console.log("x: " + x);

        var fraction = (x - carouselPadding) / (VideoSlider.visibleWidth - 2 * carouselPadding);

        if (fraction < 1) {
          VideoSlider.slide(-1 * fraction * VideoSlider.actualWidth);
        }

      })
      .mouseleave(function() {
        $(this).css('margin-top', 30);
      });


    $('.slider-container')
      .mouseleave(function() {
        $('.slider-item-container, .slider-button').css('margin-top', 150);
        $('.slide-toggle .glyphicon').css('top', '-100px');
      });


    $("#slider-prev-button").bind("click", function(event) {

      VideoSlider.slideRight();
      event.stopPropagation();
    });

    $("#slider-next-button").bind("click", function(event) {
      VideoSlider.slideLeft();
      event.stopPropagation();
    });

    $("#video-list-slider li").bind("click", function(event) {
      event.stopPropagation();
      var videoid = $(event.target).parent().attr('videoid');
      var video = VideoHandler.rollToIndex(videoid);
      NavController.updateLinks();
    });

  },

  init: function() {

    var listItem = $("ul#video-list-slider li");
    var slider = $("ul#video-list-slider");
    this.listItemWidth = listItem.outerWidth() + parseInt(listItem.css('margin-right'));
    this.listItemWidth = listItem[0].getBoundingClientRect().width + parseInt(listItem.css('margin-right'));
    this.videosCount = $('ul#video-list-slider').children().length;

    this.actualWidth = this.listItemWidth * this.videosCount;
    this.visibleWidth = slider.outerWidth();

    this.maxMargin = 0;
    this.minMargin = this.visibleWidth - this.actualWidth;

  },

  refreshMarginLeft: function() {
    $("ul#video-list-slider").css('margin-left', this.currMarginLeft);
  },

  slide: function(marginLeft) {
    this.init();
    marginLeft = (marginLeft > this.minMargin) ? marginLeft : this.minMargin;
    this.currMarginLeft = (marginLeft < this.maxMargin) ? marginLeft : this.maxMargin;
    this.refreshMarginLeft();
  },

  slideLeft: function() {
    this.init();
    var intendedMargin = this.currMarginLeft - this.listItemWidth;
    this.currMarginLeft = (intendedMargin > this.minMargin) ? intendedMargin : this.minMargin;

    $("ul#video-list-slider").animate({
      marginLeft: this.currMarginLeft + "px"
    }, 1000);
  },
  slideRight: function() {
    this.init();
    var intendedMargin = this.currMarginLeft + this.listItemWidth;
    this.currMarginLeft = (intendedMargin < this.maxMargin) ? intendedMargin : this.maxMargin;
    $("ul#video-list-slider").animate({
      marginLeft: this.currMarginLeft + "px"
    }, 1000);
  },
  slideLeftCont: function() {
    this.init();
  },
  slideRightCont: function() {
    this.init();
  }
}


var ThumbnailPlayerView = function(divId, videoId, videoThumbnail) {

  var self = this;
  this.playerId = divId;
  this.videoId = videoId;
  this.vidPlayer;
  this.thumbnailView = $('#thumbnail-' + this.playerId);
  this.playerIconView = $('#playIcon-' + this.playerId);
  this.videoView = $('#' + this.playerId);


  this.createVideoThumbnailView = function() {
    self.thumbnailView.css('background', 'url(' + videoThumbnail + ') no-repeat');
    self.thumbnailView.css('background-size', '100% 100%');
    // self.playerIconView.on('click', self.loadGridVideo);
    self.playerIconView.on('click', function() {
      event.stopPropagation();
      var video = VideoHandler.rollToIndex(self.videoId);
      NavController.updateLinks();
      // $('.slide-toggle').trigger('click');
    });
    self.videoView.hide();
  };

  // this.stopVideo = function() {
  //   self.vidPlayer.stopVideo();
  //   self.thumbnailView.show();
  //   self.playerIconView.show();
  //   $('#' + self.playerId).replaceWith("<div class='video-view' id='" + self.playerId + "'></div>");
  //   self.videoView.hide();
  //   self.vidPlayer = null;
  // };

  // this.loadGridVideo = function() {
  //   GridView.setCurrentVideo(self);
  //   self.videoView.show();
  //   self.thumbnailView.hide();
  //   self.playerIconView.hide();

  //   var onPlayerStateChange = function(event) {
  //     if (event.data == YT.PlayerState.ENDED) {
  //       self.stopVideo();
  //     } else if (event.data == YT.PlayerState.PLAYING) {

  //     } else if (event.data == YT.PlayerState.BUFFERING) {
  //       $("#" + this.playerId).siblings(".video-title-container").hide();
  //     } else if (event.data == YT.PlayerState.CUED) {

  //     }

  //   };


  //   self.vidPlayer = new YT.Player(self.playerId, {
  //     videoId: self.videoId,
  //     playerVars: {
  //       'autohide': 0,
  //       'autoplay': 1,
  //       'controls': 1,
  //       'showinfo': 0,
  //       'modesbranding': 1
  //     },
  //     events: {
  //       'onReady': onPlayerReady,
  //       'onStateChange': onPlayerStateChange
  //     }
  //   });
  // }
}

function onYouTubePlayerAPIReady() {
  buildGridView(query_url);
}
