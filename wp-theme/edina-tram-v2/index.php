<?php
/**
 * Edina Trâm V2 — index.php
 * Fallback template for the WordPress template hierarchy.
 */

get_header(); ?>

<div class="container" style="padding: 120px 0 60px;">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article>
      <h1><?php the_title(); ?></h1>
      <div><?php the_content(); ?></div>
    </article>
  <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>
