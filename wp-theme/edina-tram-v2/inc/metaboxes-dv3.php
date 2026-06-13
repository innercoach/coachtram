<?php
/**
 * Metaboxes — Dịch vụ 3 (Business Mastery)
 * Shows only on page with slug 'dich-vu-3'.
 */

/* ============================================================
   REGISTER META BOX
   ============================================================ */
add_action('add_meta_boxes', function () {
    $screen = get_current_screen();
    if ($screen->id !== 'page') return;
    global $post;
    if (!$post || $post->post_name !== 'dich-vu-3') return;

    add_meta_box(
        'edt_dv3_metabox',
        '⚡ Business Mastery — Nội dung trang',
        'edt_dv3_render',
        'page',
        'normal',
        'high'
    );
});


/* ============================================================
   RENDER CALLBACK
   ============================================================ */
function edt_dv3_render($post) {
    wp_nonce_field('edt_save_dv3', 'edt_dv3_nonce');

    $g = function ($key, $default = '') use ($post) {
        $val = get_post_meta($post->ID, '_dv3_' . $key, true);
        return ($val !== '' && $val !== false) ? $val : $default;
    };

    $img_val = function ($key) use ($post) {
        return get_post_meta($post->ID, '_dv3_' . $key, true);
    };

    // ── Tab navigation ──
    edt_render_tabs([
        'edt-dv3-sticky'  => '📌 Sticky CTA',
        'edt-dv3-hero'    => '🎯 Hero',
        'edt-dv3-pain'    => '😰 Nỗi đau',
        'edt-dv3-target'  => '🎯 Đối tượng',
        'edt-dv3-method'  => '⚡ Phương pháp',
        'edt-dv3-pricing' => '💰 Giá trị & Bảng giá',
        'edt-dv3-cta'     => '📢 CTA cuối',
    ]);


    /* ── TAB 1: Sticky CTA ── */
    edt_open_tab('edt-dv3-sticky', true);
    edt_text_field('_dv3_sticky_title',     'Tiêu đề thanh CTA',       $g('sticky_title', 'Business Mastery – Coaching 1:1'));
    edt_text_field('_dv3_sticky_cta_label', 'Nhãn nút CTA',            $g('sticky_cta_label', 'Liên hệ ngay'));
    edt_url_field('_dv3_sticky_cta_url',    'Link nút CTA',            $g('sticky_cta_url', ''));
    edt_close_tab();


    /* ── TAB 2: Hero ── */
    edt_open_tab('edt-dv3-hero');
    edt_text_field('_dv3_hero_badge',     'Badge',              $g('hero_badge', 'COACHING 1:1 CHIẾN LƯỢC DÀI HẠN'));
    edt_editor_field('_dv3_hero_title',   'Tiêu đề chính',     $g('hero_title', '<h1>BUSINESS<br><span>MASTERY</span></h1>'), 'Dùng HTML: <h1>BUSINESS<br><span>MASTERY</span></h1>');
    edt_text_field('_dv3_hero_tagline',   'Tagline',            $g('hero_tagline', 'Khai vấn chiến lược 1:1 cho doanh nhân F&B'));
    edt_textarea_field('_dv3_hero_desc',  'Mô tả',             $g('hero_desc', 'Chương trình coaching cá nhân hoá cao cấp nhất, nơi bạn được đồng hành 1:1 cùng Coach Edina Trâm để giải quyết các bài toán chiến lược riêng biệt của doanh nghiệp, từ mở rộng quy mô, tối ưu hệ thống đến xây dựng thương hiệu bền vững trong ngành F&B.'));
    edt_text_field('_dv3_hero_gift',      'Gift badge',         $g('hero_gift', '🎁 Tặng buổi tư vấn chiến lược $200 cho 3 khách đăng ký sớm nhất'), 'Để trống nếu không hiển thị');
    edt_text_field('_dv3_hero_cta_label', 'Nhãn nút CTA',      $g('hero_cta_label', 'ĐĂNG KÝ TƯ VẤN 1:1'));
    edt_url_field('_dv3_hero_cta_url',    'Link CTA',           $g('hero_cta_url', ''));
    edt_image_field('_dv3_hero_image',    'Ảnh hero',           $img_val('hero_image'));
    edt_close_tab();


    /* ── TAB 3: Nỗi đau (Pain Points) ── */
    edt_open_tab('edt-dv3-pain');
    edt_text_field('_dv3_pain_badge', 'Badge',       $g('pain_badge', 'THÁCH THỨC'));
    edt_text_field('_dv3_pain_title', 'Tiêu đề',     $g('pain_title', 'Bạn đang đối mặt với những bài toán này?'));
    edt_textarea_field('_dv3_pain_desc', 'Mô tả',    $g('pain_desc', 'Khi doanh nghiệp đã vượt qua giai đoạn khởi sự, những thách thức mới ở tầm chiến lược bắt đầu xuất hiện.'));

    $pain_defaults = [
        1 => ['DOANH THU CHẠM TRẦN', 'Bạn đã có doanh thu ổn, nhưng không thể tăng trưởng thêm. Mọi nỗ lực dường như chỉ giữ nguyên hiện trạng mà không tạo ra đột phá đáng kể nào.'],
        2 => ['HỆ THỐNG KHÔNG SCALE ĐƯỢC', 'Mở thêm chi nhánh nhưng lợi nhuận không tăng tương xứng. Quy trình vận hành phụ thuộc quá nhiều vào bạn, không thể nhân bản.'],
        3 => ['TEAM QUẢN LÝ YẾU', 'Đội ngũ giỏi chuyên môn nhưng thiếu tư duy quản trị. Bạn là người duy nhất ra quyết định và thường xuyên phải "chữa cháy" liên tục.'],
        4 => ['THƯƠNG HIỆU MỜ NHẠT', 'Giữa thị trường F&B ngày càng cạnh tranh, thương hiệu của bạn thiếu điểm khác biệt rõ ràng. Khách hàng đến rồi đi mà không gắn bó lâu dài.'],
        5 => ['CHỦ DOANH NGHIỆP CÔ ĐƠN', 'Bạn không có ai để trao đổi ở cùng tầm. Những quyết định lớn – mở rộng, nhượng quyền, tái cấu trúc – bạn phải tự mình gánh vác.'],
    ];
    for ($i = 1; $i <= 5; $i++) {
        echo '<h4 class="edt-section-title">Nỗi đau #' . $i . ($i === 5 ? ' (full-width)' : '') . '</h4>';
        edt_text_field("_dv3_pain{$i}_title", "Tiêu đề #{$i}", $g("pain{$i}_title", $pain_defaults[$i][0]));
        edt_textarea_field("_dv3_pain{$i}_desc", "Mô tả #{$i}", $g("pain{$i}_desc", $pain_defaults[$i][1]));
    }
    edt_close_tab();


    /* ── TAB 4: Đối tượng (Target) ── */
    edt_open_tab('edt-dv3-target');
    edt_text_field('_dv3_target_badge', 'Badge',   $g('target_badge', 'DÀNH CHO AI'));
    edt_text_field('_dv3_target_title', 'Tiêu đề', $g('target_title', 'Business Mastery dành cho bạn nếu…'));

    $target_defaults = [
        1 => ['🏢', 'Chủ doanh nghiệp F&B đã vận hành 2+ năm', 'Bạn đã có doanh thu ổn định, đội ngũ vận hành, nhưng đang tìm kiếm <strong>bước nhảy tiếp theo</strong> để mở rộng quy mô hoặc tối ưu lợi nhuận.'],
        2 => ['📈', 'Người muốn mở rộng chuỗi / nhượng quyền', 'Bạn đang cân nhắc mở thêm chi nhánh, nhượng quyền hoặc xây dựng hệ thống <strong>vận hành không phụ thuộc bản thân</strong>.'],
        3 => ['🎯', 'Lãnh đạo muốn nâng tầm chiến lược', 'Bạn cần một <strong>không gian chiến lược riêng tư</strong> để suy nghĩ sâu, đặt câu hỏi đúng và có người đồng hành đủ tầm phản biện.'],
        4 => ['⚡', 'Doanh nhân muốn vừa kinh doanh, vừa sống', 'Bạn đã mệt mỏi khi kinh doanh "ăn" hết cuộc sống. Bạn muốn <strong>tái thiết kế doanh nghiệp</strong> để có lợi nhuận VÀ tự do thời gian.'],
    ];
    for ($i = 1; $i <= 4; $i++) {
        echo '<h4 class="edt-section-title">Đối tượng #' . $i . '</h4>';
        edt_text_field("_dv3_target{$i}_icon",  "Icon (emoji) #{$i}",  $g("target{$i}_icon",  $target_defaults[$i][0]));
        edt_text_field("_dv3_target{$i}_title", "Tiêu đề #{$i}",      $g("target{$i}_title", $target_defaults[$i][1]));
        edt_textarea_field("_dv3_target{$i}_desc", "Mô tả #{$i}",     $g("target{$i}_desc",  $target_defaults[$i][2]), 'Hỗ trợ <strong>, <em>');
    }
    edt_close_tab();


    /* ── TAB 5: Phương pháp (Method) ── */
    edt_open_tab('edt-dv3-method');
    edt_text_field('_dv3_method_badge', 'Badge',   $g('method_badge', 'PHƯƠNG PHÁP'));
    edt_text_field('_dv3_method_title', 'Tiêu đề', $g('method_title', 'Coaching 1:1 khác gì khoá học nhóm?'));

    // Negative items
    echo '<h4 class="edt-section-title">❌ Cột Tiêu cực (Khoá học nhóm)</h4>';
    edt_text_field('_dv3_method_neg_title', 'Tiêu đề cột', $g('method_neg_title', '❌ Khoá học nhóm thông thường'));
    $neg_defaults = [
        'Nội dung chung, không giải quyết vấn đề riêng của bạn',
        'Kiến thức nhiều nhưng không biết áp dụng vào đâu',
        'Thiếu cam kết follow-up và đo lường kết quả',
        'Không có không gian riêng tư để chia sẻ vấn đề nhạy cảm',
        'Kết thúc khoá học là hết đồng hành',
    ];
    for ($i = 1; $i <= 5; $i++) {
        edt_text_field("_dv3_method_neg{$i}", "Mục #{$i}", $g("method_neg{$i}", $neg_defaults[$i - 1]));
    }

    // Positive items
    echo '<h4 class="edt-section-title">✅ Cột Tích cực (Coaching 1:1)</h4>';
    edt_text_field('_dv3_method_pos_title', 'Tiêu đề cột', $g('method_pos_title', '✅ Coaching 1:1 Business Mastery'));
    $pos_defaults = [
        '100% cá nhân hoá theo bài toán doanh nghiệp của bạn',
        'Giải pháp có thể triển khai ngay sau mỗi buổi coaching',
        'Follow-up liên tục, đo lường bằng KPIs rõ ràng',
        'Không gian bảo mật tuyệt đối – chỉ bạn và Coach',
        'Đồng hành dài hạn 3–12 tháng, phát triển bền vững',
    ];
    for ($i = 1; $i <= 5; $i++) {
        edt_text_field("_dv3_method_pos{$i}", "Mục #{$i}", $g("method_pos{$i}", $pos_defaults[$i - 1]));
    }

    // Focus badges
    echo '<h4 class="edt-section-title">🏷️ Focus Badges (Lĩnh vực trọng tâm)</h4>';
    $badge_defaults = [
        'Chiến lược Tăng trưởng', 'Mở rộng Chuỗi', 'Xây dựng Đội ngũ', 'Tối ưu Vận hành',
        'Branding & Marketing', 'Quản trị Tài chính', 'Phát triển Lãnh đạo', 'Work-Life Harmony',
    ];
    for ($i = 1; $i <= 8; $i++) {
        edt_text_field("_dv3_method_focus{$i}", "Badge #{$i}", $g("method_focus{$i}", $badge_defaults[$i - 1]), 'Để trống để ẩn');
    }

    edt_textarea_field('_dv3_method_note', 'Ghi chú cuối', $g('method_note', '* Mỗi chương trình coaching được thiết kế riêng dựa trên nhu cầu thực tế và mục tiêu kinh doanh cụ thể của bạn. Không có hai chương trình giống nhau.'));
    edt_close_tab();


    /* ── TAB 6: Giá trị & Bảng giá ── */
    edt_open_tab('edt-dv3-pricing');

    // Value cards
    edt_text_field('_dv3_val_badge', 'Badge',   $g('val_badge', 'GIÁ TRỊ'));
    edt_text_field('_dv3_val_title', 'Tiêu đề', $g('val_title', '3 giá trị cốt lõi bạn nhận được'));

    $val_defaults = [
        1 => ['CLARITY – SỰ RÕ RÀNG', 'Bạn sẽ có bức tranh toàn cảnh về doanh nghiệp – biết chính xác đâu là nút thắt, đâu là đòn bẩy tăng trưởng, và đâu là bước đi tiếp theo cần ưu tiên.'],
        2 => ['STRATEGY – CHIẾN LƯỢC', 'Không chỉ biết "cần làm gì" mà còn có lộ trình "làm như thế nào" với kế hoạch hành động chi tiết, KPIs đo lường rõ ràng và timeline thực tế.'],
        3 => ['TRANSFORMATION – CHUYỂN HOÁ', 'Không chỉ thay đổi doanh nghiệp mà thay đổi chính bạn – từ tư duy "người thợ" sang tư duy "nhà lãnh đạo", từ làm việc TRONG doanh nghiệp sang làm việc TRÊN doanh nghiệp.'],
    ];
    for ($i = 1; $i <= 3; $i++) {
        echo '<h4 class="edt-section-title">Giá trị #' . $i . '</h4>';
        edt_text_field("_dv3_val{$i}_title", "Tiêu đề #{$i}", $g("val{$i}_title", $val_defaults[$i][0]));
        edt_textarea_field("_dv3_val{$i}_desc", "Mô tả #{$i}", $g("val{$i}_desc", $val_defaults[$i][1]));
    }

    // Deliverable cards
    echo '<h4 class="edt-section-title">📦 Deliverables (Bạn nhận được gì)</h4>';
    $deliv_defaults = [
        1 => ['🎯 Buổi coaching 1:1 mỗi tuần', '60–90 phút/buổi với Coach Edina Trâm. Tập trung giải quyết bài toán cụ thể của bạn trong tuần đó.'],
        2 => ['📋 Bản chiến lược cá nhân hoá', 'Kế hoạch hành động chi tiết, được thiết kế riêng với KPIs, timeline và milestones cho doanh nghiệp bạn.'],
        3 => ['📞 Hỗ trợ qua chat không giới hạn', 'Gặp vấn đề gấp? Nhắn tin cho Coach bất cứ lúc nào. Cam kết phản hồi trong vòng 24h làm việc.'],
        4 => ['📊 Bộ công cụ quản trị F&B', 'Template tài chính, quy trình vận hành, checklist quản lý, bảng theo dõi KPIs – sẵn sàng áp dụng.'],
        5 => ['🔒 Quyền truy cập khoá B2F', 'Nhận miễn phí toàn bộ nội dung khoá Business to Freedom (trị giá 15.000.000 VNĐ) làm kiến thức nền tảng.'],
        6 => ['🤝 Cộng đồng Mastermind', 'Kết nối với các chủ doanh nghiệp F&B khác trong mạng lưới Business Mastery – chia sẻ, học hỏi và hợp tác.'],
    ];
    for ($i = 1; $i <= 6; $i++) {
        echo '<div class="edt-group"><p class="edt-group-title">Deliverable #' . $i . '</p>';
        edt_text_field("_dv3_deliv{$i}_title", "Tiêu đề", $g("deliv{$i}_title", $deliv_defaults[$i][0]));
        edt_textarea_field("_dv3_deliv{$i}_desc", "Mô tả", $g("deliv{$i}_desc", $deliv_defaults[$i][1]));
        echo '</div>';
    }

    // Comparison table
    echo '<h4 class="edt-section-title">📊 Bảng so sánh (B2F vs BM)</h4>';
    edt_text_field('_dv3_pricing_badge', 'Badge mục so sánh',  $g('pricing_badge', 'SO SÁNH & ĐẦU TƯ'));
    edt_text_field('_dv3_pricing_title', 'Tiêu đề mục so sánh', $g('pricing_title', 'Chọn gói phù hợp với bạn'));

    $compare_defaults = [
        1 => ['Hình thức', 'Khoá học nhóm online', 'Coaching 1:1 riêng tư'],
        2 => ['Thời lượng', '10 tuần cố định', '3 – 12 tháng linh hoạt'],
        3 => ['Nội dung', 'Chương trình có sẵn', '100% cá nhân hoá'],
        4 => ['Đối tượng', 'Mới kinh doanh / startup', 'Chủ DN đã vận hành 2+ năm'],
        5 => ['Hỗ trợ', 'Trong giờ học + nhóm', 'Chat 24/7 + Gọi khẩn cấp'],
        6 => ['Follow-up', 'Bài tập nhóm', 'KPIs & Accountability cá nhân'],
        7 => ['Mức đầu tư', '15.000.000 VNĐ', 'Từ 60.000.000 VNĐ'],
    ];
    echo '<table class="widefat" style="max-width:800px;margin-bottom:20px;">';
    echo '<thead><tr><th>#</th><th>Tiêu chí</th><th>Business to Freedom</th><th>Business Mastery</th></tr></thead><tbody>';
    for ($i = 1; $i <= 7; $i++) {
        echo '<tr>';
        echo '<td>' . $i . '</td>';
        echo '<td><input type="text" name="_dv3_compare' . $i . '_criteria" value="' . esc_attr($g("compare{$i}_criteria", $compare_defaults[$i][0])) . '" style="width:100%;"></td>';
        echo '<td><input type="text" name="_dv3_compare' . $i . '_b2f" value="' . esc_attr($g("compare{$i}_b2f", $compare_defaults[$i][1])) . '" style="width:100%;"></td>';
        echo '<td><input type="text" name="_dv3_compare' . $i . '_bm" value="' . esc_attr($g("compare{$i}_bm", $compare_defaults[$i][2])) . '" style="width:100%;"></td>';
        echo '</tr>';
    }
    echo '</tbody></table>';

    // Pricing plans
    echo '<h4 class="edt-section-title">💰 Gói giá (3 gói)</h4>';
    $plan_defaults = [
        1 => ['3 Tháng', 'Trải nghiệm & Khám phá', '60.000.000 VNĐ', "12 buổi coaching 1:1\nBản chiến lược 90 ngày\nHỗ trợ chat trong giờ hành chính\nBộ công cụ quản trị F&B", ''],
        2 => ['6 Tháng', 'Chuyển hoá & Tăng trưởng', '100.000.000 VNĐ', "24 buổi coaching 1:1\nChiến lược 6 tháng toàn diện\nChat không giới hạn + Gọi khẩn cấp\nTruy cập khoá B2F miễn phí\nCộng đồng Mastermind", '1'],
        3 => ['12 Tháng', 'Bền vững & Nhân rộng', '180.000.000 VNĐ', "48 buổi coaching 1:1\nChiến lược dài hạn toàn diện\nChat & Gọi không giới hạn\nTruy cập khoá B2F + Tất cả công cụ\nMastermind VIP + 2 buổi on-site\nƯu tiên slot coaching vĩnh viễn", ''],
    ];
    for ($i = 1; $i <= 3; $i++) {
        $featured_val = $g("plan{$i}_featured", $plan_defaults[$i][4]);
        echo '<div class="edt-group"><p class="edt-group-title">Gói #' . $i . '</p>';
        edt_text_field("_dv3_plan{$i}_duration", "Thời hạn",     $g("plan{$i}_duration", $plan_defaults[$i][0]));
        edt_text_field("_dv3_plan{$i}_subtitle", "Phụ đề",       $g("plan{$i}_subtitle", $plan_defaults[$i][1]));
        edt_text_field("_dv3_plan{$i}_price",    "Giá",           $g("plan{$i}_price",    $plan_defaults[$i][2]));
        edt_textarea_field("_dv3_plan{$i}_features", "Tính năng", $g("plan{$i}_features", $plan_defaults[$i][3]), 'Mỗi tính năng 1 dòng');

        // Featured checkbox (raw HTML since no helper)
        echo '<div class="edt-field-row">';
        echo '<label>';
        echo '<input type="checkbox" name="_dv3_plan' . $i . '_featured" value="1"' . checked($featured_val, '1', false) . '> ';
        echo 'Gói nổi bật (hiển thị badge "Phổ biến nhất")';
        echo '</label>';
        echo '</div>';

        echo '</div>';
    }

    // Capacity note
    edt_textarea_field('_dv3_capacity_note', 'Ghi chú giới hạn', $g('capacity_note', 'Chương trình Business Mastery chỉ nhận tối đa <strong>5 khách hàng</strong> đồng thời để đảm bảo chất lượng đồng hành tuyệt đối.'), 'Hỗ trợ <strong>');
    edt_close_tab();


    /* ── TAB 7: CTA cuối ── */
    edt_open_tab('edt-dv3-cta');
    edt_text_field('_dv3_cta_badge',     'Badge',           $g('cta_badge', 'BUSINESS MASTERY'));
    edt_editor_field('_dv3_cta_title',   'Tiêu đề',        $g('cta_title', '<h2>Bắt đầu thiết lập tương lai bền vững cho thương hiệu F&B của bạn</h2>'), 'Dùng thẻ <h2>');
    edt_textarea_field('_dv3_cta_desc',  'Mô tả',          $g('cta_desc', 'Đặt lịch trao đổi 30 phút miễn phí với Coach Edina Trâm để cùng đánh giá hiện trạng doanh nghiệp và xác định liệu Business Mastery có phù hợp với bạn.'));
    edt_text_field('_dv3_cta_label',     'Nhãn nút CTA',   $g('cta_label', 'ĐẶT LỊCH TƯ VẤN MIỄN PHÍ'));
    edt_url_field('_dv3_cta_url',        'Link CTA',        $g('cta_url', ''));
    edt_text_field('_dv3_cta_note',      'Ghi chú bảo mật', $g('cta_note', '🔒 Mọi thông tin được bảo mật tuyệt đối. Không ràng buộc.'));
    edt_close_tab();
}


/* ============================================================
   SAVE POST META
   ============================================================ */
add_action('save_post_page', function ($post_id) {

    // Nonce check
    if (!isset($_POST['edt_dv3_nonce']) || !wp_verify_nonce($_POST['edt_dv3_nonce'], 'edt_save_dv3')) return;

    // Autosave check
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    // Capability check
    if (!current_user_can('edit_page', $post_id)) return;

    // Only save for dich-vu-3
    $post = get_post($post_id);
    if (!$post || $post->post_name !== 'dich-vu-3') return;

    // ── Text fields ──
    $text_fields = [
        // Sticky CTA
        'sticky_title', 'sticky_cta_label',
        // Hero
        'hero_badge', 'hero_tagline', 'hero_desc', 'hero_gift', 'hero_cta_label',
        // Pain Points
        'pain_badge', 'pain_title', 'pain_desc',
        'pain1_title', 'pain1_desc', 'pain2_title', 'pain2_desc',
        'pain3_title', 'pain3_desc', 'pain4_title', 'pain4_desc',
        'pain5_title', 'pain5_desc',
        // Target
        'target_badge', 'target_title',
        'target1_icon', 'target1_title',
        'target2_icon', 'target2_title',
        'target3_icon', 'target3_title',
        'target4_icon', 'target4_title',
        // Method
        'method_badge', 'method_title',
        'method_neg_title', 'method_neg1', 'method_neg2', 'method_neg3', 'method_neg4', 'method_neg5',
        'method_pos_title', 'method_pos1', 'method_pos2', 'method_pos3', 'method_pos4', 'method_pos5',
        'method_focus1', 'method_focus2', 'method_focus3', 'method_focus4',
        'method_focus5', 'method_focus6', 'method_focus7', 'method_focus8',
        'method_note',
        // Values
        'val_badge', 'val_title',
        'val1_title', 'val1_desc', 'val2_title', 'val2_desc', 'val3_title', 'val3_desc',
        // Deliverables
        'deliv1_title', 'deliv1_desc', 'deliv2_title', 'deliv2_desc',
        'deliv3_title', 'deliv3_desc', 'deliv4_title', 'deliv4_desc',
        'deliv5_title', 'deliv5_desc', 'deliv6_title', 'deliv6_desc',
        // Pricing header
        'pricing_badge', 'pricing_title',
        // Plans
        'plan1_duration', 'plan1_subtitle', 'plan1_price', 'plan1_features',
        'plan2_duration', 'plan2_subtitle', 'plan2_price', 'plan2_features',
        'plan3_duration', 'plan3_subtitle', 'plan3_price', 'plan3_features',
        // CTA Final
        'cta_badge', 'cta_desc', 'cta_label', 'cta_note',
    ];
    foreach ($text_fields as $f) {
        $key = '_dv3_' . $f;
        if (isset($_POST[$key])) {
            update_post_meta($post_id, $key, sanitize_text_field(wp_unslash($_POST[$key])));
        }
    }

    // ── Textarea / wp_kses_post fields ──
    $kses_fields = [
        'target1_desc', 'target2_desc', 'target3_desc', 'target4_desc',
        'capacity_note',
    ];
    foreach ($kses_fields as $f) {
        $key = '_dv3_' . $f;
        if (isset($_POST[$key])) {
            update_post_meta($post_id, $key, wp_kses_post(wp_unslash($_POST[$key])));
        }
    }

    // ── Rich text (wp_editor) fields ──
    $editor_fields = ['hero_title', 'cta_title'];
    foreach ($editor_fields as $f) {
        $key = '_dv3_' . $f;
        if (isset($_POST[$key])) {
            update_post_meta($post_id, $key, wp_kses_post(wp_unslash($_POST[$key])));
        }
    }

    // ── URL fields ──
    $url_fields = ['sticky_cta_url', 'hero_cta_url', 'cta_url'];
    foreach ($url_fields as $f) {
        $key = '_dv3_' . $f;
        if (isset($_POST[$key])) {
            update_post_meta($post_id, $key, esc_url_raw(wp_unslash($_POST[$key])));
        }
    }

    // ── Image fields ──
    $image_fields = ['hero_image'];
    foreach ($image_fields as $f) {
        $key = '_dv3_' . $f;
        if (isset($_POST[$key])) {
            update_post_meta($post_id, $key, absint($_POST[$key]));
        }
    }

    // ── Comparison table fields ──
    for ($i = 1; $i <= 7; $i++) {
        foreach (['criteria', 'b2f', 'bm'] as $col) {
            $key = "_dv3_compare{$i}_{$col}";
            if (isset($_POST[$key])) {
                update_post_meta($post_id, $key, sanitize_text_field(wp_unslash($_POST[$key])));
            }
        }
    }

    // ── Featured checkboxes ──
    for ($i = 1; $i <= 3; $i++) {
        $key = "_dv3_plan{$i}_featured";
        $val = isset($_POST[$key]) ? '1' : '';
        update_post_meta($post_id, $key, $val);
    }
});
