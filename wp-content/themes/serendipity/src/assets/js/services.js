import $ from 'jquery';
import 'jquery-match-height';

$(function() {
  if( $('body').hasClass('services-page') ){
    $('.point').matchHeight();
  }
});
