import $ from 'jquery';
import 'isotope-layout';

function getHashFilter() {
  var hash = location.hash;
  // get filter=filterName
  var matches = location.hash.match( /filter=([^&]+)/i );
  var hashFilter = matches && matches[1];
  return hashFilter && decodeURIComponent( hashFilter );
}

$(window).load(function() {
  if( $('body').hasClass('project-listing') ){
    // init Isotope
    var $grid = $('.grid').isotope({
      itemSelector: '.grid-item'
    });

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
