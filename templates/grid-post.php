<article class="grid-post">
    <div class="grid-post-img">
        <a title="<?php echo esc_attr($post['title']); ?>" href="<?php echo $post['permalink']; ?>"><img class="img-responsive" src="<?php echo preg_replace('/\/wp-content\/blogs.dir\/\d+/','',$post['featured_image']['sizes']['large']['url']); ?>"></a>
    </div>
    <header>
        <h2 class="entry-title"><a title="<?php echo esc_attr($post['title']); ?>" href="<?php echo $post['permalink']; ?>"><?php echo $post['title']; ?></a></h2>
        <p class="byline"><a class="blog-source" href="<?php echo get_site_url($post['blog_id']); ?>" rel="source"><?php echo $post['blog_name']; ?></a> | <time class="updated" datetime="<?php echo $post['date']; ?>"><?php echo str_replace(' ','&nbsp',date('d F Y',$post['date'])); ?></time></p>
    </header>
    <div class="entry-content">
        <?php echo apply_filters('the_excerpt',wp_trim_words(trim($post['excerpt']), roots_excerpt_length(25) ,roots_excerpt_more())); ?>
    </div>
</article>