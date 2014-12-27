var StoreItemsSlider = {
  visibleWidth: 0,
  actualWidth: 0,
  currMarginLeft: 0,
  listItemWidth: 0,
  storeItemsCount: 0,
  minMargin: 0,
  maxMargin: 0,
  redColor: "rgb(241,92,83)",
  grey: "rgb(180,180,180)",
  black: "rgb(70,70,70)",
  showing: false,

  populate: function() {

    var listItemHtml = "";
    this.bindEvents();

  },

  hide: function() {
    if (!StoreItemsSlider.showing)
      return;
    $(".home").css('background', "rgb(241,92,83)");
    $('.home img').attr('src', j$('body').attr('skin-url') + 'images/store_icon-md.png');
    $('.store-slider-container').hide();
    StoreItemsSlider.showing = false;
  },

  show: function() {
    if (StoreItemsSlider.showing)
      return;
    $(".home").css('background', "white");
    $('.home img').attr('src', '/../../images/home_hover-md.png');
    $('.store-slider-container').css("zIndex", 200);
    $('.store-slider-container').show();
    StoreItemsSlider.showing = true;
  },

  isNodePresent: function(node) {
    return $('.store-slider-container *').get().indexOf(node) > -1;
  },

  bindEvents: function() {

    $('#store-slider > li')
      .mouseenter(function() {
        $(this).find('a.store-item-link').css('color', StoreItemsSlider.redColor);
        $(this).find('img.store-item-img').css("box-shadow", "2px 2px 2px " + StoreItemsSlider.redColor);
      })
      .mouseleave(function() {
        $(this).find('a.store-item-link').css('color', StoreItemsSlider.black);
        $(this).find('img.store-item-img').css("box-shadow", "2px 2px 2px " + StoreItemsSlider.grey);
      });

    $(".home,.store-slider-container")
      .mouseenter(function() {
        StoreItemsSlider.show();
      })
      .mouseleave(function(e) {
        if (!StoreItemsSlider.isNodePresent(e.relatedTarget)) {
          StoreItemsSlider.hide();
        }
      });

    $(".home").click(function(e) {
      if (StoreItemsSlider.showing)
        StoreItemsSlider.hide();
      else
        StoreItemsSlider.show();
      //e.stopPropagation();
    });


    $("#store-slider-prev").bind("click", function(event) {
      StoreItemsSlider.slideRight();
      event.stopPropagation();
    });

    $("#store-slider-next").bind("click", function(event) {
      StoreItemsSlider.slideLeft();
      event.stopPropagation();
    });

  },

  init: function() {

    var listItem = $("ul#store-slider li");
    var storeSlider = $("ul#store-slider");
    this.listItemWidth = listItem.outerWidth() + parseInt(listItem.css('margin-right'));
    this.storeItemsCount = $('ul#store-slider').children().length;
    this.actualWidth = this.listItemWidth * this.storeItemsCount;
    this.visibleWidth = storeSlider.outerWidth();
    this.maxMargin = 0;
    var diff = this.visibleWidth - this.actualWidth;
    this.minMargin = diff < 0 ? diff : 0;
  },

  slideLeft: function() {
    this.init();
    var intendedMargin = this.currMarginLeft - this.listItemWidth;
    this.currMarginLeft = (intendedMargin > this.minMargin) ? intendedMargin : this.minMargin;
    this.currMarginLeft = (this.currMarginLeft - this.minMargin) < 50 ? this.minMargin : this.currMarginLeft;

    $("ul#store-slider").animate({
      marginLeft: this.currMarginLeft + "px"
    }, 1000);
  },

  slideRight: function() {
    this.init();
    var intendedMargin = this.currMarginLeft + this.listItemWidth;
    this.currMarginLeft = (intendedMargin < this.maxMargin) ? intendedMargin : this.maxMargin;
    this.currMarginLeft = this.currMarginLeft > -50 ? this.maxMargin : this.currMarginLeft;
    $("ul#store-slider").animate({
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
