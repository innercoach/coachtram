<?php
/**
 * Metaboxes — Contact Page (lien-he)
 * 3 tabs: Hero, Thông tin liên hệ, Form liên hệ
 */

/* ============================================================
   REGISTER META BOX
   ============================================================ */
add_action('add_meta_boxes', function () {
    $screen = get_current_screen();
    if ($screen->id !== 'page') return;
    global $post;
    if (!$post || $post->post_name !== 'lien-he') return;

    add_meta_box(
        'edt_contact_metabox',
        'Cài đặt trang Liên hệ',
        'edt_contact_metabox_render',
        'page',
        'normal',
        'high'
    );
});


/* ============================================================
   RENDER META BOX
   ============================================================ */
function edt_contact_metabox_render($post) {
    wp_nonce_field('edt_save_contact', 'edt_contact_nonce');

    $f = function ($key, $default = '') use ($post) {
        return get_post_meta($post->ID, '_' . $key, true) ?: $default;
    };

    edt_render_tabs([
        'edt-ct-hero' => '🎯 Hero',
        'edt-ct-info' => 'ℹ️ Thông tin liên hệ',
        'edt-ct-form' => '📝 Form liên hệ',
    ]);

    // ─── TAB 1: Hero ───
    edt_open_tab('edt-ct-hero', true);
    edt_text_field('_contact_hero_badge', 'Badge', $f('contact_hero_badge', 'Liên hệ'));
    edt_text_field('_contact_hero_title', 'Tiêu đề chính', $f('contact_hero_title', 'Hãy kết nối cùng tôi'));
    edt_text_field('_contact_hero_desc', 'Mô tả ngắn', $f('contact_hero_desc', 'Buổi tư vấn đầu tiên hoàn toàn miễn phí — không có cam kết.'));
    edt_close_tab();

    // ─── TAB 2: Thông tin liên hệ ───
    edt_open_tab('edt-ct-info');
    edt_text_field('_contact_info_badge', 'Badge', $f('contact_info_badge', 'Thông tin'));
    edt_text_field('_contact_info_title', 'Tiêu đề', $f('contact_info_title', 'Tôi muốn lắng nghe bạn'));
    edt_textarea_field('_contact_info_desc', 'Mô tả', $f('contact_info_desc', 'Đừng ngần ngại liên hệ qua bất kỳ kênh nào bạn thấy tiện nhất. Tôi sẽ phản hồi trong vòng 24 giờ.'));
    edt_text_field('_contact_info_email', 'Email', $f('contact_info_email'), 'Để trống sẽ dùng email từ Cài đặt Website.');
    edt_text_field('_contact_info_phone', 'Số điện thoại', $f('contact_info_phone'), 'Để trống sẽ dùng SĐT từ Cài đặt Website.');
    edt_url_field('_contact_info_facebook', 'Facebook URL', $f('contact_info_facebook'), 'Để trống sẽ dùng Facebook từ Cài đặt Website.');
    edt_text_field('_contact_info_hours', 'Giờ làm việc', $f('contact_info_hours', 'Thứ 2 – Thứ 7, 8:00 – 21:00'));
    edt_close_tab();

    // ─── TAB 3: Form liên hệ ───
    edt_open_tab('edt-ct-form');
    edt_text_field('_contact_form_badge', 'Badge', $f('contact_form_badge', 'Gửi tin nhắn'));
    edt_text_field('_contact_form_title', 'Tiêu đề', $f('contact_form_title', 'Đặt lịch tư vấn miễn phí'));
    edt_text_field('_contact_form_lead', 'Dòng dẫn', $f('contact_form_lead', 'Điền thông tin bên dưới và tôi sẽ liên hệ lại với bạn sớm nhất có thể.'));
    edt_text_field('_contact_form_shortcode', 'Fluent Form Shortcode', $f('contact_form_shortcode'), 'Dán shortcode Fluent Form, VD: [fluentform id="1"]. Nếu để trống, form sẽ không hiển thị.');
    edt_text_field('_contact_form_note', 'Ghi chú cuối form', $f('contact_form_note', 'Tôi sẽ phản hồi trong vòng 24 giờ. Thông tin của bạn được bảo mật tuyệt đối.'));
    edt_close_tab();
}


/* ============================================================
   SAVE META BOX
   ============================================================ */
add_action('save_post', function ($post_id) {
    // Nonce check
    if (!isset($_POST['edt_contact_nonce']) || !wp_verify_nonce($_POST['edt_contact_nonce'], 'edt_save_contact')) return;

    // Autosave check
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    // Capability check
    if (!current_user_can('edit_post', $post_id)) return;

    // Only save for the lien-he page
    if (get_post_field('post_name', $post_id) !== 'lien-he') return;

    // Text fields
    $text_fields = [
        'contact_hero_badge',
        'contact_hero_title',
        'contact_hero_desc',
        'contact_info_badge',
        'contact_info_title',
        'contact_info_email',
        'contact_info_phone',
        'contact_info_hours',
        'contact_form_badge',
        'contact_form_title',
        'contact_form_lead',
        'contact_form_shortcode',
        'contact_form_note',
    ];
    foreach ($text_fields as $field) {
        if (isset($_POST['_' . $field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field(wp_unslash($_POST['_' . $field])));
        }
    }

    // Textarea fields (allow basic HTML)
    $textarea_fields = [
        'contact_info_desc',
    ];
    foreach ($textarea_fields as $field) {
        if (isset($_POST['_' . $field])) {
            update_post_meta($post_id, '_' . $field, sanitize_textarea_field(wp_unslash($_POST['_' . $field])));
        }
    }

    // URL fields
    $url_fields = [
        'contact_info_facebook',
    ];
    foreach ($url_fields as $field) {
        if (isset($_POST['_' . $field])) {
            update_post_meta($post_id, '_' . $field, esc_url_raw(wp_unslash($_POST['_' . $field])));
        }
    }
});
