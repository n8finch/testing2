<?php

add_action('wp_head', 'ygf_add_responsive_meta', 2);

function ygf_add_responsive_meta(){
  echo '
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">';
}
