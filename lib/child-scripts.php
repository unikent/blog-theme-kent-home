<?php
/**
 * Scripts and stylesheets
 */
function child_scripts() {
  /**
   * The build task in Grunt renames production assets with a hash
   * Read the asset names from assets-manifest.json
   */
  if (WP_ENV === 'development' || WP_ENV === 'local') {
    $assets = array(
        'css'       => '/assets/css/main.css',
        'js'        => '/assets/js/scripts.js',
        'modernizr' => '/assets/vendor/modernizr/modernizr.js'
    );
  } else {
    $get_assets = file_get_contents(get_stylesheet_directory() . '/assets/manifest.json');
    $assets     = json_decode($get_assets, true);
    $assets     = array(
        'css'       => '/assets/css/main.min.css?' . $assets['assets/css/main.min.css']['hash'],
        'js'        => '/assets/js/scripts.min.js?' . $assets['assets/js/scripts.min.js']['hash'],
        'modernizr' => '/assets/js/vendor/modernizr.min.js',
    );
  }

  wp_enqueue_style('kentblogshome_css', get_stylesheet_directory_uri() . $assets['css'], false, null);

  wp_dequeue_script('modernizr');
  wp_deregister_script( 'modernizr' );
  wp_enqueue_script('modernizr', get_stylesheet_directory_uri() . $assets['modernizr'], array(), null, true);
  wp_enqueue_script('kentblogshome_js', get_stylesheet_directory_uri() . $assets['js'], array(), null, true);
  wp_localize_script('kentblogshome_js','AJAX',array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

    if(is_page_template('template-searchresults.php')) {
        wp_enqueue_script('gcse', get_stylesheet_directory_uri() . '/assets/js/gcse.js', array(), null, true);
    }
}
add_action('wp_enqueue_scripts', 'child_scripts', 101);

