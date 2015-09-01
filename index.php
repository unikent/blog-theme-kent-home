<?php get_template_part('templates/page', 'header');

$popular = kentblogs_popular_get_posts();

?>
<div class="posts well popular">
    <h2 class="h1">Trending posts</h2>
    <div class="posts">
        <?php foreach($popular as $post){
            include('templates/grid-post.php');
        } ?>
    </div>
</div>

<?php
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
<h2 class="h1" >Latest Posts</h2>
<div class="posts latest">
    <?php foreach($aggregate_data as $post){
        include('templates/grid-post.php');
    } ?>
    <div id="latest-foot" class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <button class="btn btn-kent btn-lg btn-block more-results" id="more-button" type="button" data-page="1">Show more <i class="kf-spinner kf-spin" id="more-spinner" style="display: none;"></i></button>
        </div>
    </div>
</div>