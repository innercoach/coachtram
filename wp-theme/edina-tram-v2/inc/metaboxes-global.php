<?php
/**
 * Global Settings — Options page for site-wide settings.
 * Menu: Settings > Cài đặt Website
 */

/* ============================================================
   REGISTER OPTIONS PAGE
   ============================================================ */
add_action('admin_menu', function () {
    add_options_page(
        'Cài đặt Website',
        'Cài đặt Website',
        'manage_options',
        'edt-settings',
        'edt_render_settings_page'
    );
});

/* ============================================================
   RENDER PAGE
   ============================================================ */
function edt_render_settings_page() {
    if (!current_user_can('manage_options')) return;

    // Save
    if (isset($_POST['edt_settings_nonce']) && wp_verify_nonce($_POST['edt_settings_nonce'], 'edt_save_settings')) {
        $text_fields = [
            'logo_text', 'header_cta_label', 'header_cta_url',
            'footer_tagline', 'footer_copyright',
            'contact_email', 'contact_phone',
            'social_facebook', 'social_instagram', 'social_youtube', 'social_website',
            'coach_name', 'coach_title',
        ];
        foreach ($text_fields as $f) {
            if (isset($_POST['edt_' . $f])) {
                update_option('edt_' . $f, sanitize_text_field($_POST['edt_' . $f]));
            }
        }
        // Rich text
        if (isset($_POST['edt_coach_bio'])) {
            update_option('edt_coach_bio', wp_kses_post($_POST['edt_coach_bio']));
        }
        // Image
        if (isset($_POST['edt_logo_image'])) {
            update_option('edt_logo_image', absint($_POST['edt_logo_image']));
        }

        echo '<div class="notice notice-success is-dismissible"><p>Đã lưu cài đặt.</p></div>';
    }

    ?>
    <div class="wrap">
        <h1>Cài đặt Website — Edina Trâm V2</h1>
        <form method="post" class="edt-metabox-wrap">
            <?php wp_nonce_field('edt_save_settings', 'edt_settings_nonce'); ?>

            <?php
            edt_render_tabs([
                'edt-g-logo'    => '🖼️ Logo',
                'edt-g-header'  => '📌 Header',
                'edt-g-footer'  => '📎 Footer',
                'edt-g-contact' => '📞 Liên lạc',
                'edt-g-coach'   => '👤 Coach',
            ]);

            // --- TAB: Logo ---
            edt_open_tab('edt-g-logo', true);
            edt_image_field('edt_logo_image', 'Logo (Ảnh)', get_option('edt_logo_image', ''), 'Nếu có ảnh logo, hệ thống hiển thị ảnh thay cho chữ.');
            edt_text_field('edt_logo_text', 'Logo (Chữ, dự phòng)', get_option('edt_logo_text', 'Edina <span>Trâm</span>'), 'Dùng HTML: Edina <span>Trâm</span>');
            edt_close_tab();

            // --- TAB: Header ---
            edt_open_tab('edt-g-header');
            edt_text_field('edt_header_cta_label', 'Nút CTA — Nhãn', get_option('edt_header_cta_label', 'Đặt lịch Tư vấn'));
            edt_url_field('edt_header_cta_url', 'Nút CTA — Link', get_option('edt_header_cta_url', ''));
            edt_close_tab();

            // --- TAB: Footer ---
            edt_open_tab('edt-g-footer');
            edt_textarea_field('edt_footer_tagline', 'Tagline footer', get_option('edt_footer_tagline', 'Dẫn lối bình an, khai mở nội lực. Đồng hành cùng bạn trên hành trình kiến tạo cuộc sống chất lượng.'));
            edt_text_field('edt_footer_copyright', 'Copyright', get_option('edt_footer_copyright', '© 2026 Edina Trâm. All rights reserved.'));
            edt_close_tab();

            // --- TAB: Contact ---
            edt_open_tab('edt-g-contact');
            edt_text_field('edt_contact_email', 'Email', get_option('edt_contact_email', 'coachtram@gmail.com'));
            edt_text_field('edt_contact_phone', 'Số điện thoại', get_option('edt_contact_phone', '0901 234 567'));
            edt_url_field('edt_social_facebook', 'Facebook URL', get_option('edt_social_facebook', ''));
            edt_url_field('edt_social_instagram', 'Instagram URL', get_option('edt_social_instagram', ''));
            edt_url_field('edt_social_youtube', 'YouTube URL', get_option('edt_social_youtube', ''));
            edt_url_field('edt_social_website', 'Website URL', get_option('edt_social_website', ''));
            edt_close_tab();

            // --- TAB: Coach ---
            edt_open_tab('edt-g-coach');
            edt_text_field('edt_coach_name', 'Tên Coach', get_option('edt_coach_name', 'Edina Trâm'));
            edt_text_field('edt_coach_title', 'Chức danh', get_option('edt_coach_title', 'F&B Startup Coach · ICF PCC'));
            edt_editor_field('edt_coach_bio', 'Giới thiệu ngắn', get_option('edt_coach_bio', ''), 'Nội dung giới thiệu Coach hiển thị ở mục Giảng viên.');
            edt_close_tab();
            ?>

            <?php submit_button('Lưu cài đặt'); ?>
        </form>
    </div>
    <?php
}
