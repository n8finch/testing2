<?php

add_filter( 'the_content_more_link', 'ygf_more_tag_excerpt_link' );
/**
 * Customize the excerpt text, when using the <!--more--> tag
 *
 * See: http://my.studiopress.com/snippets/post-excerpts/
 *
 * @since 2.0.16
 */
function ygf_more_tag_excerpt_link() {

	return ' <p><a class="more-link button flat" href="' . get_permalink() . '">'.__("Read More", 'foundy-genesix' ).'</a></p>';

}

add_filter( 'excerpt_more', 'ygf_truncated_excerpt_link' );
add_filter( 'get_the_content_more_link', 'ygf_truncated_excerpt_link' );
/**
 * Customize the excerpt text, when using automatic truncation
 *
 * See: http://my.studiopress.com/snippets/post-excerpts/
 *
 * @since 2.0.16
 */
function ygf_truncated_excerpt_link() {

	return '... <p><a class="more-link waves-effect waves-light" href="' . get_permalink() . '">'.__("Read More", 'foundy-genesix' ).'</a></p>';

}

/**
 *
 * Add flex-video wrapper to oembeded items
 *
 **/

function ygf_embed_filter( $html, $url, $attr ) {
    $yt = "/(?:https?:\\/\\/)?(?:www\\.)?(?:youtu\\.be\\/|youtube\\.com\\/(?:embed\\/|v\\/|playlist\\?|watch\\?v=|watch\\?.+(?:&|&#38;);v=))([a-zA-Z0-9\\-_]{11})?(?:(?:\\?|&|&#38;)index=((?:\\d){1,3}))?(?:(?:\\?|&|&#38;)?list=([a-zA-Z\\-_0-9]{34}))?(?:\\S+)?/";

    $vm = "/(?:https?:\/\/)?(?:www\.)?(?:vimeo\.com\/)((?:\d){1,3})?(?:\S+)?/";

    if(preg_match_all($yt, $url, $matches))
       $html = '<div class="flex-video">'. $html .'</div>';
    if(preg_match_all($vm, $url, $matches))
       $html = '<div class="flex-video vimeo">'. $html .'</div>';

    return $html;
}
add_filter('embed_oembed_html', 'ygf_embed_filter', 90, 3 );
