<?php
/**
 * Metabox — Dịch vụ 1 (Passion to Profit)
 * Shows only on page with slug 'dich-vu-1'.
 */

/* ============================================================
   REGISTER META BOX
   ============================================================ */
add_action('add_meta_boxes', function () {
    $screen = get_current_screen();
    if ($screen->id !== 'page') return;
    global $post;
    if (!$post || $post->post_name !== 'dich-vu-1') return;
    add_meta_box('edt_dv1_metabox', 'Cài đặt Dịch vụ 1', 'edt_render_dv1_metabox', 'page', 'normal', 'high');
});

/* ============================================================
   RENDER META BOX
   ============================================================ */
function edt_render_dv1_metabox($post) {
    wp_nonce_field('edt_save_dv1', 'edt_dv1_nonce');

    $f = function ($key, $default = '') use ($post) {
        return edt_field($key, $post->ID, $default);
    };
    $img_val = function ($key) use ($post) {
        return edt_field($key, $post->ID);
    };

    edt_render_tabs([
        'edt-dv1-sticky'   => '📌 Sticky CTA',
        'edt-dv1-hero'     => '🎯 Hero',
        'edt-dv1-cred'     => '⭐ Uy tín',
        'edt-dv1-target'   => '🎯 Đối tượng',
        'edt-dv1-benefit'  => '💎 Lợi ích',
        'edt-dv1-module'   => '📋 Nội dung',
        'edt-dv1-testi'    => '💬 Nhận xét',
        'edt-dv1-inst'     => '👨‍🏫 Giảng viên',
        'edt-dv1-faq'      => '❓ FAQ',
        'edt-dv1-cta'      => '📢 CTA Cuối',
    ]);


    /* ── TAB 1: Sticky CTA ── */
    edt_open_tab('edt-dv1-sticky', true);
    edt_text_field('_dv1_sticky_title', 'Tiêu đề', $f('dv1_sticky_title', 'Passion to Profit – Workshop'));
    edt_text_field('_dv1_sticky_meta', 'Thông tin phụ', $f('dv1_sticky_meta', '22–23/03/2026 · 2 ngày cuối tuần · 499.000 VNĐ'));
    edt_text_field('_dv1_sticky_cta_label', 'Nút CTA — Nhãn', $f('dv1_sticky_cta_label', 'Đăng Ký Ngay'));
    edt_url_field('_dv1_sticky_cta_url', 'Nút CTA — Link', $f('dv1_sticky_cta_url', 'https://zalo.me/0901234567'));
    edt_close_tab();


    /* ── TAB 2: Hero ── */
    edt_open_tab('edt-dv1-hero');
    edt_text_field('_dv1_hero_badge', 'Badge', $f('dv1_hero_badge', 'WORKSHOP 2 NGÀY'));
    edt_editor_field('_dv1_hero_title', 'Tiêu đề (HTML)', $f('dv1_hero_title', 'PASSION<br>TO <span>PROFIT</span>'), 'Cho phép HTML: <br>, <span>');
    edt_text_field('_dv1_hero_tagline', 'Tagline', $f('dv1_hero_tagline', 'Chuyển đổi đam mê thành mô hình kinh doanh thực tế'));
    edt_textarea_field('_dv1_hero_desc', 'Mô tả', $f('dv1_hero_desc', 'Workshop thực chiến 2 ngày giúp bạn tìm ra giao điểm giữa đam mê, thế mạnh và nhu cầu thị trường – từ đó phác thảo mô hình kinh doanh đầu tiên có khả năng sinh lợi nhuận bền vững. Đồng hành bởi Coach Edina Trâm với hơn 15 năm kinh nghiệm thực chiến.'));
    edt_text_field('_dv1_hero_duration', 'Thời lượng', $f('dv1_hero_duration', '2 ngày cuối tuần, 9:00–17:00'));
    edt_text_field('_dv1_hero_date', 'Ngày diễn ra', $f('dv1_hero_date', '22–23/03/2026'));
    edt_text_field('_dv1_hero_price', 'Giá', $f('dv1_hero_price', '499.000 VNĐ'));
    edt_datetime_field('_dv1_hero_countdown', 'Countdown đến', $f('dv1_hero_countdown', '2026-03-22T09:00:00'), 'Định dạng: YYYY-MM-DDTHH:MM:SS');
    edt_text_field('_dv1_hero_cta_label', 'Nút CTA — Nhãn', $f('dv1_hero_cta_label', 'Đăng Ký Ngay →'));
    edt_url_field('_dv1_hero_cta_url', 'Nút CTA — Link', $f('dv1_hero_cta_url', 'https://zalo.me/0901234567'));
    edt_editor_field('_dv1_hero_scholarship', 'Ghi chú học bổng (HTML)', $f('dv1_hero_scholarship', '🎓 <strong style="color:var(--color-primary)">Học bổng 50%</strong> dành cho sinh viên &amp; người mới bắt đầu. <a href="https://zalo.me/0901234567" style="color:var(--royal-gold);text-decoration:underline;">Liên hệ để biết thêm</a>'), 'Cho phép HTML cho link và định dạng.');
    edt_image_field('_dv1_hero_image', 'Ảnh Hero', $img_val('dv1_hero_image'));
    edt_close_tab();


    /* ── TAB 3: Uy tín ── */
    edt_open_tab('edt-dv1-cred');
    edt_text_field('_dv1_cred_badge', 'Badge', $f('dv1_cred_badge', 'UY TÍN & KINH NGHIỆM'));
    edt_text_field('_dv1_cred_title', 'Tiêu đề', $f('dv1_cred_title', 'Người đồng hành thực chiến'));
    edt_textarea_field('_dv1_cred_desc', 'Mô tả', $f('dv1_cred_desc', 'Edina Trâm không chỉ chia sẻ lý thuyết – cô ấy đã sống, trải nghiệm và xây dựng từ con số không.'));

    echo '<h3 class="edt-section-title">Thống kê</h3>';

    $default_stat_nums   = ['15', '9', '1000', '30'];
    $default_stat_labels = ['Năm kinh nghiệm kinh doanh', 'Năm xây dựng startup', 'Cuốn sách đã nghiên cứu', 'Khách hàng được coaching'];

    for ($i = 1; $i <= 4; $i++) {
        echo '<div class="edt-group"><p class="edt-group-title">Thống kê ' . $i . '</p>';
        edt_text_field('_dv1_cred_stat' . $i . '_num', 'Số', $f('dv1_cred_stat' . $i . '_num', $default_stat_nums[$i - 1]), 'VD: 15, 1000');
        edt_text_field('_dv1_cred_stat' . $i . '_label', 'Nhãn', $f('dv1_cred_stat' . $i . '_label', $default_stat_labels[$i - 1]));
        echo '</div>';
    }

    edt_close_tab();


    /* ── TAB 4: Đối tượng ── */
    edt_open_tab('edt-dv1-target');
    edt_text_field('_dv1_target_badge', 'Badge', $f('dv1_target_badge', 'DÀNH CHO AI'));
    edt_text_field('_dv1_target_title', 'Tiêu đề', $f('dv1_target_title', 'Ai sẽ phù hợp với workshop này?'));

    $default_target_descs = [
        '<strong>Nhân viên văn phòng</strong> muốn thoát khỏi guồng quay 9-to-5 và bắt đầu công việc kinh doanh từ đam mê cá nhân.',
        '<strong>Freelancer &amp; người tự do</strong> có kỹ năng nhưng chưa biết cách biến nó thành nguồn thu nhập ổn định, có hệ thống.',
        '<strong>Người trẻ khởi nghiệp</strong> nhiều ý tưởng nhưng không biết bắt đầu từ đâu, cần một lộ trình rõ ràng để hành động.',
        '<strong>Phụ nữ muốn độc lập tài chính</strong> – xây dựng thu nhập riêng bên cạnh gia đình mà không đánh đổi cuộc sống.',
        '<strong>Người đang chuyển giao sự nghiệp</strong> – muốn tìm lại mục đích và xây dựng điều gì đó có ý nghĩa hơn.',
        '<strong>Bất kỳ ai có đam mê</strong> nhưng chưa dám hành động – Workshop sẽ cho bạn sự tự tin và bước đi đầu tiên.',
    ];

    for ($i = 1; $i <= 6; $i++) {
        echo '<div class="edt-group"><p class="edt-group-title">Đối tượng ' . $i . '</p>';
        edt_editor_field('_dv1_target' . $i . '_desc', 'Mô tả (HTML)', $f('dv1_target' . $i . '_desc', $default_target_descs[$i - 1]), 'Dùng <strong> để in đậm tên đối tượng.');
        echo '</div>';
    }

    edt_close_tab();


    /* ── TAB 5: Lợi ích ── */
    edt_open_tab('edt-dv1-benefit');
    edt_text_field('_dv1_benefit_badge', 'Badge', $f('dv1_benefit_badge', 'GIÁ TRỊ NHẬN ĐƯỢC'));
    edt_text_field('_dv1_benefit_title', 'Tiêu đề', $f('dv1_benefit_title', 'Bạn sẽ đạt được gì sau 2 ngày?'));

    $default_ben_icons  = ['🔍', '🧭', '📐', '💡', '📋', '🤝'];
    $default_ben_titles = [
        'Khám phá giao điểm vàng',
        'Xác định khách hàng mục tiêu',
        'Phác thảo mô hình kinh doanh',
        'Tư duy doanh nhân thực chiến',
        'Kế hoạch hành động 90 ngày',
        'Cộng đồng & hỗ trợ sau workshop',
    ];
    $default_ben_descs = [
        'Tìm ra nơi đam mê, thế mạnh và nhu cầu thị trường gặp nhau – giao điểm sinh lợi nhuận bền vững nhất.',
        'Hiểu rõ khách hàng lý tưởng, nỗi đau của họ và cách bạn giải quyết được vấn đề của họ tốt hơn ai hết.',
        'Xây dựng Business Model Canvas đầu tiên – nền tảng để biến ý tưởng thành doanh nghiệp thực tế có doanh thu.',
        'Chuyển đổi từ tư duy nhân viên sang tư duy doanh nhân – biết cách nghĩ, ra quyết định và hành động.',
        'Ra về với bản kế hoạch 90 ngày chi tiết – biết chính xác phải làm gì mỗi tuần để tiến đến mục tiêu.',
        'Tham gia cộng đồng học viên cùng chí hướng, được hỗ trợ và kết nối lâu dài sau khóa học.',
    ];

    for ($i = 1; $i <= 6; $i++) {
        echo '<div class="edt-group"><p class="edt-group-title">Lợi ích ' . $i . '</p>';
        edt_text_field('_dv1_ben' . $i . '_icon', 'Icon (emoji)', $f('dv1_ben' . $i . '_icon', $default_ben_icons[$i - 1]));
        edt_text_field('_dv1_ben' . $i . '_title', 'Tiêu đề', $f('dv1_ben' . $i . '_title', $default_ben_titles[$i - 1]));
        edt_textarea_field('_dv1_ben' . $i . '_desc', 'Mô tả', $f('dv1_ben' . $i . '_desc', $default_ben_descs[$i - 1]));
        echo '</div>';
    }

    edt_close_tab();


    /* ── TAB 6: Nội dung (Modules) ── */
    edt_open_tab('edt-dv1-module');
    edt_text_field('_dv1_mod_badge', 'Badge', $f('dv1_mod_badge', 'NỘI DUNG WORKSHOP'));
    edt_text_field('_dv1_mod_title', 'Tiêu đề', $f('dv1_mod_title', 'Nội dung chi tiết'));

    $default_mod_labels = ['WHY', 'WHAT', "WHAT'S NEXT"];
    $default_mod_titles = ['Tại sao bắt đầu?', 'Xây dựng mô hình', 'Hành động ngay'];
    $default_mod_descs = [
        'Khám phá động lực sâu xa đằng sau mong muốn kinh doanh của bạn. Xác định giá trị cốt lõi, đam mê thực sự và "ikigai" cá nhân. Hiểu rõ tại sao đây là thời điểm phù hợp để bắt đầu – và vượt qua nỗi sợ hãi "mình không đủ giỏi" để dám hành động.',
        'Nghiên cứu thị trường và tìm ngách kinh doanh phù hợp. Xây dựng chân dung khách hàng lý tưởng (Customer Avatar). Thiết kế sản phẩm/dịch vụ đầu tiên, định giá và xây dựng Business Model Canvas hoàn chỉnh. Phác thảo chiến lược marketing ban đầu.',
        'Xây dựng kế hoạch hành động 90 ngày chi tiết. Thiết lập hệ thống theo dõi tiến độ và KPI đo lường. Cam kết hành động với nhóm accountability partner. Nhận feedback trực tiếp từ Coach Edina Trâm và cộng đồng.',
    ];

    for ($i = 1; $i <= 3; $i++) {
        echo '<div class="edt-group"><p class="edt-group-title">Module ' . $i . '</p>';
        edt_text_field('_dv1_mod' . $i . '_label', 'Nhãn (WHY / WHAT / ...)', $f('dv1_mod' . $i . '_label', $default_mod_labels[$i - 1]));
        edt_text_field('_dv1_mod' . $i . '_title', 'Tiêu đề', $f('dv1_mod' . $i . '_title', $default_mod_titles[$i - 1]));
        edt_editor_field('_dv1_mod' . $i . '_desc', 'Nội dung (HTML)', $f('dv1_mod' . $i . '_desc', $default_mod_descs[$i - 1]), 'Nội dung chi tiết của module.');
        echo '</div>';
    }

    edt_close_tab();


    /* ── TAB 7: Nhận xét ── */
    edt_open_tab('edt-dv1-testi');
    edt_text_field('_dv1_testi_badge', 'Badge', $f('dv1_testi_badge', 'PHẢN HỒI HỌC VIÊN'));
    edt_text_field('_dv1_testi_title', 'Tiêu đề', $f('dv1_testi_title', 'Học viên nói gì'));
    echo '<div class="edt-field-row"><p class="description">Nhận xét được quản lý qua CPT <strong>Ý kiến Khách hàng</strong>. Gán danh mục <code>dich-vu-1</code> để hiển thị trên trang này.</p></div>';
    edt_close_tab();


    /* ── TAB 8: Giảng viên ── */
    edt_open_tab('edt-dv1-inst');
    edt_image_field('_dv1_inst_image', 'Ảnh Giảng viên', $img_val('dv1_inst_image'), 'Ảnh riêng cho trang này. Tên/chức danh/bio lấy từ Cài đặt > Cài đặt Website > Coach.');

    echo '<h3 class="edt-section-title">Thành tích nổi bật</h3>';

    $default_creds = [
        ['num' => '15+', 'text' => 'Năm kinh nghiệm kinh doanh và tư vấn chiến lược'],
        ['num' => '9+',  'text' => 'Năm trực tiếp xây dựng và vận hành startup'],
        ['num' => 'ICF', 'text' => 'Chứng chỉ coaching quốc tế từ International Coach Federation'],
        ['num' => '30+', 'text' => 'Khách hàng cá nhân được coaching 1:1 thành công'],
        ['num' => '🎤',  'text' => 'Diễn giả tại nhiều sự kiện khởi nghiệp và hội thảo doanh nhân'],
    ];

    for ($i = 1; $i <= 5; $i++) {
        echo '<div class="edt-group"><p class="edt-group-title">Thành tích ' . $i . '</p>';
        edt_text_field('_dv1_inst_cred' . $i . '_num', 'Số / Icon', $f('dv1_inst_cred' . $i . '_num', $default_creds[$i - 1]['num']), 'VD: 15+, ICF, 🎤');
        edt_text_field('_dv1_inst_cred' . $i . '_text', 'Mô tả', $f('dv1_inst_cred' . $i . '_text', $default_creds[$i - 1]['text']));
        echo '</div>';
    }

    edt_close_tab();


    /* ── TAB 9: FAQ ── */
    edt_open_tab('edt-dv1-faq');
    edt_text_field('_dv1_faq_badge', 'Badge', $f('dv1_faq_badge', 'GIẢI ĐÁP THẮC MẮC'));
    edt_text_field('_dv1_faq_title', 'Tiêu đề', $f('dv1_faq_title', 'Câu hỏi thường gặp'));
    echo '<div class="edt-field-row"><p class="description">Câu hỏi được quản lý qua CPT <strong>FAQs</strong>. Gán danh mục <code>dich-vu-1</code> để hiển thị trên trang này.</p></div>';
    edt_close_tab();


    /* ── TAB 10: CTA Cuối ── */
    edt_open_tab('edt-dv1-cta');
    edt_text_field('_dv1_cta_quote', 'Trích dẫn', $f('dv1_cta_quote', '"Thời điểm tốt nhất để bắt đầu là 20 năm trước. Thời điểm tốt thứ hai là ngay bây giờ."'));
    edt_editor_field('_dv1_cta_title', 'Tiêu đề (HTML)', $f('dv1_cta_title', 'Đừng chờ đến khi "sẵn sàng" –<br>hãy bắt đầu và trở nên sẵn sàng.'), 'Cho phép HTML: <br>');
    edt_textarea_field('_dv1_cta_desc', 'Mô tả', $f('dv1_cta_desc', 'Chỉ 2 ngày, bạn sẽ có tất cả những gì cần thiết để biến đam mê thành lợi nhuận. Hãy để Coach Edina Trâm đồng hành cùng bạn trên hành trình này.'));
    edt_text_field('_dv1_cta_label', 'Nút CTA — Nhãn', $f('dv1_cta_label', 'Đăng Ký Workshop Ngay →'));
    edt_url_field('_dv1_cta_url', 'Nút CTA — Link', $f('dv1_cta_url', 'https://zalo.me/0901234567'));
    edt_text_field('_dv1_cta_phone', 'Số điện thoại', $f('dv1_cta_phone', '0901 234 567'));
    edt_close_tab();
}


/* ============================================================
   SAVE META BOX
   ============================================================ */
add_action('save_post_page', function ($post_id) {

    // Nonce check
    if (!isset($_POST['edt_dv1_nonce']) || !wp_verify_nonce($_POST['edt_dv1_nonce'], 'edt_save_dv1')) return;

    // Autosave check
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    // Capability check
    if (!current_user_can('edit_page', $post_id)) return;

    // Only save for dich-vu-1
    $post = get_post($post_id);
    if (!$post || $post->post_name !== 'dich-vu-1') return;


    /* ── Text fields (sanitize_text_field) ── */
    $text_fields = [
        // Sticky CTA
        'dv1_sticky_title',
        'dv1_sticky_meta',
        'dv1_sticky_cta_label',
        // Hero
        'dv1_hero_badge',
        'dv1_hero_tagline',
        'dv1_hero_desc',
        'dv1_hero_duration',
        'dv1_hero_date',
        'dv1_hero_price',
        'dv1_hero_countdown',
        'dv1_hero_cta_label',
        // Credibility
        'dv1_cred_badge',
        'dv1_cred_title',
        'dv1_cred_desc',
        'dv1_cred_stat1_num', 'dv1_cred_stat1_label',
        'dv1_cred_stat2_num', 'dv1_cred_stat2_label',
        'dv1_cred_stat3_num', 'dv1_cred_stat3_label',
        'dv1_cred_stat4_num', 'dv1_cred_stat4_label',
        // Target
        'dv1_target_badge',
        'dv1_target_title',
        // Benefits
        'dv1_benefit_badge',
        'dv1_benefit_title',
        'dv1_ben1_icon', 'dv1_ben1_title', 'dv1_ben1_desc',
        'dv1_ben2_icon', 'dv1_ben2_title', 'dv1_ben2_desc',
        'dv1_ben3_icon', 'dv1_ben3_title', 'dv1_ben3_desc',
        'dv1_ben4_icon', 'dv1_ben4_title', 'dv1_ben4_desc',
        'dv1_ben5_icon', 'dv1_ben5_title', 'dv1_ben5_desc',
        'dv1_ben6_icon', 'dv1_ben6_title', 'dv1_ben6_desc',
        // Modules
        'dv1_mod_badge',
        'dv1_mod_title',
        'dv1_mod1_label', 'dv1_mod1_title',
        'dv1_mod2_label', 'dv1_mod2_title',
        'dv1_mod3_label', 'dv1_mod3_title',
        // Testimonials
        'dv1_testi_badge',
        'dv1_testi_title',
        // Instructor credentials
        'dv1_inst_cred1_num', 'dv1_inst_cred1_text',
        'dv1_inst_cred2_num', 'dv1_inst_cred2_text',
        'dv1_inst_cred3_num', 'dv1_inst_cred3_text',
        'dv1_inst_cred4_num', 'dv1_inst_cred4_text',
        'dv1_inst_cred5_num', 'dv1_inst_cred5_text',
        // FAQ
        'dv1_faq_badge',
        'dv1_faq_title',
        // CTA Final
        'dv1_cta_quote',
        'dv1_cta_desc',
        'dv1_cta_label',
        'dv1_cta_phone',
    ];

    foreach ($text_fields as $key) {
        if (isset($_POST['_' . $key])) {
            update_post_meta($post_id, '_' . $key, sanitize_text_field(wp_unslash($_POST['_' . $key])));
        }
    }


    /* ── Rich text fields (wp_kses_post) ── */
    $rich_fields = [
        'dv1_hero_title',
        'dv1_hero_scholarship',
        'dv1_target1_desc', 'dv1_target2_desc', 'dv1_target3_desc',
        'dv1_target4_desc', 'dv1_target5_desc', 'dv1_target6_desc',
        'dv1_mod1_desc', 'dv1_mod2_desc', 'dv1_mod3_desc',
        'dv1_cta_title',
    ];

    foreach ($rich_fields as $key) {
        if (isset($_POST['_' . $key])) {
            update_post_meta($post_id, '_' . $key, wp_kses_post(wp_unslash($_POST['_' . $key])));
        }
    }


    /* ── URL fields (esc_url_raw) ── */
    $url_fields = [
        'dv1_sticky_cta_url',
        'dv1_hero_cta_url',
        'dv1_cta_url',
    ];

    foreach ($url_fields as $key) {
        if (isset($_POST['_' . $key])) {
            update_post_meta($post_id, '_' . $key, esc_url_raw(wp_unslash($_POST['_' . $key])));
        }
    }


    /* ── Image fields (absint) ── */
    $image_fields = [
        'dv1_hero_image',
        'dv1_inst_image',
    ];

    foreach ($image_fields as $key) {
        if (isset($_POST['_' . $key])) {
            update_post_meta($post_id, '_' . $key, absint($_POST['_' . $key]));
        }
    }
});
