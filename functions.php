<?php

include "lib/child-scripts.php";

remove_filter( 'the_content', 'rc_process_post' );

add_action( 'wp_ajax_get_latest', 'get_latest_posts' );
add_action( 'wp_ajax_nopriv_get_latest', 'get_latest_posts' );

function get_latest_posts(){

$aggregate_data = get_site_option('wp-multisite-post-aggregate');

if($aggregate_data === false){
    $aggregate_data = kentblogs_aggregator_init_posts();
}
$p=1;
if(isset($_REQUEST['page']) && is_numeric($_REQUEST['page']) && intval($_REQUEST['page'])<=10){
    $p = intval($_REQUEST['page']);
}
$aggregate_data = array_slice($aggregate_data,(($p-1)*6),6);
?>
<?php foreach($aggregate_data as $post){
include('templates/grid-post.php');
}
    wp_die();
}

add_filter('roots/display_sidebar', 'kentblogshome_show_sidebar',11,1);

function kentblogshome_show_sidebar($display)
{
    $sidebar_config = new Roots_Sidebar(
    /**
     * Conditional tag checks (http://codex.wordpress.org/Conditional_Tags)
     * Any of these conditional tags that return true won't show the sidebar
     *
     * To use a function that accepts arguments, use the following format:
     *
     * array('function_name', array('arg1', 'arg2'))
     *
     * The second element must be an array even if there's only 1 argument.
     */
        array(
            'is_404',
            'is_home'
        ),
        /**
         * Page template checks (via is_page_template())
         * Any of these page templates that return true won't show the sidebar
         */
        array(
            'template-allblogs.php',
            'template-searchresults.php'
        )
    );

    return $display && $sidebar_config->display;
}