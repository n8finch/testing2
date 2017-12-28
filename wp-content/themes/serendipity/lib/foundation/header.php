<?php
//* Remove Skip Links
remove_action ( 'genesis_before_header', 'genesis_skip_links', 5 );

remove_action( 'genesis_header', 'genesis_do_header');
add_action( 'genesis_header', 'ygf_do_header' );
/**
 * Echo the default header, including the #title-area div, along with #title and #description, as well as the .widget-area.
 *
 * Does the `genesis_site_title`, `genesis_site_description` and `genesis_header_right` actions.
 *
 * @since 1.0.2
 *
 * @global $wp_registered_sidebars Holds all of the registered sidebars.
 *
 * @uses genesis_markup() Apply contextual markup.
 */

function contact_us_li(){
	$str = '<li class="';

	// force active state if on contact page
	if( is_page( 'contact' ) ){
		$str .= 'active';
	}

	$str .= '"><a href="'.genesis_get_option( 'contact_url' ).'" class="contact-us-span">
			<span>Contact</span>
		</a>
	</li>';

	return $str;
}

function ygf_do_header() {

	global $wp_registered_sidebars;

	/**
	* OLD: the homepage logo swapping is handled via javascript. I have no idea why, but genesis
	* does not allow for multiple $logo vars, but it does require a $logo. Only the $logo with
	* the the_custom_logo function runs. the javascript handling the swap is under /src/assets/js/home.js
  *
	* NEW AS OF 10/30/2016: The logo is hardcoded because of the above behavior.
  *
	* NEW AS OF 10/31/2016: The logo swapping is removed with the standardization of the topbar across devices.
	*
	**/
	$logo = get_stylesheet_directory_uri().'/dist/assets/img/sc-logo-white-orange-i.svg';

	// allow for top-of-page scroller
	echo '<section id="top-of-page">';

	// tablet and up navigation (uses same wp menu as mobile)
	echo '
		<section id="large-menu" class="top-bar">
		  <div class="top-bar-left">
				<div id="logo-container" class="float-left">
					<a href="/"><img src="'.$logo.'" alt="'.get_bloginfo( 'name' ).'"/></a>
				</div>
		    <ul class="dropdown menu float-right" data-dropdown-menu>';

				$args = array(
					'menu' => 'Large Menu',
					'container' => '',
					'items_wrap' => '%3$s',
				);
				wp_nav_menu($args);

				echo contact_us_li();

	echo '
					<li>
						<a href="https://twitter.com/serendipitycre8" target="_blank" class="blue-twitter-icon">
							<i class="fa fa-twitter"></i>
						</a>
					</li>
				</ul>
		  </div>
		</section>
	';

	// mobile navigation (uses same wp menu as tablet and up)
  echo '
	<section id="mobile-menu" class="top-bar">
		<a href="/" class="custom-logo-link" rel="home" itemprop="url">
			<img src="'.$logo.'" class="custom-logo" itemprop="logo">
		</a>';

	genesis_markup( array(
		'html5'   => '<ul %s>',
		'xhtml'   => '<div id="title-area">',
		'context' => 'title-area',
	) );
	do_action( 'genesis_site_title' );
	do_action( 'genesis_site_description' );
	genesis_markup( array(
		'html5'   => '</ul>',
		'xhtml'   => '</div>',
  ));

  echo '
		<aside id="header-right">
			<ul>
			'.contact_us_li().'
			</ul>
		</aside>
	</section>
	</section> <!-- end #top-of-page -->
	';

}

remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
add_action( 'genesis_site_title', 'ygf_seo_site_title' );
/**
 * Echo the site title into the header.
 *
 * Depending on the SEO option set by the user, this will either be wrapped in an `h1` or `p` element.
 *
 * Applies the `genesis_seo_title` filter before echoing.
 *
 * @since 1.1.0
 *
 * @uses genesis_get_seo_option() Get SEO setting value.
 * @uses genesis_html5()          Check or HTML5 support.
 */
function ygf_seo_site_title() {

        if(has_nav_menu('topbar-off-canvas')){
          $title = '<li>
					<button id="menu-icon" data-toggle="offCanvas" aria-expanded="false" aria-controls="offCanvas">
					<i class="fa fa-bars"></i>
					</button>
					</li>';
				}

        // Echo (filtered)
        echo apply_filters( 'genesis_seo_title', $title );

}
