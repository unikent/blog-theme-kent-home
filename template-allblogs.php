<?php
/*
Template Name: Blogs List
*/

$blogs = wp_get_sites(array('public'=>true,'deleted'=>false,'spam'=>false,'limit'=>1000));
?>
<script>
    jQuery(document).ready(function($) {
        $('#allblogs').DataTable({
            paging: false
        } );
    });
</script>
<style>
    .dataTables_wrapper .dataTables_filter{
        float:left;
        width:100%;
        text-align: left;
    }
</style>
<table class="table table-striped" id="allblogs">
    <thead>
    <tr>
        <th>Blog Name</th>
        <th>Description</th>
        <th style="width:12%">Created Date</th>
        <th style="width:12%">Last Updated</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i=0;
    foreach($blogs as $blog){

        if($blog['blog_id']==1) continue;

        switch_to_blog($blog['blog_id']);
?>
    <tr>
        <td><a href="<?php echo get_bloginfo('url');?>" title="<?php echo esc_attr(get_bloginfo('title'));?>"><?php echo get_bloginfo('title'); ?></a></td>
        <td><?php echo strlen(get_bloginfo('description'))>255?substr(get_bloginfo('description'),0,255) . '&hellip; ':get_bloginfo('description'); ?></td>
        <td><?php echo date('d M Y',strtotime($blog['registered'])); ?></td>
        <td><?php echo date('d M Y',strtotime($blog['last_updated'])); ?></td>
    </tr>
    <?php
        restore_current_blog();
    }
    ?>
    </tbody>
</table>

