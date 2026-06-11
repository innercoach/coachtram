<?php
/**
 * Metaboxes — Front Page (Home)
 * Edina Trâm V2
 *
 * Registers a metabox with 7 tabs for the homepage.
 * Shows on pages set as the static front page.
 */

/* ============================================================
   REGISTER META BOX
   ============================================================ */
add_action('add_meta_boxes', function () {
    global $post;
    if (!$post) return;

    $front_page_id = (int) get_option('page_on_front');

    // Only show on the page set as front page
    if ($front_page_id && $post->ID !== $front_page_id) return;

    add_meta_box(
        'edt_home_metabox',
        '🏠 Trang chủ — Nội dung',
        'edt_home_metabox_render',
        'page',
        'normal',
        'high'
    );
});


/* ============================================================
   RENDER CALLBACK
   ============================================================ */
function edt_home_metabox_render($post) {
    wp_nonce_field('edt_save_home', 'edt_home_nonce');

    // Helper to get meta
    $m = function ($key, $default = '') use ($post) {
        $val = get_post_meta($post->ID, '_' . $key, true);
        return ($val !== '' && $val !== false) ? $val : $default;
    };

    ?>
    <div class="edt-metabox-wrap">
    <p class="description" style="margin-bottom:15px; padding:10px; background:#f0f6fc; border-left:4px solid #2271b1; border-radius:3px;">
        ℹ️ Cài đặt này áp dụng cho template <strong>Trang chủ (Front Page)</strong>. Hãy chắc chắn trang này được chọn làm "Trang chủ tĩnh" trong <em>Cài đặt → Đọc</em>.
    </p>

    <?php
    edt_render_tabs([
        'edt-h-hero'    => '🎯 Hero',
        'edt-h-srv'     => '🛎️ Dịch vụ',
        'edt-h-about'   => '👤 Giới thiệu',
        'edt-h-book'    => '📖 Sách',
        'edt-h-testi'   => '💬 Nhận xét',
        'edt-h-channel' => '🌐 Kênh kết nối',
        'edt-h-cta'     => '📢 CTA cuối',
    ]);


    /* ──────────────────────────────────────────────
       TAB 1: HERO
       ────────────────────────────────────────────── */
    edt_open_tab('edt-h-hero', true);

    edt_text_field('_home_hero_badge', 'Badge text', $m('home_hero_badge', 'COACHING · MINDFULNESS · TRANSFORMATION'));
    edt_editor_field('_home_hero_title', 'Tiêu đề (H1)', $m('home_hero_title', 'Dẫn lối bình an,<br>khai mở <em>nội lực.</em>'), 'Hỗ trợ HTML: <br>, <em>, <strong>');
    edt_textarea_field('_home_hero_desc', 'Mô tả ngắn', $m('home_hero_desc', 'Đồng hành cùng bạn tìm lại sự rõ ràng trong tâm trí, tự tin trong hành động và sống một cuộc đời đúng với giá trị của chính mình.'));

    echo '<h3 class="edt-section-title">Nút CTA</h3>';
    edt_text_field('_home_hero_cta1_label', 'CTA 1 — Nhãn', $m('home_hero_cta1_label', 'Khám phá dịch vụ'));
    edt_url_field('_home_hero_cta1_url', 'CTA 1 — Link', $m('home_hero_cta1_url', '#services'));
    edt_text_field('_home_hero_cta2_label', 'CTA 2 — Nhãn', $m('home_hero_cta2_label', 'Tư vấn 1:1 miễn phí'));
    edt_url_field('_home_hero_cta2_url', 'CTA 2 — Link', $m('home_hero_cta2_url', ''));

    echo '<h3 class="edt-section-title">Ảnh Hero</h3>';
    edt_image_field('_home_hero_image', 'Ảnh Hero', $m('home_hero_image', ''), 'Kích thước khuyến nghị: 600×680px');
    edt_text_field('_home_hero_image_alt', 'Alt text ảnh', $m('home_hero_image_alt', 'Coach Edina Trâm'));

    echo '<h3 class="edt-section-title">Giá trị cốt lõi (3 mục)</h3>';
    for ($i = 1; $i <= 3; $i++) {
        echo '<div class="edt-group"><p class="edt-group-title">Giá trị ' . $i . '</p>';
        edt_text_field("_home_hero_value{$i}_title", 'Tiêu đề', $m("home_hero_value{$i}_title", ''));
        edt_text_field("_home_hero_value{$i}_desc", 'Mô tả', $m("home_hero_value{$i}_desc", ''));
        echo '</div>';
    }

    edt_text_field('_home_hero_scroll_text', 'Scroll indicator text', $m('home_hero_scroll_text', 'Cuộn xuống'));

    edt_close_tab();


    /* ──────────────────────────────────────────────
       TAB 2: DỊCH VỤ
       ────────────────────────────────────────────── */
    edt_open_tab('edt-h-srv');

    echo '<h3 class="edt-section-title">Section Header</h3>';
    edt_text_field('_home_srv_badge', 'Badge', $m('home_srv_badge', 'Hệ sinh thái dịch vụ'));
    edt_text_field('_home_srv_title', 'Tiêu đề (H2)', $m('home_srv_title', 'Ba chương trình chuyển hóa'));
    edt_textarea_field('_home_srv_desc', 'Mô tả', $m('home_srv_desc', 'Mỗi chương trình được thiết kế riêng biệt, phục vụ từng giai đoạn trên hành trình phát triển của bạn — từ đam mê cá nhân đến tự do tài chính.'));

    $srv_defaults = [
        1 => ['01', 'Passion to Profit', 'Workshop 2 ngày', 'Chuyển hóa đam mê thành mô hình kinh doanh có lợi nhuận. Tìm ra lợi thế cạnh tranh, xây dựng nền tảng vững chắc và bắt đầu hành trình khởi nghiệp đầy tự tin.', '/dich-vu-1', 'Tìm hiểu thêm →'],
        2 => ['02', 'Business to Freedom', 'Khoá học 10 tuần', 'Mở rộng quy mô doanh nghiệp, xây dựng hệ thống vận hành tự động và tạo ra cuộc sống tự do mà bạn hằng mơ ước — không cần phải hy sinh sức khỏe hay gia đình.', '/dich-vu-2', 'Tìm hiểu thêm →'],
        3 => ['03', 'Business Mastery', 'Coaching 1:1 chiến lược', 'Chương trình coaching cá nhân hóa dành cho doanh nhân muốn làm chủ mọi khía cạnh — từ chiến lược kinh doanh, lãnh đạo đội ngũ đến phát triển bản thân.', '/dich-vu-3', 'Tìm hiểu thêm →'],
    ];

    foreach ($srv_defaults as $i => $d) {
        echo '<h3 class="edt-section-title">Dịch vụ ' . $i . '</h3>';
        echo '<div class="edt-group">';
        edt_text_field("_home_srv{$i}_num", 'Số thứ tự', $m("home_srv{$i}_num", $d[0]));
        edt_text_field("_home_srv{$i}_title", 'Tên dịch vụ', $m("home_srv{$i}_title", $d[1]));
        edt_text_field("_home_srv{$i}_subtitle", 'Phụ đề', $m("home_srv{$i}_subtitle", $d[2]));
        edt_textarea_field("_home_srv{$i}_desc", 'Mô tả', $m("home_srv{$i}_desc", $d[3]));
        edt_url_field("_home_srv{$i}_url", 'Link', $m("home_srv{$i}_url", $d[4]));
        edt_text_field("_home_srv{$i}_cta", 'Nhãn nút', $m("home_srv{$i}_cta", $d[5]));
        echo '</div>';
    }

    edt_close_tab();


    /* ──────────────────────────────────────────────
       TAB 3: GIỚI THIỆU
       ────────────────────────────────────────────── */
    edt_open_tab('edt-h-about');

    echo '<h3 class="edt-section-title">Ảnh & Badge overlay</h3>';
    edt_image_field('_home_about_image', 'Ảnh Coach', $m('home_about_image', ''), 'Kích thước khuyến nghị: 520×640px');
    edt_text_field('_home_about_image_alt', 'Alt text ảnh', $m('home_about_image_alt', 'Coach Edina Trâm'));
    edt_text_field('_home_about_badge_overlay', 'Badge phủ lên ảnh', $m('home_about_badge_overlay', 'ICF PCC Coach'));

    echo '<h3 class="edt-section-title">Nội dung</h3>';
    edt_text_field('_home_about_badge', 'Badge', $m('home_about_badge', 'Người đồng hành'));
    edt_editor_field('_home_about_title', 'Tiêu đề (H2)', $m('home_about_title', 'Chân thực. Thấu hiểu.<br>Truyền cảm hứng.'), 'Hỗ trợ HTML: <br>, <em>, <strong>');
    edt_text_field('_home_about_name', 'Tên Coach', $m('home_about_name', 'Edina Trâm'));
    edt_editor_field('_home_about_bio', 'Giới thiệu (Bio)', $m('home_about_bio', 'Với hơn 16 năm kinh nghiệm trong ngành F&B và hành trình phát triển bản thân không ngừng, tôi tin rằng mỗi người đều sở hữu một nguồn nội lực phi thường. Sứ mệnh của tôi là đồng hành cùng bạn khơi dậy tiềm năng ấy, để bạn sống một cuộc đời ý nghĩa và trọn vẹn.'), 'Nội dung giới thiệu Coach, có thể dùng HTML.');

    echo '<h3 class="edt-section-title">Chứng chỉ / Credential badges (4 mục)</h3>';
    edt_text_field('_home_about_cred1', 'Badge 1', $m('home_about_cred1', 'ICF PCC'));
    edt_text_field('_home_about_cred2', 'Badge 2', $m('home_about_cred2', '16+ Năm Kinh Nghiệm'));
    edt_text_field('_home_about_cred3', 'Badge 3', $m('home_about_cred3', 'F&B Expert'));
    edt_text_field('_home_about_cred4', 'Badge 4', $m('home_about_cred4', '50+ Doanh Nghiệp'));

    echo '<h3 class="edt-section-title">Thống kê (4 mục)</h3>';
    $stat_defaults = [
        1 => ['16', '+', 'Năm kinh nghiệm'],
        2 => ['50', '+', 'Doanh nghiệp đồng hành'],
        3 => ['1000', '+', 'Cuốn sách đã đọc'],
        4 => ['3', '', 'Chương trình chuyển hóa'],
    ];
    foreach ($stat_defaults as $i => $d) {
        echo '<div class="edt-group"><p class="edt-group-title">Thống kê ' . $i . '</p>';
        edt_text_field("_home_about_stat{$i}_num", 'Con số', $m("home_about_stat{$i}_num", $d[0]), 'Số nguyên, VD: 16, 50, 1000');
        edt_text_field("_home_about_stat{$i}_suffix", 'Hậu tố', $m("home_about_stat{$i}_suffix", $d[1]), 'VD: +, %, k');
        edt_text_field("_home_about_stat{$i}_label", 'Nhãn', $m("home_about_stat{$i}_label", $d[2]));
        echo '</div>';
    }

    edt_close_tab();


    /* ──────────────────────────────────────────────
       TAB 4: SÁCH
       ────────────────────────────────────────────── */
    edt_open_tab('edt-h-book');

    edt_image_field('_home_book_image', 'Ảnh sách (mockup)', $m('home_book_image', ''), 'Kích thước khuyến nghị: 340×420px');
    edt_text_field('_home_book_image_alt', 'Alt text ảnh', $m('home_book_image_alt', 'Sách Ánh Sáng Của Ước Mơ – Edina Trâm'));
    edt_text_field('_home_book_badge', 'Badge', $m('home_book_badge', 'Sách mới'));
    edt_editor_field('_home_book_title', 'Tiêu đề sách (H2)', $m('home_book_title', 'Ánh Sáng Của Ước Mơ'), 'Hỗ trợ HTML.');
    edt_editor_field('_home_book_desc', 'Mô tả sách', $m('home_book_desc', 'Cuốn sách chia sẻ hành trình chuyển hóa cá nhân và những bài học quý giá trên con đường kiến tạo cuộc sống ý nghĩa. Một nguồn cảm hứng cho bất kỳ ai đang tìm kiếm sự rõ ràng và mục đích sống.'));

    echo '<h3 class="edt-section-title">Nút CTA</h3>';
    edt_text_field('_home_book_cta1_label', 'CTA 1 — Nhãn', $m('home_book_cta1_label', 'Đặt sách ngay'));
    edt_url_field('_home_book_cta1_url', 'CTA 1 — Link', $m('home_book_cta1_url', ''));
    edt_text_field('_home_book_cta2_label', 'CTA 2 — Nhãn', $m('home_book_cta2_label', 'Xem thêm'));
    edt_url_field('_home_book_cta2_url', 'CTA 2 — Link', $m('home_book_cta2_url', ''));

    edt_close_tab();


    /* ──────────────────────────────────────────────
       TAB 5: NHẬN XÉT (Testimonials header)
       ────────────────────────────────────────────── */
    edt_open_tab('edt-h-testi');

    echo '<p class="description" style="margin-bottom:15px; padding:10px; background:#fef9e7; border-left:4px solid #dba617; border-radius:3px;">';
    echo '💡 Các thẻ nhận xét (card) được quản lý riêng qua <strong>Ý kiến Khách hàng</strong> (CPT). Gán taxonomy <code>home</code> để hiển thị trên trang chủ.';
    echo '</p>';

    edt_text_field('_home_testi_badge', 'Badge', $m('home_testi_badge', 'Khách hàng nói gì'));
    edt_editor_field('_home_testi_title', 'Tiêu đề (H2)', $m('home_testi_title', 'Hành trình chuyển hóa thật sự'), 'Hỗ trợ HTML: <br>, <em>, <strong>');

    edt_close_tab();


    /* ──────────────────────────────────────────────
       TAB 6: KÊNH KẾT NỐI
       ────────────────────────────────────────────── */
    edt_open_tab('edt-h-channel');

    echo '<h3 class="edt-section-title">Section Header</h3>';
    edt_text_field('_home_channel_badge', 'Badge', $m('home_channel_badge', 'Kết nối đa kênh'));
    edt_editor_field('_home_channel_title', 'Tiêu đề (H2)', $m('home_channel_title', 'Đi cùng Edina trên mọi nền tảng'), 'Hỗ trợ HTML.');

    $ch_defaults = [
        1 => ['Facebook', 'Cộng đồng chia sẻ kiến thức, cảm hứng và kết nối hàng ngày cùng hàng nghìn doanh nhân.'],
        2 => ['YouTube', 'Video chia sẻ chuyên sâu về coaching, mindfulness và phát triển bản thân cho doanh nhân.'],
        3 => ['Newsletter', 'Nhận bài viết chuyên sâu, tài nguyên miễn phí và cập nhật mới nhất mỗi tuần qua email.'],
        4 => ['Edina Workspace', 'Không gian làm việc và học tập trực tuyến dành riêng cho cộng đồng học viên Edina Trâm.'],
    ];

    foreach ($ch_defaults as $i => $d) {
        echo '<h3 class="edt-section-title">Kênh ' . $i . '</h3>';
        echo '<div class="edt-group">';
        edt_text_field("_home_ch{$i}_title", 'Tên kênh', $m("home_ch{$i}_title", $d[0]));
        edt_textarea_field("_home_ch{$i}_desc", 'Mô tả', $m("home_ch{$i}_desc", $d[1]));
        echo '</div>';
    }

    edt_close_tab();


    /* ──────────────────────────────────────────────
       TAB 7: CTA CUỐI
       ────────────────────────────────────────────── */
    edt_open_tab('edt-h-cta');

    edt_text_field('_home_cta_badge', 'Badge', $m('home_cta_badge', 'Bắt đầu hành trình'));
    edt_editor_field('_home_cta_title', 'Tiêu đề (H2)', $m('home_cta_title', 'Bạn đã sẵn sàng cho phiên bản<br>tuyệt vời nhất?'), 'Hỗ trợ HTML: <br>, <em>');
    edt_textarea_field('_home_cta_desc', 'Mô tả', $m('home_cta_desc', 'Đặt lịch tư vấn miễn phí để cùng tôi tìm ra chương trình phù hợp nhất cho hành trình chuyển hóa của bạn.'));
    edt_text_field('_home_cta_label', 'Nhãn nút', $m('home_cta_label', 'Đặt lịch Tư vấn miễn phí'));
    edt_url_field('_home_cta_url', 'Link nút', $m('home_cta_url', ''));

    edt_close_tab();
    ?>
    </div>
    <?php
}


/* ============================================================
   SAVE META
   ============================================================ */
add_action('save_post_page', function ($post_id) {

    // Nonce check
    if (!isset($_POST['edt_home_nonce']) || !wp_verify_nonce($_POST['edt_home_nonce'], 'edt_save_home')) return;
    // Autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    // Permission
    if (!current_user_can('edit_post', $post_id)) return;

    /* --- Text fields (sanitize_text_field) --- */
    $text_fields = [
        'home_hero_badge',
        'home_hero_desc',
        'home_hero_cta1_label', 'home_hero_cta2_label',
        'home_hero_image_alt',
        'home_hero_value1_title', 'home_hero_value1_desc',
        'home_hero_value2_title', 'home_hero_value2_desc',
        'home_hero_value3_title', 'home_hero_value3_desc',
        'home_hero_scroll_text',
        // Services header
        'home_srv_badge', 'home_srv_title',
        // Services cards
        'home_srv1_num', 'home_srv1_title', 'home_srv1_subtitle', 'home_srv1_cta',
        'home_srv2_num', 'home_srv2_title', 'home_srv2_subtitle', 'home_srv2_cta',
        'home_srv3_num', 'home_srv3_title', 'home_srv3_subtitle', 'home_srv3_cta',
        // About
        'home_about_badge', 'home_about_name',
        'home_about_image_alt', 'home_about_badge_overlay',
        'home_about_cred1', 'home_about_cred2', 'home_about_cred3', 'home_about_cred4',
        'home_about_stat1_num', 'home_about_stat1_suffix', 'home_about_stat1_label',
        'home_about_stat2_num', 'home_about_stat2_suffix', 'home_about_stat2_label',
        'home_about_stat3_num', 'home_about_stat3_suffix', 'home_about_stat3_label',
        'home_about_stat4_num', 'home_about_stat4_suffix', 'home_about_stat4_label',
        // Book
        'home_book_badge', 'home_book_image_alt',
        'home_book_cta1_label', 'home_book_cta2_label',
        // Testimonials header
        'home_testi_badge',
        // Channels header
        'home_channel_badge',
        'home_ch1_title', 'home_ch2_title', 'home_ch3_title', 'home_ch4_title',
        // CTA final
        'home_cta_badge', 'home_cta_label',
    ];

    foreach ($text_fields as $f) {
        if (isset($_POST['_' . $f])) {
            update_post_meta($post_id, '_' . $f, sanitize_text_field(wp_unslash($_POST['_' . $f])));
        }
    }

    /* --- Textarea fields (sanitize_textarea_field) --- */
    $textarea_fields = [
        'home_srv_desc',
        'home_srv1_desc', 'home_srv2_desc', 'home_srv3_desc',
        'home_hero_desc',
        'home_ch1_desc', 'home_ch2_desc', 'home_ch3_desc', 'home_ch4_desc',
        'home_cta_desc',
    ];

    foreach ($textarea_fields as $f) {
        if (isset($_POST['_' . $f])) {
            update_post_meta($post_id, '_' . $f, sanitize_textarea_field(wp_unslash($_POST['_' . $f])));
        }
    }

    /* --- Rich text fields (wp_kses_post) --- */
    $rich_fields = [
        'home_hero_title',
        'home_about_title', 'home_about_bio',
        'home_book_title', 'home_book_desc',
        'home_testi_title',
        'home_channel_title',
        'home_cta_title',
    ];

    foreach ($rich_fields as $f) {
        if (isset($_POST['_' . $f])) {
            update_post_meta($post_id, '_' . $f, wp_kses_post(wp_unslash($_POST['_' . $f])));
        }
    }

    /* --- URL fields (esc_url_raw) --- */
    $url_fields = [
        'home_hero_cta1_url', 'home_hero_cta2_url',
        'home_srv1_url', 'home_srv2_url', 'home_srv3_url',
        'home_book_cta1_url', 'home_book_cta2_url',
        'home_cta_url',
    ];

    foreach ($url_fields as $f) {
        if (isset($_POST['_' . $f])) {
            update_post_meta($post_id, '_' . $f, esc_url_raw(wp_unslash($_POST['_' . $f])));
        }
    }

    /* --- Image fields (absint) --- */
    $image_fields = [
        'home_hero_image',
        'home_about_image',
        'home_book_image',
    ];

    foreach ($image_fields as $f) {
        if (isset($_POST['_' . $f])) {
            update_post_meta($post_id, '_' . $f, absint($_POST['_' . $f]));
        }
    }
});
