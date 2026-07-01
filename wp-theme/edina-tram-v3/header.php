<?php
/**
 * Edina Trâm V3 — header.php
 * Chrome dùng chung: <head>, thanh điều hướng, noscript, mở <main> + glow-blobs.
 */
if (!defined('ABSPATH')) exit;

$slug = edt_current_slug();
$nav = [
    ['url' => home_url('/'),                     'label' => 'Trang chủ',          'active' => is_front_page()],
    ['url' => home_url('/cau-chuyen-cua-toi/'),  'label' => 'Câu chuyện của tôi', 'active' => $slug === 'cau-chuyen-cua-toi'],
    ['url' => home_url('/bai-viet-cua-tram/'),   'label' => 'Bài viết của Trâm',  'active' => $slug === 'bai-viet-cua-tram'],
    ['url' => home_url('/dich-vu-1/'),           'label' => 'TINA Awareness',     'active' => $slug === 'dich-vu-1'],
    ['url' => home_url('/dich-vu-2/'),           'label' => 'TINA Awakening',     'active' => $slug === 'dich-vu-2'],
    ['url' => home_url('/dich-vu-3/'),           'label' => 'TINA Alignment',     'active' => $slug === 'dich-vu-3'],
];
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
    <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-logo">Edina <span>Trâm</span></a>
    <button class="nav-toggle" aria-label="Toggle navigation" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>
    <nav class="nav-links">
      <?php foreach ($nav as $item) : ?>
        <a href="<?php echo esc_url($item['url']); ?>"<?php echo $item['active'] ? ' class="active"' : ''; ?>><?php echo esc_html($item['label']); ?></a>
      <?php endforeach; ?>
    </nav>
  </div>
</header>

<noscript>
  <div style="background:#06513c;color:#fff;text-align:center;padding:.6rem 1rem;font-size:.9rem;">
    Trang hiển thị đầy đủ hơn khi bật JavaScript.
    <a href="<?php echo esc_url(home_url('/')); ?>" style="color:#F1D89A;">Trang chủ</a> ·
    <a href="<?php echo esc_url(home_url('/cau-chuyen-cua-toi/')); ?>" style="color:#F1D89A;">Câu chuyện</a> ·
    <a href="<?php echo esc_url(home_url('/dich-vu-2/')); ?>" style="color:#F1D89A;">TINA Awakening</a> ·
    <a href="<?php echo esc_url(home_url('/lien-he/')); ?>" style="color:#F1D89A;">Liên hệ</a>
  </div>
</noscript>

<main>
  <!-- Decorative glow blobs -->
  <div class="glow-blob glow-blob--gold glow-blob--1" aria-hidden="true"></div>
  <div class="glow-blob glow-blob--emerald glow-blob--2" aria-hidden="true"></div>
