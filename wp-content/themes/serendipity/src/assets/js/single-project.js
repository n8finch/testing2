import $ from 'jquery';
import 'slick-carousel';

$(function() {
  if( $('body').hasClass('project-post') ){
    $('.slides').slick({
      dots: true,
      infinite: true,
      speed: 500,
      fade: true,
      cssEase: 'linear',
      lazyLoad: 'ondemand',
      nextArrow: '<div id="next"><i class="fa fa-angle-right"></i></div>',
      prevArrow: '<div id="prev"><i class="fa fa-angle-left"></i></div>'
    });


    $('.scroller').on( "click", function() {
      if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
        if (target.length) {
          $('html, body').animate({
            scrollTop: target.offset().top
          }, 1000);

          if( $(this).closest('#scroll-down').length == 1 ){
            $( "#scroll-down" ).fadeOut( "slow" );
            $( "#scroll-up" ).fadeIn( "slow" );
          }
          if( $(this).closest('#scroll-up').length == 1 ){
            $( "#scroll-up" ).fadeOut( "slow" );
            $( "#scroll-down" ).fadeIn( "slow" );
          }
          return false;
        }
      }
    });
  } // end of if body ==
});
