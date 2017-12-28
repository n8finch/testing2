import $ from 'jquery';

$(function() {
  if( $('body').hasClass('team-page') ){

    $('.member').on( "click", ".setting", function() {
      var name = $( this ).data( "name" ),
          type = $( this ).data( "type" ),
          currentType = $( this ).closest('.row').data('current-type');

      $('#'+ name + ' .' + currentType).fadeOut('slow', function(){
          $('#'+ name + ' .' + type).removeClass('hide').fadeIn('slow');
      });
    })
  }
});
