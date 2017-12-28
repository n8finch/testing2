import $ from 'jquery';
import 'jquery-match-height';

$(function() {
  if( $('body').hasClass('client-page') ){
    $('.point').matchHeight();
  }
});
