<?php
/*
Template Name: Videos Page
*/

get_header(); ?>

<div id="video-container">
  <div id="top-menu">
    <div class="top-menu-inner-container">
      <ul id="home-menu-ul" class="list-inline">
        <li class="home">
          <img class="center-me" src="images/store_icon-md.png">
        </li>
        <li class="share">

          <div class="share-menu-holder pull-right">
            <span class="shareImg"></span>
            <div id="share-menu">
              <ul class="list-inline" id="sprite-list">
                <li>
                  <span class="shareSprite facebook"></span>
                </li>
                <li>
                  <span class="shareSprite plus"></span>
                </li>
                <li>
                  <span class="shareSprite twitter"></span>
                </li>
                <li>
                  <span class="shareSprite mail"></span>
                </li>
              </ul>
            </div>
          </div>
          <p class="title pull-right center-me" id="top-menu-title"></p>
        </li>
      </ul>
    </div>
    <div class="store-slider-container">
      <div id="store-slider-prev" class="slider-btn"> </div>
      <div class="store-slider-inner-container">
        <ul id="store-slider">
          <li>
            <div class="store-list-item-container">
              <img src="store-images/store1-hi.png" class="store-item-img" />
              <a href="#" class="store-item-link"> Spaghetti Headz Christmas Pack</a>
              <h3 class="store-item-price"> $ 43</h3>
            </div>
          </li>

          <li>
            <div class="store-list-item-container">
              <img src="store-images/store2-hi.png" class="store-item-img" />
              <div class="inline-block"><a href="#" class="store-item-link"> Spaghetti Headz Lucky Charms 3-Pack</a>
                <h3 class="store-item-price"> $ 81</h3> </div>
            </div>
          </li>

          <li>
            <div class="store-list-item-container">
              <img src="store-images/store3-hi.png" class="store-item-img" />
              <a href="#" class="store-item-link"> Spaghetti Headz Christmas Pack</a>
              <h3 class="store-item-price"> Rs 81</h3>
            </div>
          </li>

          <li>
            <div class="store-list-item-container">
              <img src="store-images/store4-hi.png" class="store-item-img" />
              <a href="#" class="store-item-link"> Spaghetti Headz Christmas Pack</a>
              <h3 class="store-item-price"> Rs 100</h3>
            </div>
          </li>

          <li>
            <div class="store-list-item-container">
              <img src="store-images/store1-hi.png" class="store-item-img" />
              <a href="#" class="store-item-link"> Spaghetti Headz Christmas Pack</a>
              <h3 class="store-item-price"> $ 43</h3>
            </div>
          </li>

          <li>
            <div class="store-list-item-container">
              <img src="store-images/store1-hi.png" class="store-item-img" />
              <a href="#" class="store-item-link"> Spaghetti Headz Christmas Pack</a>
              <h3 class="store-item-price"> $ 43</h3>
            </div>
          </li>

          <li>
            <div class="store-list-item-container">
              <img src="store-images/store1-hi.png" class="store-item-img" />
              <a href="#" class="store-item-link"> Spaghetti Headz Christmas Pack</a>
              <h3 class="store-item-price"> $ 43</h3>
            </div>
          </li>
        </ul>
      </div>
      <div id="store-slider-next" class="slider-btn"></div>
    </div>
  </div>

  <div id="play" class="playable-element control-button"></div>
  <div id="thumbnail" class="playable-element"></div>
  <div id="player" style="display:none"></div>
  <div id="fullscreen" class="control-button"></div>

  <div class="hover-container next-hover">
    <div class="video-img-container next-video">
      <div class="img-container center-me img-container-right" id="showNext"></div>
      <div class="title-container  next-title">
        <div class="page-header">
          <p class="text-left">NEXT VIDEO</p>
        </div>
        <p id="nextVideoTitle" class="text-left">Next Video Title goes here</p>
        <p class="author">By Morphmallow</p>
      </div>
    </div>
    <div class="control-button-container next-control">
      <div class="button-container center-me" id="next"></div>
    </div>
  </div>

  <div class="hover-container prev-hover">
    <div class="control-button-container prev-control">
      <div class="button-container center-me" id="prev"></div>
    </div>
    <div class="video-img-container prev-video">
      <div class="title-container  prev-title">
        <div class="page-header">
          <p class="text-right">PREV VIDEO</p>
        </div>
        <p id='prevVideoTitle' class="text-right">Prev Video Title goes here</p>
        <p class="author text-right">By Morphmallow</p>
      </div>
      <div class="img-container center-me img-container-left" id="showPrev"></div>
    </div>
  </div>
  <div class="slider-container clear">
    <ul id="video-list-slider">
    </ul>
    <div id="slider-prev-button" class="slider-button"> </div>
    <div id="slider-next-button" class="slider-button"> </div>
  </div>
</div>
<div class='video-list'>
  <div class="slide-toggle">
    <span class="glyphicon glyphicon-th slide-toggle-glyphicon"></span>
  </div>
  <div class="video-grid-wrapper">
    <div class='toggle-content'>
      <div class="promo-menu">
        <ul class="menu-blocks center-block row" style="100%">
          <li class="">Promo Videos</li>
          <li class="">Product Videos</li>
          <li class="">As Seen On..</li>
          <li class="">Tutorials</li>
        </ul>
      </div>
      <div class="grid-view-container">
        <ul id="videos-grid-view" class="row effect-3">
        </ul>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
