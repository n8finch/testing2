import $ from 'jquery';
import 'jquery-match-height';

$(function() {
  if( $('body').hasClass('homepage') ){

    var a = $('#words').children();
    var index = 0;
    run();
    function run() {
      a.filter('.active').fadeOut(1500).removeClass('active');
      setTimeout(function(){
        a.eq(index).fadeIn(1500).addClass('active');
      }, 3000);

      index = (index + 1) % a.length; // Wraps around if it hits the end
      setTimeout(run, 3000);
    }

    $('.image-container').matchHeight();
    $('.content-container').matchHeight();
  }
});
