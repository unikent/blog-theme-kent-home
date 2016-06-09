<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/search')); ?>">
  <label class="sr-only"><?php _e('Search for:', 'roots'); ?></label>
  <div class="input-group">
    <input type="search" value="<?php echo htmlspecialchars(isset($_REQUEST['q'])?$_REQUEST['q']:''); ?>" name="q" class="search-field form-control" placeholder="Search all blogs" required>
    <span class="input-group-btn">
      <button type="submit" class="search-submit btn btn-default"><span class="sr-only"><?php _e('Search', 'roots'); ?></span><i class="kf-search"></i></button>
    </span>
  </div>
</form>
