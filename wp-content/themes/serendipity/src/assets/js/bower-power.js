/**
* NOTE: This file only exists because you couldn't get
* jquery-lazy or isotopic to work with webpack js.
*
* TODO: Do this correctly.
*
*/

$(function() {
    $('.lazy').append(
      "<div class='loading-image'><div class='uil-default-css' style='transform:scale(0.3);'><div style='top:80px;left:93px;width:14px;height:40px;background:#ff7862;-webkit-transform:rotate(0deg) translate(0,-60px);transform:rotate(0deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#ff7862;-webkit-transform:rotate(30deg) translate(0,-60px);transform:rotate(30deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#ff7862;-webkit-transform:rotate(60deg) translate(0,-60px);transform:rotate(60deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#ff7862;-webkit-transform:rotate(90deg) translate(0,-60px);transform:rotate(90deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#ff7862;-webkit-transform:rotate(120deg) translate(0,-60px);transform:rotate(120deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#ff7862;-webkit-transform:rotate(150deg) translate(0,-60px);transform:rotate(150deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#ff7862;-webkit-transform:rotate(180deg) translate(0,-60px);transform:rotate(180deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#ff7862;-webkit-transform:rotate(210deg) translate(0,-60px);transform:rotate(210deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#ff7862;-webkit-transform:rotate(240deg) translate(0,-60px);transform:rotate(240deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#ff7862;-webkit-transform:rotate(270deg) translate(0,-60px);transform:rotate(270deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#ff7862;-webkit-transform:rotate(300deg) translate(0,-60px);transform:rotate(300deg) translate(0,-60px);border-radius:10px;position:absolute;'></div><div style='top:80px;left:93px;width:14px;height:40px;background:#ff7862;-webkit-transform:rotate(330deg) translate(0,-60px);transform:rotate(330deg) translate(0,-60px);border-radius:10px;position:absolute;'></div></div></div>"
    );
    $('.lazy').Lazy({
      afterLoad: function(element) {
        $('.loading-image').remove();
      },
    });
});

function getHashFilter() {
  var hash = location.hash;
  // get filter=filterName
  var matches = location.hash.match( /filter=([^&]+)/i );
  var hashFilter = matches && matches[1];
  return hashFilter && decodeURIComponent( hashFilter );
}

$(function() {
  if( $('body').hasClass('project-listing') ){
    // init Isotope
    var $grid = $('.grid').isotope({});

    var $filters = $('.filter-projects');

    // filter items on button click
    $filters.on( 'click', '.filter', function() {
      var filterValue = $(this).attr('data-filter');
      $grid.isotope({ filter: filterValue });
      $('.filter').removeClass('active');
      $(this).addClass('active');

      var filterAttr = $( this ).attr('data-filter');
      // set filter in hash
      location.hash = 'filter=' + encodeURIComponent( filterAttr );
    });

    var isIsotopeInit = false;

    function onHashchange() {
      var hashFilter = getHashFilter();
      if ( !hashFilter && isIsotopeInit ) {
        return;
      }
      isIsotopeInit = true;
      // filter isotope
      $grid.isotope({
        itemSelector: '.grid-item',
        filter: hashFilter
      });
      // set selected class on button
      if ( hashFilter ) {
        $filters.find('.active').removeClass('active');
        $filters.find('[data-filter="' + hashFilter + '"]').addClass('active');
      }
    }

    $(window).on( 'hashchange', onHashchange );
    // trigger event handler to init Isotope
    onHashchange();
  }
});
