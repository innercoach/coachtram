<?php
/**
 * Edina Trâm V3 — index.php (fallback cho archive/blog/404).
 */
if (!defined('ABSPATH')) exit;
get_header();
?>
<section class="section">
  <div class="container">
    <?php if (have_posts()) : ?>
      <div class="section-header" data-reveal>
        <h1><?php echo esc_html(get_the_archive_title() ?: get_bloginfo('name')); ?></h1>
      </div>
      <div class="post-list">
        <?php while (have_posts()) : the_post(); ?>
          <article <?php post_class('post-card'); ?>>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="post-excerpt"><?php the_excerpt(); ?></div>
          </article>
        <?php endwhile; ?>
      </div>
      <?php the_posts_pagination(); ?>
    <?php else : ?>
      <div class="section-header" data-reveal>
        <h1>Không tìm thấy nội dung</h1>
        <p><a href="<?php echo esc_url(home_url('/')); ?>">← Về trang chủ</a></p>
      </div>
    <?php endif; ?>
  </div>
</section>
<?php get_footer();
