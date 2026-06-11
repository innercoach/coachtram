<?php
/**
 * Edina Trâm V2 — header.php
 * Site-wide header: logo, navigation, CTA, glow blobs.
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- ═══ HEADER ═══ -->
<header class="site-header">
  <div class="container nav">

    <!-- Logo -->
    <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-logo">
      <?php
      $logo_img_id = get_option('edt_logo_image', '');
      if ($logo_img_id) {
          $logo_src = wp_get_attachment_image_src(absint($logo_img_id), 'full');
          if ($logo_src) {
              echo '<img src="' . esc_url($logo_src[0]) . '" alt="' . esc_attr(get_bloginfo('name')) . '">';
          } else {
              echo wp_kses_post(get_option('edt_logo_text', 'Edina <span>Trâm</span>'));
          }
      } else {
          echo wp_kses_post(get_option('edt_logo_text', 'Edina <span>Trâm</span>'));
      }
      ?>
    </a>

    <!-- Mobile toggle -->
    <button class="nav-toggle" aria-label="Toggle navigation" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>

    <!-- Navigation -->
    <nav class="nav-links">
      <?php
      $is_home = is_front_page();
      $pages = [
          ['url' => home_url('/'),            'label' => 'Trang chủ',          'active' => $is_home],
          ['url' => home_url('/#services'),   'label' => 'Dịch vụ',            'active' => false],
          ['url' => home_url('/dich-vu-1/'),  'label' => 'Passion to Profit',   'active' => is_page('dich-vu-1')],
          ['url' => home_url('/dich-vu-2/'),  'label' => 'Business to Freedom', 'active' => is_page('dich-vu-2')],
          ['url' => home_url('/dich-vu-3/'),  'label' => 'Business Mastery',    'active' => is_page('dich-vu-3')],
      ];
      foreach ($pages as $p) :
      ?>
        <a href="<?php echo esc_url($p['url']); ?>"<?php echo $p['active'] ? ' class="active"' : ''; ?>><?php echo esc_html($p['label']); ?></a>
      <?php endforeach; ?>

      <span class="nav-cta">
        <?php
        $cta_label = get_option('edt_header_cta_label', 'Đặt lịch Tư vấn');
        $cta_url   = get_option('edt_header_cta_url', '');
        if (!$cta_url) {
            $cta_url = home_url('/lien-he/');
        }
        ?>
        <a href="<?php echo esc_url($cta_url); ?>" class="btn btn--accent"><?php echo esc_html($cta_label); ?></a>
      </span>
    </nav>

  </div>
</header>

<main>

  <!-- Decorative glow blobs -->
  <div class="glow-blob glow-blob--gold glow-blob--1" aria-hidden="true"></div>
  <div class="glow-blob glow-blob--emerald glow-blob--2" aria-hidden="true"></div>
