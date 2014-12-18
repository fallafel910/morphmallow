 //var j$ = jQuery.noConflict();
//jQuery.noConflict();




j$(document).ready(function(){ 
/* back to top */
      j$(window).scroll(function(){
          if (j$(this).scrollTop() > 100) {
              j$('.scrollup').fadeIn();
          } else {
              j$('.scrollup').fadeOut();
          }
      }); 

      j$('.scrollup').click(function(){
          j$("html, body").animate({ scrollTop: 0 }, 600);
          return false;
      });

/* back to top */

/* comodo link */

j$('.comodo-link > a').hover(function(){
  var topcount = j$('#tl_popupSC5').innerHeight();
  j$('#tl_popupSC5').css('top',0-j$('#tl_popupSC5').innerHeight());
  console.log(0-j$('#tl_popupSC5').innerHeight()+'px !important');
})

j$('.comodo-link > a').focus(function(){
  var topcount = j$('#tl_popupSC5').innerHeight();
  j$('#tl_popupSC5').css('top',0-j$('#tl_popupSC5').innerHeight());
  console.log(0-j$('#tl_popupSC5').innerHeight()+'px !important');
})

/* comodo link  */

/* iframe open/close  */

j$('.footer-links-list ul li .blog-open-link').hover(function(){
  j$(this).next().show();
});


j$('.page').click(function(){
  j$('.footer-links-list ul li iframe').hide();
});

/* iframe open/close  */

/* marquee hover effect  */

j$('.category-spaghetti-headz .products-grid li.item').hover(
  function() {
    j$(this).find('.content_top .productgrid-area .productname marquee').attr('scrollamount',4);
  }, function() {
    j$(this).find('.content_top .productgrid-area .productname marquee').attr('scrollamount',0);
  }
);

/* marquee hover effect  */


/* hover effect on footer navigation link and another things, which connect with footer */  

        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
            j$('.social-icons-links li.fb-icons .fb-like-box').css({
              position:'static',
              display:'inline-block',
              margin:'10px auto'
            });

          j$( ".footer-newsletter-link" ).click(function() {
            j$('.footer-newsletter-link .block.block-subscribe').slideToggle( "slow" );
            j$('.footer-newsletter-link .block.block-subscribe').css({
              right:'0',
              left:'0',
              'margin-right':'0'
            });
          });

          j$('.footer-nav-link span').click(function(){
              j$('.footer-block-wrapper').slideToggle( "slow" );
                if (j$( window ).width()< 521) {
                j$('.footer-block-wrapper ul li:first-child').click(function(){
                    j$(this).nextAll().slideToggle( "slow" );
                });      
            };
          });


          j$( ".social-icons-links ul > li.fb-icons > div.fb-like" ).click(function() {
            j$('.social-icons-links li.fb-icons .fb-like-box').slideToggle( "slow" );
          }); 


                       
        }
        else {
          j$( ".footer-nav-link" ).hover(
            function() {
              j$('.footer-block-wrapper').show();
            }, function() {
              j$('.footer-block-wrapper').hide();
            }
          ); 

          j$( ".footer-newsletter-link" ).hover(
              function() {
                j$('.footer-newsletter-link .block.block-subscribe').show();
                j$('.footer-newsletter-link .block.block-subscribe').hover(function(){
                  j$(this).show();
                })
              }, function() {
                j$('.footer-newsletter-link .block.block-subscribe').hide();
              }
            );     

          j$( ".social-icons-links li.fb-icons .fb-like" ).hover(
            function() {
              j$('.social-icons-links li.fb-icons .fb-like-box').show();

                  j$( ".social-icons-links li.fb-icons .fb-like-box" ).hover(
                    function() {
                      j$('.social-icons-links li.fb-icons .fb-like-box').show();
                    }, function() {
                      j$('.social-icons-links li.fb-icons .fb-like-box').hide();
                    }
                  );

            }, function() {
              j$('.social-icons-links li.fb-icons .fb-like-box').hide();
            }
          );

          if (j$( window ).width()< 521) {
            j$('.footer-block-wrapper ul li:first-child').click(function(){
                j$(this).nextAll().slideToggle( "slow" );
            });      
          };
        }
 
        
/* hover effect on footer navigation link and another things, which connect with footer */

/* add class on top navigation links */
        var i = 0;
        j$('.menuwithlogo .header1 .links a').each(function(){
            j$(this).addClass('top-link-'+i);
            i++;
        })
/* add class on top navigation links */


        j$('.header .menuwithlogo .header1 li a[title="Log Out"]').addClass('static-log-out-link');
        j$('.header .menuwithlogo .header1 li a[title="Log In"]').removeClass('static-log-out-link');


        if (j$( window ).width()< 693) {
            j$('.header .mobile-size-loop > span').click(function(){               
                 if(j$('.header .top-search-box').hasClass('show_form')){
                        j$('.header .top-search-box').hide().removeClass('show_form');                 
                }else {
                     j$('.header .top-search-box').show().addClass('show_form');
                }
            })         
        };     
    });

/* menu responsive */

var ww = j$(window).width();

j$(document).ready(function() {
  j$("#nav li a").each(function() {
    if (j$(this).next().length > 0) {
    	j$(this).addClass("parent");
		};
	})
	
	j$(".toggleMenu").click(function(e) {
		e.preventDefault();
		j$(this).toggleClass("active");
		j$("#nav").toggle();
	});
	adjustMenu();
})

j$(window).bind('resize orientationchange', function() {
	ww = j$(window).width();
	adjustMenu();
});

var adjustMenu = function() {
	if (ww < 1200) {
    // if "more" link not in DOM, add it
    if (!j$(".more")[0]) {
    j$('<div class="more">&nbsp;</div>').insertBefore(j$('li a.parent')); 
    }
		j$(".toggleMenu").css("display", "inline-block");
		if (!j$(".toggleMenu").hasClass("active")) {
			j$("#nav").hide();
		} else {
			j$("#nav").show();
		}
		j$("#nav li").unbind('mouseenter mouseleave');
		j$("#nav li a.parent").unbind('click');
    j$("#nav li .more").unbind('click').bind('click', function() {
			
			j$(this).parent("li").toggleClass("hover");
		});
	} 
	else if (ww >= 1200) {
    // remove .more link in desktop view
    j$('.more').remove(); 
		j$(".toggleMenu").css("display", "none");
		j$("#nav").show();
		j$("#nav li").removeClass("hover");
		j$("#nav li a").unbind('click');
		j$("#nav li").unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
		 	// must be attached to li so that mouseleave is not triggered when hover over submenu
		 	j$(this).toggleClass('hover');
		});
	}
}

/* menu responsive */

jQuery(function(j$) {



// header fixed 

var myHeader = j$('.menuwithlogo');
myHeader.data( 'position', myHeader.position() );
j$(window).scroll(function(){
    var hPos = myHeader.data('position'), scroll = getScroll();
    if ( hPos.top < scroll.top ){
        myHeader.addClass('fixed');
        j$('#custommenu div.menu a').addClass('move-nav');
        j$('.header .additional-links-list').addClass('move-nav');
        j$('.small-logo').addClass('move-nav');
        j$('.header .form-search button.button span span i').addClass('move-nav');
    }
    else {
        myHeader.removeClass('fixed');
        j$('#custommenu div.menu a').removeClass('move-nav');
        j$('.header .additional-links-list').removeClass('move-nav');
        j$('.small-logo').removeClass('move-nav');
        j$('.header .form-search button.button span span i').removeClass('move-nav');
    }
});

function getScroll () {
    var b = document.body;
    var e = document.documentElement;
    return {
        left: parseFloat( window.pageXOffset || b.scrollLeft || e.scrollLeft ),
        top: parseFloat( window.pageYOffset || b.scrollTop || e.scrollTop )
    };
}

// header fixed 

});
