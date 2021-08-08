<?php
  $has_thumbnail  = has_post_thumbnail() ? 'has-post-thumbnail' : '';
  $time_string    = get_the_time( get_option( 'date_format' ) );
  $posted_on      = '<a href="' . esc_url( get_permalink() ) . '" title="'. the_title_attribute('echo=0') . '">' . esc_html( $time_string ) . '</a> ';
?>

<div class="w-100 post-<?= get_the_ID() ?> post type-<?= get_post_type() ?> status-publish format-line <?= $has_thumbnail ?> hentry">
  <figure class="post-featured-image post-img-wrap">
    <a 
      title="<?= the_title() ?>" 
      href="<?= get_the_permalink() ?>"
      class="post-img" style="background-image: url( '<?= the_post_thumbnail_url() ?>' );"
    ></a>
    <!-- <div class="entry-meta category-meta">
      <div class="cat-links"><a href="http://paroquia.test/category/tech/" rel="category tag">Tech</a></div>
    </div> -->
  </figure><!-- .post-featured-image .post-img-wrap -->

  <header class="entry-header">
    <h2 class="entry-title">
      <a 
        href="<?= get_the_permalink() ?>"
        rel="bookmark"
      ><?= the_title() ?></a>
    </h2>
    <div class="entry-meta">
      <div class="date"><?= $posted_on ?></div>
    </div><!-- .entry-meta -->
    <div class="entry-content">
      <p><?= get_the_excerpt() ?></p>
    </div><!-- entry-content -->
  </header>
</div>