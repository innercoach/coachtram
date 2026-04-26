<?php
/**
 * Coach Loan Vu – functions.php
 * Core theme setup: enqueue scripts/styles, ACF field groups,
 * Options page, navigation menus, and helper utilities.
 */

defined('ABSPATH') || exit;

/* ============================================================
   1. THEME SETUP
   ============================================================ */
add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
    add_theme_support('responsive-embeds');

    register_nav_menus([
        'primary' => __('Primary Navigation', 'coach-loan-vu'),
        'footer'  => __('Footer Navigation', 'coach-loan-vu'),
    ]);

    load_theme_textdomain('coach-loan-vu', get_template_directory() . '/languages');
});


/* ============================================================
   2. ENQUEUE SCRIPTS & STYLES
   ============================================================ */
add_action('wp_enqueue_scripts', function () {
    $ver = wp_get_theme()->get('Version');

    // Main stylesheet (contains WP theme header – required)
    wp_enqueue_style(
        'clv-main',
        get_stylesheet_uri(),
        [],
        $ver
    );

    // Per-page inline CSS is injected via page templates
    // (each service page has its own <style> block kept inline for specificity)

    // Main JS
    wp_enqueue_script(
        'clv-main-js',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        $ver,
        true  // load in footer
    );

    // Pass WP data to JS if needed
    wp_localize_script('clv-main-js', 'clvData', [
        'homeUrl' => esc_url(home_url('/')),
        'ajaxUrl' => admin_url('admin-ajax.php'),
    ]);
});


/* ============================================================
   3. ACF LOCAL JSON – READ/SAVE LOCATION
   ============================================================ */
// Save field group JSON to theme's acf-json folder (for version control)
add_filter('acf/settings/save_json', function () {
    return get_template_directory() . '/acf-json';
});

// Load field groups from that same folder
add_filter('acf/settings/load_json', function ($paths) {
    $paths[] = get_template_directory() . '/acf-json';
    return $paths;
});


/* ============================================================
   4. ACF OPTIONS PAGE (Global Site Settings)
   ============================================================ */
add_action('acf/init', function () {
    if (!function_exists('acf_add_options_page')) {
        return; // ACF Pro not active
    }

    acf_add_options_page([
        'page_title'  => 'Cài đặt Website',
        'menu_title'  => 'Cài đặt Website',
        'menu_slug'   => 'clv-site-settings',
        'capability'  => 'edit_posts',
        'icon_url'    => 'dashicons-admin-site-alt3',
        'position'    => 30,
        'redirect'    => false,
    ]);
});


/* ============================================================
   5. HELPER FUNCTIONS
   ============================================================ */

/**
 * Safe ACF get_field() wrapper.
 * Returns $default if ACF is not active or field is empty.
 *
 * @param string $key     ACF field key or name.
 * @param mixed  $post_id Post ID or 'option' for Options page.
 * @param mixed  $default Fallback value.
 * @return mixed
 */
function clv_field(string $key, $post_id = null, $default = '') {
    if (!function_exists('get_field')) {
        return $default;
    }
    $value = get_field($key, $post_id);
    return ($value !== null && $value !== '' && $value !== false) ? $value : $default;
}

/**
 * Safe ACF get_sub_field() wrapper (use inside have_rows loops).
 */
function clv_sub(string $key, $default = '') {
    if (!function_exists('get_sub_field')) {
        return $default;
    }
    $value = get_sub_field($key);
    return ($value !== null && $value !== '' && $value !== false) ? $value : $default;
}

/**
 * Options page field shortcut.
 */
function clv_option(string $key, $default = '') {
    return clv_field($key, 'option', $default);
}

/**
 * Render an ACF image field as <img> tag.
 *
 * @param string|array $image  ACF image array or URL string.
 * @param string       $alt    Alt text fallback.
 * @param string       $class  CSS classes.
 * @param string       $size   WP image size (thumbnail, medium, large, full).
 */
function clv_img($image, string $alt = '', string $class = '', string $size = 'full', string $extra = ''): void {
    if (empty($image)) return;

    if (is_array($image)) {
        $url    = $image['sizes'][$size] ?? $image['url'] ?? '';
        $srcalt = $image['alt'] ?: $alt;
        $w      = $image['width']  ?? '';
        $h      = $image['height'] ?? '';
    } else {
        $url    = $image;
        $srcalt = $alt;
        $w = $h = '';
    }

    if (empty($url)) return;

    $dimensions = ($w && $h) ? " width=\"{$w}\" height=\"{$h}\"" : '';
    $classattr  = $class ? " class=\"{$class}\"" : '';
    echo "<img src=\"" . esc_url($url) . "\" alt=\"" . esc_attr($srcalt) . "\"{$classattr}{$dimensions} {$extra}>";
}

/**
 * Render external URL safely.
 */
function clv_url(string $key, $post_id = null, string $default = '#'): string {
    $val = clv_field($key, $post_id, $default);
    return esc_url($val ?: $default);
}

/**
 * Output escaped text field.
 */
function clv_e(string $key, $post_id = null, string $default = ''): void {
    echo esc_html(clv_field($key, $post_id, $default));
}

/**
 * Output raw (WYSIWYG) field.
 */
function clv_html(string $key, $post_id = null, string $default = ''): void {
    echo wp_kses_post(clv_field($key, $post_id, $default));
}


/* ── BUNDLED THEME IMAGES ───────────────────────────────────────────────────
 * Images are included in assets/images/ inside the theme folder so the site
 * works out of the box without requiring the client to upload anything first.
 * The client can still override images via ACF fields at any time.
 * ──────────────────────────────────────────────────────────────────────────── */

/**
 * Return the absolute URL to a bundled theme image.
 *
 * @param string $path  Relative path inside assets/images/, e.g. 'dv1/hero-coach.png'
 * @return string
 */
function clv_theme_img_url(string $path): string {
    return get_template_directory_uri() . '/assets/images/' . ltrim($path, '/');
}

/**
 * Render an ACF image field with automatic fallback to a bundled theme image.
 *
 * @param string $key           ACF field key.
 * @param mixed  $post_id       Post ID or null.
 * @param string $fallback_path Relative path inside assets/images/ used when ACF field is empty.
 * @param string $alt           Alt text.
 * @param string $class         CSS class(es).
 * @param string $extra         Extra HTML attributes (e.g. loading="lazy").
 */
function clv_img_f(
    string $key,
    $post_id,
    string $fallback_path,
    string $alt   = '',
    string $class = '',
    string $extra = ''
): void {
    $image = clv_field($key, $post_id);

    if ($image) {
        clv_img($image, $alt, $class, 'full', $extra);
    } else {
        // Use bundled theme image
        $url        = clv_theme_img_url($fallback_path);
        $classattr  = $class ? " class=\"{$class}\"" : '';
        echo "<img src=\"" . esc_url($url) . "\" alt=\"" . esc_attr($alt) . "\"{$classattr} {$extra}>";
    }
}


/* ============================================================
   6. NAV ACTIVE CLASS FIX
   Add 'active' class alongside WP's 'current-menu-item'.
   ============================================================ */
add_filter('nav_menu_css_class', function ($classes, $item) {
    if (in_array('current-menu-item', $classes)) {
        $classes[] = 'active';
    }
    return $classes;
}, 10, 2);


/* ============================================================
   7. REMOVE WP CLUTTER FROM <HEAD>
   ============================================================ */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');


/* ============================================================
   8. CONTACT FORM 7 – REMOVE AUTO P TAGS
   ============================================================ */
add_filter('wpcf7_autop_or_not', '__return_false');


/* ============================================================
   9. IMAGE SIZES
   ============================================================ */
add_image_size('clv-hero',        900, 900, false);
add_image_size('clv-card',        600, 500, true);
add_image_size('clv-testimonial', 480, 600, true);
add_image_size('clv-avatar',      120, 120, true);
