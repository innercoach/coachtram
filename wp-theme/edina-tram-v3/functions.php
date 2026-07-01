<?php
/**
 * Edina Trâm V3 — functions.php
 * Theme setup, asset enqueueing, section-library helper.
 *
 * Kiến trúc: header.php/footer.php lo phần khung; các section dùng lại nằm
 * trong template-parts/sections/ và được nạp qua get_template_part() với $args
 * (tương đương <site-section> ở bản HTML tĩnh).
 */

if (!defined('ABSPATH')) exit;

/* ============================================================
   1. THEME SETUP
   ============================================================ */
add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('automatic-feed-links');
    add_theme_support('responsive-embeds');

    register_nav_menus([
        'primary' => __('Menu chính', 'edina-tram-v3'),
    ]);
});


/* ============================================================
   2. ENQUEUE ASSETS
   ============================================================ */
add_action('wp_head', function () {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}, 1);

add_action('wp_enqueue_scripts', function () {
    $v   = wp_get_theme()->get('Version');
    $uri = get_template_directory_uri();
    $css = $uri . '/assets/css';

    // Google Fonts — single canonical request (design-system.css có @import fonts riêng,
    // nhưng ta enqueue tường minh để kiểm soát preconnect + cache-busting).
    wp_enqueue_style('edt-fonts',
        'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600&family=Be+Vietnam+Pro:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400&display=swap',
        [], null
    );

    wp_enqueue_style('edt-design-system', $css . '/design-system.css', ['edt-fonts'], $v);
    wp_enqueue_style('edt-components',    $css . '/components.css',    ['edt-design-system'], $v);
    wp_enqueue_style('edt-animations',    $css . '/animations.css',    ['edt-design-system'], $v);
    wp_enqueue_style('edt-backgrounds',   $css . '/backgrounds.css',   ['edt-design-system'], $v);
    wp_enqueue_style('edt-home',          $css . '/pages/home.css',    ['edt-components'], $v);
    wp_enqueue_style('edt-service',       $css . '/pages/service.css', ['edt-components'], $v);
    wp_enqueue_style('edt-contact',       $css . '/pages/contact.css', ['edt-components'], $v);

    // Theme JS — deferred (nav, reveal, FAQ, counter, scroll-top…)
    wp_enqueue_script('edt-main', $uri . '/assets/js/main.js', [], $v, ['in_footer' => true, 'strategy' => 'defer']);
});


/* ============================================================
   3. HELPERS
   ============================================================ */

/**
 * URL của một asset trong theme, vd: edt_asset('images/profile.jpg').
 */
function edt_asset($path) {
    return esc_url(get_template_directory_uri() . '/' . ltrim($path, '/'));
}

/**
 * Nạp một section trong thư viện template-parts/sections/.
 * Tương đương <site-section name="..."> ở bản HTML tĩnh.
 *
 *   edt_section('instructor', ['label' => 'Người đồng hành', 'alt' => '...']);
 */
function edt_section($name, $args = []) {
    get_template_part('template-parts/sections/' . $name, null, $args);
}

/**
 * Slug của page đang hiển thị (để đánh dấu menu active).
 */
function edt_current_slug() {
    if (!is_page()) return '';
    return (string) get_post_field('post_name', get_queried_object_id());
}
