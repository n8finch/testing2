import $ from 'jquery';
import 'jquery-match-height';
import 'slick-carousel';

$(function() {
  if( $('body').hasClass('about-page') ){

    $('#testimonials .row').slick({
      dots: false,
      infinite: true,
      speed: 500,
      fade: true,
      // adaptiveHeight: true, # this should not be used since it throws off the height calculations
      cssEase: 'linear',
      nextArrow: '<div id="next"><i class="fa fa-angle-right"></i></div>',
      prevArrow: '<div id="prev"><i class="fa fa-angle-left"></i></div>',
    });

    $('.point').matchHeight();
  }
});
