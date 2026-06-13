<?php
/**
 * Metaboxes — Dịch vụ 2: Business to Freedom
 * Page slug: dich-vu-2
 */

/* ============================================================
   REGISTER META BOX
   ============================================================ */
add_action('add_meta_boxes', function () {
    $screen = get_current_screen();
    if ($screen->id !== 'page') return;
    global $post;
    if (!$post || $post->post_name !== 'dich-vu-2') return;

    add_meta_box(
        'edt_dv2_metabox',
        '⚙️ Nội dung — Business to Freedom',
        'edt_dv2_render',
        'page',
        'normal',
        'high'
    );
});


/* ============================================================
   RENDER CALLBACK
   ============================================================ */
function edt_dv2_render($post) {
    wp_nonce_field('edt_save_dv2', 'edt_dv2_nonce');
    $f = function ($key, $default = '') use ($post) {
        $val = get_post_meta($post->ID, '_' . $key, true);
        return ($val !== '' && $val !== false) ? $val : $default;
    };

    edt_render_tabs([
        'edt-dv2-sticky'  => '📌 Sticky CTA',
        'edt-dv2-hero'    => '🎯 Hero',
        'edt-dv2-pain'    => '😰 Nỗi đau',
        'edt-dv2-target'  => '🎯 Đối tượng',
        'edt-dv2-mmf'     => '💎 Giá trị MMF',
        'edt-dv2-diff'    => '⚡ Khác biệt',
        'edt-dv2-cur'     => '📅 Lộ trình 10 tuần',
        'edt-dv2-testi'   => '💬 Nhận xét',
        'edt-dv2-inst'    => '👨‍🏫 Giảng viên',
        'edt-dv2-faq'     => '❓ FAQ',
    ]);

    /* ─── TAB 1: Sticky CTA ─── */
    edt_open_tab('edt-dv2-sticky', true);
    edt_text_field('_dv2_sticky_title', 'Tiêu đề', $f('dv2_sticky_title', 'Business to Freedom – 10 tuần'));
    edt_text_field('_dv2_sticky_meta', 'Phụ đề', $f('dv2_sticky_meta', 'Khai giảng 27/03/2026 · Chỉ 10 chỗ'));
    edt_text_field('_dv2_sticky_cta_label', 'Nhãn nút', $f('dv2_sticky_cta_label', 'Giữ Chỗ Ngay'));
    edt_url_field('_dv2_sticky_cta_url', 'Link nút', $f('dv2_sticky_cta_url', ''));
    edt_close_tab();

    /* ─── TAB 2: Hero ─── */
    edt_open_tab('edt-dv2-hero');
    edt_text_field('_dv2_hero_badge', 'Badge', $f('dv2_hero_badge', 'KHOÁ HỌC 10 TUẦN'));
    edt_editor_field('_dv2_hero_title', 'Tiêu đề (HTML)', $f('dv2_hero_title', 'BUSINESS<br>to <span>FREEDOM</span>'), 'Cho phép HTML: &lt;br&gt;, &lt;span&gt;');
    edt_text_field('_dv2_hero_tagline', 'Tagline', $f('dv2_hero_tagline', 'Từ vận hành đến tự do — Xây dựng doanh nghiệp bền vững'));
    edt_textarea_field('_dv2_hero_desc', 'Mô tả', $f('dv2_hero_desc', 'Đam mê và Lợi nhuận là nền tảng, nhưng Tự do mới là đích đến. Hãy để chương trình 10 tuần Business to Freedom dẫn bạn đến nơi đó.'));
    edt_text_field('_dv2_hero_schedule', 'Lịch học', $f('dv2_hero_schedule', '10 buổi · 3h/buổi'));
    edt_text_field('_dv2_hero_date', 'Ngày khai giảng', $f('dv2_hero_date', '27/03 – 29/05/2026'));
    edt_text_field('_dv2_hero_price', 'Chi phí', $f('dv2_hero_price', '15.000.000 VNĐ'));
    edt_text_field('_dv2_hero_max_note', 'Ghi chú số lượng', $f('dv2_hero_max_note', '* Khoá học chỉ nhận tối đa 10 học viên để đảm bảo chất lượng'));
    edt_datetime_field('_dv2_hero_countdown', 'Countdown (datetime)', $f('dv2_hero_countdown', '2026-03-27T10:00:00'), 'Định dạng: YYYY-MM-DDTHH:MM:SS');
    edt_text_field('_dv2_hero_cta_label', 'Nhãn nút CTA', $f('dv2_hero_cta_label', 'ĐĂNG KÝ NGAY'));
    edt_url_field('_dv2_hero_cta_url', 'Link nút CTA', $f('dv2_hero_cta_url', ''));
    edt_image_field('_dv2_hero_image', 'Ảnh Hero', $f('dv2_hero_image', ''));
    edt_close_tab();

    /* ─── TAB 3: Nỗi đau ─── */
    edt_open_tab('edt-dv2-pain');
    edt_text_field('_dv2_pain_badge', 'Badge', $f('dv2_pain_badge', 'Bạn có đang gặp phải?'));
    edt_text_field('_dv2_pain_title', 'Tiêu đề section', $f('dv2_pain_title', 'Bạn có đang đối diện với những vấn đề này?'));

    $pain_defaults = [
        ['ĐAM MÊ NHƯNG MƠ HỒ', 'Bạn yêu ẩm thực, mơ một ngày có quán riêng. Nhưng khi bắt tay vào, bạn không biết viết kế hoạch ra sao, vốn bao nhiêu là đủ, và khách hàng mục tiêu thực sự là ai.'],
        ['DOANH THU BẤP BÊNH', 'Quán của bạn có ngày đông khách, có ngày lại vắng hoe. Dù làm rất nhiều nhưng cuối tháng nhìn vào sổ sách thì lời lãi chẳng thấy đâu.'],
        ['CHI PHÍ ĐỘI LÊN', 'Tiền thuê mặt bằng, nhân sự, nguyên liệu... liên tục "ăn mòn" lợi nhuận. Bạn thấy dòng tiền chảy ra nhiều hơn chảy vào nhưng không rõ nguyên nhân.'],
        ['NHÂN SỰ BẤT ỔN', 'Nhân viên mới vào rồi lại nghỉ. Bạn vừa đào tạo xong một người thì họ lại bỏ đi. Quán thiếu người, còn bạn thì kiệt sức vì phải làm tất cả mọi việc.'],
        ['BỊ CUỐN 24/7', 'Bạn giống như "nô lệ" của quán mình. Ngày nào cũng quần quật, không còn thời gian cho gia đình, bạn bè, hay cho chính bản thân.'],
        ['THẤT BẠI VÀ HOANG MANG', 'Có thể bạn đã từng đóng cửa một quán trước đây. Nỗi đau còn đó, và bạn vẫn tự hỏi: "Nếu mình làm lại lần nữa, liệu có khác không?"'],
    ];
    for ($i = 1; $i <= 6; $i++) {
        echo '<div class="edt-group"><p class="edt-group-title">Nỗi đau #' . $i . '</p>';
        edt_text_field("_dv2_pain{$i}_title", "Tiêu đề #{$i}", $f("dv2_pain{$i}_title", $pain_defaults[$i - 1][0]));
        edt_textarea_field("_dv2_pain{$i}_desc", "Mô tả #{$i}", $f("dv2_pain{$i}_desc", $pain_defaults[$i - 1][1]));
        echo '</div>';
    }
    edt_close_tab();

    /* ─── TAB 4: Đối tượng ─── */
    edt_open_tab('edt-dv2-target');
    edt_text_field('_dv2_target_badge', 'Badge', $f('dv2_target_badge', 'Dành cho bạn'));
    edt_text_field('_dv2_target_title', 'Tiêu đề section', $f('dv2_target_title', 'Chương trình này dành cho bạn nếu'));

    $target_defaults = [
        ['NGƯỜI CHUẨN BỊ KHỞI NGHIỆP F&B', 'Bạn có <strong>đam mê nhưng chưa bắt đầu</strong>. Bạn muốn đi bài bản ngay từ đầu, có bản đồ rõ ràng để tiết kiệm thời gian, tiền bạc.'],
        ['CHỦ QUÁN ĐANG VẬN HÀNH', 'Bạn đã khởi sự kinh doanh, nhưng đang <strong>loay hoay với doanh thu, chi phí và nhân sự</strong>. Bạn muốn tìm một cách vận hành bài bản để quán ổn định, lợi nhuận rõ ràng.'],
        ['TỪNG THẤT BẠI & MUỐN LÀM LẠI', 'Bạn đã <strong>từng đóng cửa một quán</strong> nhưng vẫn đam mê khởi nghiệp với một lộ trình có hệ thống, với sự đồng hành của một coach thực chiến.'],
        ['NGƯỜI KHAO KHÁT TỰ DO', 'Bạn muốn <strong>xây dựng một mô hình kinh doanh có lợi nhuận bền vững</strong> để bạn vừa kinh doanh hiệu quả, vừa có một cuộc đời tự do.'],
    ];
    for ($i = 1; $i <= 4; $i++) {
        echo '<div class="edt-group"><p class="edt-group-title">Đối tượng #' . $i . '</p>';
        edt_text_field("_dv2_target{$i}_title", "Tiêu đề #{$i}", $f("dv2_target{$i}_title", $target_defaults[$i - 1][0]));
        edt_textarea_field("_dv2_target{$i}_desc", "Mô tả #{$i}", $f("dv2_target{$i}_desc", $target_defaults[$i - 1][1]), 'Cho phép HTML: <strong>, <em>');
        echo '</div>';
    }
    edt_close_tab();

    /* ─── TAB 5: Giá trị MMF ─── */
    edt_open_tab('edt-dv2-mmf');
    edt_text_field('_dv2_mmf_badge', 'Badge', $f('dv2_mmf_badge', 'Lợi ích'));
    edt_text_field('_dv2_mmf_title', 'Tiêu đề section', $f('dv2_mmf_title', '3 Trụ cột giá trị'));
    edt_textarea_field('_dv2_mmf_desc', 'Mô tả section', $f('dv2_mmf_desc', 'Mỗi trụ cột giúp bạn xây dựng nền tảng vững chắc cho hành trình kinh doanh bền vững.'));

    $mmf_defaults = [
        ['M', 'MONEY – Tiền', 'Bạn học cách xây dựng một mô hình kinh doanh có lợi nhuận rõ ràng. Biết quản lý chi phí, định giá đúng, kiểm soát Prime Cost, và tạo ra dòng tiền ổn định.'],
        ['M', 'MEANING – Ý nghĩa', 'Kinh doanh không chỉ là bán món ăn. Đó là hành trình bạn gửi gắm niềm đam mê, giá trị và dấu ấn cá nhân, để mỗi bữa ăn trở thành một trải nghiệm mang ý nghĩa.'],
        ['F', 'FREEDOM – Tự do', 'Không còn bị trói chặt 24/7 trong quán. Với kế hoạch, đội ngũ và quy trình rõ ràng, bạn có thể vừa vận hành kinh doanh, vừa tận hưởng tự do.'],
    ];
    for ($i = 1; $i <= 3; $i++) {
        echo '<div class="edt-group"><p class="edt-group-title">Trụ cột #' . $i . '</p>';
        edt_text_field("_dv2_mmf{$i}_letter", "Chữ cái lớn", $f("dv2_mmf{$i}_letter", $mmf_defaults[$i - 1][0]), 'Chữ hiển thị lớn phía trên (M, M, F)');
        edt_text_field("_dv2_mmf{$i}_title", "Tiêu đề", $f("dv2_mmf{$i}_title", $mmf_defaults[$i - 1][1]));
        edt_textarea_field("_dv2_mmf{$i}_desc", "Mô tả", $f("dv2_mmf{$i}_desc", $mmf_defaults[$i - 1][2]));
        echo '</div>';
    }
    edt_close_tab();

    /* ─── TAB 6: Khác biệt ─── */
    edt_open_tab('edt-dv2-diff');
    edt_text_field('_dv2_diff_badge', 'Badge', $f('dv2_diff_badge', 'Vì sao khác biệt?'));
    edt_text_field('_dv2_diff_title', 'Tiêu đề section', $f('dv2_diff_title', 'Đây không phải khoá học thông thường'));

    $neg_defaults = [
        'Không phải kiến thức lý thuyết sách vở, xa rời thực tế',
        'Không phải lớp học đại trà hàng trăm người, không ai hỏi thăm ai',
        'Không phải hứa hẹn thành công dễ dàng hay công thức "làm giàu nhanh"',
        'Không phải giảng dạy từ người chưa từng kinh doanh thực tế',
    ];
    $pos_defaults = [
        'Kiến thức thực chiến từ 15+ năm kinh nghiệm F&B tại Mỹ và Việt Nam',
        'Lớp học chỉ tối đa 10 người, được coaching sâu sát từng mô hình',
        'Bộ template chuẩn: P&L, Menu Engineering, SOP, Lean Canvas',
        'Cộng đồng chủ quán F&B đồng hành lâu dài sau khoá học',
    ];

    echo '<div class="edt-group"><p class="edt-group-title">❌ Cột phủ định</p>';
    edt_text_field('_dv2_diff_neg_title', 'Tiêu đề cột', $f('dv2_diff_neg_title', 'Không phải khoá học thông thường'));
    for ($i = 1; $i <= 4; $i++) {
        edt_text_field("_dv2_diff_neg{$i}", "Điểm #{$i}", $f("dv2_diff_neg{$i}", $neg_defaults[$i - 1]));
    }
    echo '</div>';

    echo '<div class="edt-group"><p class="edt-group-title">✅ Cột tích cực</p>';
    edt_text_field('_dv2_diff_pos_title', 'Tiêu đề cột', $f('dv2_diff_pos_title', 'Thay vào đó, bạn nhận được'));
    for ($i = 1; $i <= 4; $i++) {
        edt_text_field("_dv2_diff_pos{$i}", "Điểm #{$i}", $f("dv2_diff_pos{$i}", $pos_defaults[$i - 1]));
    }
    echo '</div>';
    edt_close_tab();

    /* ─── TAB 7: Lộ trình 10 tuần ─── */
    edt_open_tab('edt-dv2-cur');
    edt_text_field('_dv2_cur_badge', 'Badge', $f('dv2_cur_badge', 'Lộ trình'));
    edt_text_field('_dv2_cur_title', 'Tiêu đề section', $f('dv2_cur_title', 'Hành trình 10 tuần'));
    edt_textarea_field('_dv2_cur_desc', 'Mô tả section', $f('dv2_cur_desc', 'Mỗi tuần đi sâu vào một trụ cột trong khung chiến lược 5P để bạn xây dựng mô hình bền vững.'));

    $focus_defaults = ['Purpose', 'People', 'Product', 'Profit', 'Peace'];
    echo '<div class="edt-group"><p class="edt-group-title">5 Focus Badges</p>';
    for ($i = 1; $i <= 5; $i++) {
        edt_text_field("_dv2_cur_focus{$i}", "Focus #{$i}", $f("dv2_cur_focus{$i}", $focus_defaults[$i - 1]));
    }
    echo '</div>';

    $week_defaults = [
        ['Tuần 1', 'Passion – Vai trò chủ doanh nghiệp', 'Xác định rõ vai trò người chủ, vẽ bản đồ đam mê và kiểm tra mức độ sẵn sàng khởi nghiệp F&B.'],
        ['Tuần 2', 'Plan – Khởi điểm & mô hình', 'Lựa chọn mô hình kinh doanh phù hợp, phát triển ý tưởng từ đam mê thành kế hoạch cụ thể.'],
        ['Tuần 3', 'Plan – Kế hoạch tài chính', 'Dự toán vốn đầu tư, tính toán điểm hoà vốn, xây dựng bản kế hoạch kinh doanh khả thi.'],
        ['Tuần 4', 'Product – Thực đơn chiến lược', 'Xây dựng menu, định giá từng món, thiết kế thực đơn để vừa thu hút khách vừa đảm bảo lợi nhuận.'],
        ['Tuần 5', 'Product – Mặt bằng & Trải nghiệm', 'Chọn mặt bằng phù hợp, thiết kế trải nghiệm khách hàng độc đáo để tạo dấu ấn thương hiệu.'],
        ['Tuần 6', 'People – Năng lực & mục tiêu', 'Phân tích năng lực bản thân ở vai trò chủ doanh nghiệp, xác định mục tiêu phát triển.'],
        ['Tuần 7', 'People – Kế hoạch nhân sự', 'Xây dựng JD, sơ đồ đội nhóm ban đầu và kế hoạch tuyển dụng – đào tạo nhân sự hiệu quả.'],
        ['Tuần 8', 'Process – Hệ thống SOP', 'Thiết kế quy trình chuẩn FOH, BOH và toàn quán để nhân sự vận hành trơn tru, giảm thất thoát.'],
        ['Tuần 9', 'Profit – Chỉ số tài chính', 'Nắm vững các chỉ số tài chính cốt lõi, công thức lợi nhuận, báo cáo P&L và Menu Engineering.'],
        ['Tuần 10', 'Tổng kết & Định hướng', 'Thuyết trình thành quả 10 tuần, nhận phản hồi từ coach và cộng đồng, định hướng bước tiếp theo.'],
    ];
    for ($i = 1; $i <= 10; $i++) {
        echo '<div class="edt-group"><p class="edt-group-title">📌 ' . esc_html($week_defaults[$i - 1][0]) . '</p>';
        edt_text_field("_dv2_cur_w{$i}_label", "Nhãn tuần", $f("dv2_cur_w{$i}_label", $week_defaults[$i - 1][0]));
        edt_text_field("_dv2_cur_w{$i}_title", "Tiêu đề", $f("dv2_cur_w{$i}_title", $week_defaults[$i - 1][1]));
        edt_textarea_field("_dv2_cur_w{$i}_desc", "Mô tả", $f("dv2_cur_w{$i}_desc", $week_defaults[$i - 1][2]));
        echo '</div>';
    }
    edt_close_tab();

    /* ─── TAB 8: Nhận xét ─── */
    edt_open_tab('edt-dv2-testi');
    edt_text_field('_dv2_testi_badge', 'Badge', $f('dv2_testi_badge', 'Học viên nói gì'));
    edt_text_field('_dv2_testi_title', 'Tiêu đề section', $f('dv2_testi_title', 'Học viên nói gì về Business to Freedom?'));
    echo '<div class="edt-group"><p class="edt-group-title">💡 Hướng dẫn</p>';
    echo '<p style="color:#646970;">Nhận xét được quản lý trong mục <strong>Ý kiến Khách hàng</strong> (menu trái). Gán danh mục <code>dich-vu-2</code> cho các nhận xét muốn hiển thị tại trang này.</p>';
    echo '</div>';
    edt_close_tab();

    /* ─── TAB 9: Giảng viên ─── */
    edt_open_tab('edt-dv2-inst');
    edt_image_field('_dv2_inst_image', 'Ảnh giảng viên', $f('dv2_inst_image', ''));
    echo '<p style="color:#646970; font-style: italic; margin-bottom: 15px;">Tên và chức danh Coach được lấy từ <strong>Settings → Cài đặt Website → Coach</strong>.</p>';

    $cred_defaults = [
        '16 năm trong lĩnh vực kinh doanh & Hospitality tại Mỹ và Việt Nam',
        '10 năm khởi nghiệp: Đồng sáng lập & điều hành Edina Workspace – chuỗi nhà hàng Mỹ tại Hà Nội',
        'ICF PCC Coach: Top 80 người Việt đạt chứng nhận quốc tế Coach chuyên nghiệp. Đồng hành 50+ chủ doanh nghiệp',
        'Tác giả sách <em>Ánh sáng của ước mơ</em>, đã bán hơn 1.000 bản, truyền cảm hứng cho người trẻ khởi nghiệp',
    ];
    for ($i = 1; $i <= 4; $i++) {
        edt_textarea_field("_dv2_inst_cred{$i}", "Thành tích #{$i}", $f("dv2_inst_cred{$i}", $cred_defaults[$i - 1]), 'Cho phép HTML: <em>, <strong>');
    }
    edt_close_tab();

    /* ─── TAB 10: FAQ + CTA Final ─── */
    edt_open_tab('edt-dv2-faq');
    edt_text_field('_dv2_faq_badge', 'Badge', $f('dv2_faq_badge', 'FAQ'));
    edt_text_field('_dv2_faq_title', 'Tiêu đề section', $f('dv2_faq_title', 'Câu hỏi thường gặp'));
    echo '<div class="edt-group"><p class="edt-group-title">💡 Hướng dẫn</p>';
    echo '<p style="color:#646970;">Câu hỏi FAQ được quản lý trong mục <strong>FAQs</strong> (menu trái). Gán danh mục <code>dich-vu-2</code> cho các câu hỏi muốn hiển thị tại trang này.</p>';
    echo '</div>';

    echo '<h3 class="edt-section-title" style="margin-top: 25px;">🚀 CTA Cuối trang</h3>';
    edt_editor_field('_dv2_cta_title', 'Tiêu đề CTA (HTML)', $f('dv2_cta_title', 'Bắt đầu hành trình<br>từ Đam mê đến Tự do'), 'Cho phép HTML: <br>, <span>');
    edt_textarea_field('_dv2_cta_desc', 'Mô tả', $f('dv2_cta_desc', 'Khai giảng 27/03/2026 – Chỉ 10 chỗ/khoá. Đăng ký ngay để giữ suất cho hành trình 10 tuần đầy giá trị.'));
    edt_text_field('_dv2_cta_label', 'Nhãn nút', $f('dv2_cta_label', 'Nhắn Zalo Giữ Chỗ'));
    edt_url_field('_dv2_cta_url', 'Link nút', $f('dv2_cta_url', 'https://zalo.me/coachtram'));
    edt_textarea_field('_dv2_cta_note', 'Ghi chú cuối', $f('dv2_cta_note', '📅 27/03 – 29/05/2026 &nbsp;·&nbsp; 🕘 Thứ 6 hàng tuần &nbsp;·&nbsp; 💰 15.000.000 VNĐ'), 'Cho phép HTML entities');
    edt_close_tab();
}


/* ============================================================
   SAVE META
   ============================================================ */
add_action('save_post_page', function ($post_id) {

    // Nonce check
    if (!isset($_POST['edt_dv2_nonce']) || !wp_verify_nonce($_POST['edt_dv2_nonce'], 'edt_save_dv2')) return;
    // Autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    // Capability
    if (!current_user_can('edit_page', $post_id)) return;
    // Only save for dich-vu-2
    $post = get_post($post_id);
    if (!$post || $post->post_name !== 'dich-vu-2') return;

    /* ─── Text fields (sanitize_text_field) ─── */
    $text_fields = [
        '_dv2_sticky_title', '_dv2_sticky_meta', '_dv2_sticky_cta_label',
        '_dv2_hero_badge', '_dv2_hero_tagline', '_dv2_hero_schedule',
        '_dv2_hero_date', '_dv2_hero_price', '_dv2_hero_max_note',
        '_dv2_hero_countdown', '_dv2_hero_cta_label',
        '_dv2_pain_badge', '_dv2_pain_title',
        '_dv2_target_badge', '_dv2_target_title',
        '_dv2_mmf_badge', '_dv2_mmf_title',
        '_dv2_diff_badge', '_dv2_diff_title', '_dv2_diff_neg_title', '_dv2_diff_pos_title',
        '_dv2_cur_badge', '_dv2_cur_title',
        '_dv2_testi_badge', '_dv2_testi_title',
        '_dv2_faq_badge', '_dv2_faq_title',
        '_dv2_cta_label',
    ];

    // Pain points (1-6)
    for ($i = 1; $i <= 6; $i++) {
        $text_fields[] = "_dv2_pain{$i}_title";
    }
    // Target (1-4)
    for ($i = 1; $i <= 4; $i++) {
        $text_fields[] = "_dv2_target{$i}_title";
    }
    // MMF (1-3)
    for ($i = 1; $i <= 3; $i++) {
        $text_fields[] = "_dv2_mmf{$i}_letter";
        $text_fields[] = "_dv2_mmf{$i}_title";
    }
    // Differentiators (1-4)
    for ($i = 1; $i <= 4; $i++) {
        $text_fields[] = "_dv2_diff_neg{$i}";
        $text_fields[] = "_dv2_diff_pos{$i}";
    }
    // Focus badges (1-5)
    for ($i = 1; $i <= 5; $i++) {
        $text_fields[] = "_dv2_cur_focus{$i}";
    }
    // Weeks (1-10) label + title
    for ($i = 1; $i <= 10; $i++) {
        $text_fields[] = "_dv2_cur_w{$i}_label";
        $text_fields[] = "_dv2_cur_w{$i}_title";
    }

    foreach ($text_fields as $key) {
        if (isset($_POST[$key])) {
            update_post_meta($post_id, $key, sanitize_text_field(wp_unslash($_POST[$key])));
        }
    }

    /* ─── Rich text / HTML fields (wp_kses_post) ─── */
    $rich_fields = [
        '_dv2_hero_title',
        '_dv2_hero_desc',
        '_dv2_mmf_desc',
        '_dv2_cur_desc',
        '_dv2_cta_title',
        '_dv2_cta_desc',
        '_dv2_cta_note',
    ];
    // Pain descs (1-6)
    for ($i = 1; $i <= 6; $i++) {
        $rich_fields[] = "_dv2_pain{$i}_desc";
    }
    // Target descs (1-4)
    for ($i = 1; $i <= 4; $i++) {
        $rich_fields[] = "_dv2_target{$i}_desc";
    }
    // MMF descs (1-3)
    for ($i = 1; $i <= 3; $i++) {
        $rich_fields[] = "_dv2_mmf{$i}_desc";
    }
    // Week descs (1-10)
    for ($i = 1; $i <= 10; $i++) {
        $rich_fields[] = "_dv2_cur_w{$i}_desc";
    }
    // Instructor creds (1-4)
    for ($i = 1; $i <= 4; $i++) {
        $rich_fields[] = "_dv2_inst_cred{$i}";
    }

    foreach ($rich_fields as $key) {
        if (isset($_POST[$key])) {
            update_post_meta($post_id, $key, wp_kses_post(wp_unslash($_POST[$key])));
        }
    }

    /* ─── URL fields (esc_url_raw) ─── */
    $url_fields = [
        '_dv2_sticky_cta_url',
        '_dv2_hero_cta_url',
        '_dv2_cta_url',
    ];
    foreach ($url_fields as $key) {
        if (isset($_POST[$key])) {
            update_post_meta($post_id, $key, esc_url_raw($_POST[$key]));
        }
    }

    /* ─── Image fields (absint) ─── */
    $image_fields = [
        '_dv2_hero_image',
        '_dv2_inst_image',
    ];
    foreach ($image_fields as $key) {
        if (isset($_POST[$key])) {
            update_post_meta($post_id, $key, absint($_POST[$key]));
        }
    }
});
