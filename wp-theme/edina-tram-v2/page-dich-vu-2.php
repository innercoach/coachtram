<?php
/**
 * Template Name: Dịch vụ 2 — Business to Freedom
 * Slug: dich-vu-2
 */
get_header();

/* ─── Field helpers ─── */
$f = function ($key, $default = '') { return edt_field($key, null, $default); };

/* ─── Sticky CTA ─── */
$sticky_title     = $f('dv2_sticky_title', 'Business to Freedom – 10 tuần');
$sticky_meta      = $f('dv2_sticky_meta', 'Khai giảng 27/03/2026 · Chỉ 10 chỗ');
$sticky_cta_label = $f('dv2_sticky_cta_label', 'Giữ Chỗ Ngay');
$sticky_cta_url   = $f('dv2_sticky_cta_url', site_url('/lien-he'));

/* ─── Hero ─── */
$hero_badge    = $f('dv2_hero_badge', 'KHOÁ HỌC 10 TUẦN');
$hero_title    = $f('dv2_hero_title', 'BUSINESS<br>to <span>FREEDOM</span>');
$hero_tagline  = $f('dv2_hero_tagline', 'Từ vận hành đến tự do — Xây dựng doanh nghiệp bền vững');
$hero_desc     = $f('dv2_hero_desc', 'Đam mê và Lợi nhuận là nền tảng, nhưng Tự do mới là đích đến. Hãy để chương trình 10 tuần Business to Freedom dẫn bạn đến nơi đó.');
$hero_schedule = $f('dv2_hero_schedule', '10 buổi · 3h/buổi');
$hero_date     = $f('dv2_hero_date', '27/03 – 29/05/2026');
$hero_price    = $f('dv2_hero_price', '15.000.000 VNĐ');
$hero_max_note = $f('dv2_hero_max_note', '* Khoá học chỉ nhận tối đa 10 học viên để đảm bảo chất lượng');
$hero_countdown = $f('dv2_hero_countdown', '2026-03-27T10:00:00');
$hero_cta_label = $f('dv2_hero_cta_label', 'ĐĂNG KÝ NGAY');
$hero_cta_url   = $f('dv2_hero_cta_url', site_url('/lien-he'));
$hero_image     = edt_img_url('dv2_hero_image', 'large');

/* ─── Pain Points ─── */
$pain_badge = $f('dv2_pain_badge', 'Bạn có đang gặp phải?');
$pain_title = $f('dv2_pain_title', 'Bạn có đang đối diện với những vấn đề này?');
$pains = [];
for ($i = 1; $i <= 6; $i++) {
    $pains[] = [
        'title' => $f("dv2_pain{$i}_title", ''),
        'desc'  => $f("dv2_pain{$i}_desc", ''),
    ];
}
$pain_defaults = [
    ['ĐAM MÊ NHƯNG MƠ HỒ', 'Bạn yêu ẩm thực, mơ một ngày có quán riêng. Nhưng khi bắt tay vào, bạn không biết viết kế hoạch ra sao, vốn bao nhiêu là đủ, và khách hàng mục tiêu thực sự là ai.'],
    ['DOANH THU BẤP BÊNH', 'Quán của bạn có ngày đông khách, có ngày lại vắng hoe. Dù làm rất nhiều nhưng cuối tháng nhìn vào sổ sách thì lời lãi chẳng thấy đâu.'],
    ['CHI PHÍ ĐỘI LÊN', 'Tiền thuê mặt bằng, nhân sự, nguyên liệu... liên tục "ăn mòn" lợi nhuận. Bạn thấy dòng tiền chảy ra nhiều hơn chảy vào nhưng không rõ nguyên nhân.'],
    ['NHÂN SỰ BẤT ỔN', 'Nhân viên mới vào rồi lại nghỉ. Bạn vừa đào tạo xong một người thì họ lại bỏ đi. Quán thiếu người, còn bạn thì kiệt sức vì phải làm tất cả mọi việc.'],
    ['BỊ CUỐN 24/7', 'Bạn giống như "nô lệ" của quán mình. Ngày nào cũng quần quật, không còn thời gian cho gia đình, bạn bè, hay cho chính bản thân.'],
    ['THẤT BẠI VÀ HOANG MANG', 'Có thể bạn đã từng đóng cửa một quán trước đây. Nỗi đau còn đó, và bạn vẫn tự hỏi: "Nếu mình làm lại lần nữa, liệu có khác không?"'],
];
foreach ($pains as $i => &$p) {
    if (empty($p['title'])) $p['title'] = $pain_defaults[$i][0];
    if (empty($p['desc']))  $p['desc']  = $pain_defaults[$i][1];
}
unset($p);

/* ─── Target Audience ─── */
$target_badge = $f('dv2_target_badge', 'Dành cho bạn');
$target_title = $f('dv2_target_title', 'Chương trình này dành cho bạn nếu');
$targets = [];
for ($i = 1; $i <= 4; $i++) {
    $targets[] = [
        'title' => $f("dv2_target{$i}_title", ''),
        'desc'  => $f("dv2_target{$i}_desc", ''),
    ];
}
$target_defaults = [
    ['NGƯỜI CHUẨN BỊ KHỞI NGHIỆP F&amp;B', 'Bạn có <strong>đam mê nhưng chưa bắt đầu</strong>. Bạn muốn đi bài bản ngay từ đầu, có bản đồ rõ ràng để tiết kiệm thời gian, tiền bạc.'],
    ['CHỦ QUÁN ĐANG VẬN HÀNH', 'Bạn đã khởi sự kinh doanh, nhưng đang <strong>loay hoay với doanh thu, chi phí và nhân sự</strong>. Bạn muốn tìm một cách vận hành bài bản để quán ổn định, lợi nhuận rõ ràng.'],
    ['TỪNG THẤT BẠI &amp; MUỐN LÀM LẠI', 'Bạn đã <strong>từng đóng cửa một quán</strong> nhưng vẫn đam mê khởi nghiệp với một lộ trình có hệ thống, với sự đồng hành của một coach thực chiến.'],
    ['NGƯỜI KHAO KHÁT TỰ DO', 'Bạn muốn <strong>xây dựng một mô hình kinh doanh có lợi nhuận bền vững</strong> để bạn vừa kinh doanh hiệu quả, vừa có một cuộc đời tự do.'],
];
foreach ($targets as $i => &$t) {
    if (empty($t['title'])) $t['title'] = $target_defaults[$i][0];
    if (empty($t['desc']))  $t['desc']  = $target_defaults[$i][1];
}
unset($t);

/* ─── MMF Benefits ─── */
$mmf_badge = $f('dv2_mmf_badge', 'Lợi ích');
$mmf_title = $f('dv2_mmf_title', '3 Trụ cột giá trị');
$mmf_desc  = $f('dv2_mmf_desc', 'Mỗi trụ cột giúp bạn xây dựng nền tảng vững chắc cho hành trình kinh doanh bền vững.');
$mmf_items = [];
for ($i = 1; $i <= 3; $i++) {
    $mmf_items[] = [
        'letter' => $f("dv2_mmf{$i}_letter", ''),
        'title'  => $f("dv2_mmf{$i}_title", ''),
        'desc'   => $f("dv2_mmf{$i}_desc", ''),
    ];
}
$mmf_defaults = [
    ['M', 'MONEY – Tiền', 'Bạn học cách xây dựng một mô hình kinh doanh có lợi nhuận rõ ràng. Biết quản lý chi phí, định giá đúng, kiểm soát Prime Cost, và tạo ra dòng tiền ổn định.'],
    ['M', 'MEANING – Ý nghĩa', 'Kinh doanh không chỉ là bán món ăn. Đó là hành trình bạn gửi gắm niềm đam mê, giá trị và dấu ấn cá nhân, để mỗi bữa ăn trở thành một trải nghiệm mang ý nghĩa.'],
    ['F', 'FREEDOM – Tự do', 'Không còn bị trói chặt 24/7 trong quán. Với kế hoạch, đội ngũ và quy trình rõ ràng, bạn có thể vừa vận hành kinh doanh, vừa tận hưởng tự do.'],
];
foreach ($mmf_items as $i => &$m) {
    if (empty($m['letter'])) $m['letter'] = $mmf_defaults[$i][0];
    if (empty($m['title']))  $m['title']  = $mmf_defaults[$i][1];
    if (empty($m['desc']))   $m['desc']   = $mmf_defaults[$i][2];
}
unset($m);

/* ─── Differentiators ─── */
$diff_badge     = $f('dv2_diff_badge', 'Vì sao khác biệt?');
$diff_title     = $f('dv2_diff_title', 'Đây không phải khoá học thông thường');
$diff_neg_title = $f('dv2_diff_neg_title', 'Không phải khoá học thông thường');
$diff_pos_title = $f('dv2_diff_pos_title', 'Thay vào đó, bạn nhận được');
$diff_negs = [];
$diff_poss = [];
$neg_defaults = [
    'Không phải kiến thức lý thuyết sách vở, xa rời thực tế',
    'Không phải lớp học đại trà hàng trăm người, không ai hỏi thăm ai',
    'Không phải hứa hẹn thành công dễ dàng hay công thức "làm giàu nhanh"',
    'Không phải giảng dạy từ người chưa từng kinh doanh thực tế',
];
$pos_defaults = [
    'Kiến thức thực chiến từ 15+ năm kinh nghiệm F&amp;B tại Mỹ và Việt Nam',
    'Lớp học chỉ tối đa 10 người, được coaching sâu sát từng mô hình',
    'Bộ template chuẩn: P&amp;L, Menu Engineering, SOP, Lean Canvas',
    'Cộng đồng chủ quán F&amp;B đồng hành lâu dài sau khoá học',
];
for ($i = 1; $i <= 4; $i++) {
    $diff_negs[] = $f("dv2_diff_neg{$i}", $neg_defaults[$i - 1]);
    $diff_poss[] = $f("dv2_diff_pos{$i}", $pos_defaults[$i - 1]);
}

/* ─── Curriculum ─── */
$cur_badge = $f('dv2_cur_badge', 'Lộ trình');
$cur_title = $f('dv2_cur_title', 'Hành trình 10 tuần');
$cur_desc  = $f('dv2_cur_desc', 'Mỗi tuần đi sâu vào một trụ cột trong khung chiến lược 5P để bạn xây dựng mô hình bền vững.');
$cur_focuses = [];
$focus_defaults = ['Purpose', 'People', 'Product', 'Profit', 'Peace'];
for ($i = 1; $i <= 5; $i++) {
    $cur_focuses[] = $f("dv2_cur_focus{$i}", $focus_defaults[$i - 1]);
}
$weeks = [];
$week_defaults = [
    ['Tuần 1', 'Passion – Vai trò chủ doanh nghiệp', 'Xác định rõ vai trò người chủ, vẽ bản đồ đam mê và kiểm tra mức độ sẵn sàng khởi nghiệp F&amp;B.'],
    ['Tuần 2', 'Plan – Khởi điểm &amp; mô hình', 'Lựa chọn mô hình kinh doanh phù hợp, phát triển ý tưởng từ đam mê thành kế hoạch cụ thể.'],
    ['Tuần 3', 'Plan – Kế hoạch tài chính', 'Dự toán vốn đầu tư, tính toán điểm hoà vốn, xây dựng bản kế hoạch kinh doanh khả thi.'],
    ['Tuần 4', 'Product – Thực đơn chiến lược', 'Xây dựng menu, định giá từng món, thiết kế thực đơn để vừa thu hút khách vừa đảm bảo lợi nhuận.'],
    ['Tuần 5', 'Product – Mặt bằng &amp; Trải nghiệm', 'Chọn mặt bằng phù hợp, thiết kế trải nghiệm khách hàng độc đáo để tạo dấu ấn thương hiệu.'],
    ['Tuần 6', 'People – Năng lực &amp; mục tiêu', 'Phân tích năng lực bản thân ở vai trò chủ doanh nghiệp, xác định mục tiêu phát triển.'],
    ['Tuần 7', 'People – Kế hoạch nhân sự', 'Xây dựng JD, sơ đồ đội nhóm ban đầu và kế hoạch tuyển dụng – đào tạo nhân sự hiệu quả.'],
    ['Tuần 8', 'Process – Hệ thống SOP', 'Thiết kế quy trình chuẩn FOH, BOH và toàn quán để nhân sự vận hành trơn tru, giảm thất thoát.'],
    ['Tuần 9', 'Profit – Chỉ số tài chính', 'Nắm vững các chỉ số tài chính cốt lõi, công thức lợi nhuận, báo cáo P&amp;L và Menu Engineering.'],
    ['Tuần 10', 'Tổng kết &amp; Định hướng', 'Thuyết trình thành quả 10 tuần, nhận phản hồi từ coach và cộng đồng, định hướng bước tiếp theo.'],
];
for ($i = 1; $i <= 10; $i++) {
    $weeks[] = [
        'label' => $f("dv2_cur_w{$i}_label", $week_defaults[$i - 1][0]),
        'title' => $f("dv2_cur_w{$i}_title", $week_defaults[$i - 1][1]),
        'desc'  => $f("dv2_cur_w{$i}_desc",  $week_defaults[$i - 1][2]),
    ];
}

/* ─── Testimonials ─── */
$testi_badge = $f('dv2_testi_badge', 'Học viên nói gì');
$testi_title = $f('dv2_testi_title', 'Học viên nói gì về Business to Freedom?');

/* ─── Instructor ─── */
$inst_image = edt_img_url('dv2_inst_image', 'large');
$inst_creds = [];
$cred_defaults = [
    '16 năm trong lĩnh vực kinh doanh &amp; Hospitality tại Mỹ và Việt Nam',
    '10 năm khởi nghiệp: Đồng sáng lập &amp; điều hành Edina Workspace – chuỗi nhà hàng Mỹ tại Hà Nội',
    'ICF PCC Coach: Top 80 người Việt đạt chứng nhận quốc tế Coach chuyên nghiệp. Đồng hành 50+ chủ doanh nghiệp',
    'Tác giả sách <em>Ánh sáng của ước mơ</em>, đã bán hơn 1.000 bản, truyền cảm hứng cho người trẻ khởi nghiệp',
];
for ($i = 1; $i <= 4; $i++) {
    $inst_creds[] = $f("dv2_inst_cred{$i}", $cred_defaults[$i - 1]);
}
$coach_name  = edt_option('coach_name', 'Edina Trâm');
$coach_title = edt_option('coach_title', 'F&B Startup Coach · ICF PCC');

/* ─── FAQ ─── */
$faq_badge = $f('dv2_faq_badge', 'FAQ');
$faq_title = $f('dv2_faq_title', 'Câu hỏi thường gặp');

/* ─── CTA Final ─── */
$cta_title = $f('dv2_cta_title', 'Bắt đầu hành trình<br>từ Đam mê đến Tự do');
$cta_desc  = $f('dv2_cta_desc', 'Khai giảng 27/03/2026 – Chỉ 10 chỗ/khoá. Đăng ký ngay để giữ suất cho hành trình 10 tuần đầy giá trị.');
$cta_label = $f('dv2_cta_label', 'Nhắn Zalo Giữ Chỗ');
$cta_url   = $f('dv2_cta_url', 'https://zalo.me/coachtram');
$cta_note  = $f('dv2_cta_note', '📅 27/03 – 29/05/2026 &nbsp;·&nbsp; 🕘 Thứ 6 hàng tuần &nbsp;·&nbsp; 💰 15.000.000 VNĐ');

/* ─── Social links (global) ─── */
$social_fb   = edt_option('social_facebook', 'https://www.facebook.com/coachtram');
$social_ig   = edt_option('social_instagram', 'https://www.instagram.com/coachtram');
$social_web  = edt_option('social_website', 'https://www.coachtram.com');
$contact_email = edt_option('contact_email', 'coachtram@gmail.com');
?>

<style>
  :root { --page-accent: #005B45; }
  body { padding-bottom: 80px; }
</style>

  <!-- ═══ STICKY CTA BAR ═══ -->
  <div class="sticky-cta" role="banner" aria-label="Đăng ký nhanh">
    <div class="sticky-cta-dot"></div>
    <div class="sticky-cta-info">
      <span class="sticky-cta-title"><?php echo esc_html($sticky_title); ?></span>
      <span class="sticky-cta-meta"><?php echo esc_html($sticky_meta); ?></span>
    </div>
    <a href="<?php echo esc_url($sticky_cta_url); ?>" class="btn btn--accent"><?php echo esc_html($sticky_cta_label); ?></a>
  </div>

  <main>

    <!-- Decorative glow blobs -->
    <div class="glow-blob glow-blob--gold glow-blob--1" aria-hidden="true"></div>
    <div class="glow-blob glow-blob--emerald glow-blob--2" aria-hidden="true"></div>

    <!-- ═══ S1: HERO ═══ -->
    <section class="srv-hero" aria-label="Giới thiệu khoá học">
      <div class="container srv-hero-grid">
        <div class="srv-hero-content">
          <span class="badge" style="margin-bottom: var(--space-4); display: inline-block;"><?php echo esc_html($hero_badge); ?></span>
          <h1><?php echo wp_kses_post($hero_title); ?></h1>
          <p class="srv-hero-tagline"><?php echo esc_html($hero_tagline); ?></p>
          <p class="srv-hero-desc"><?php echo esc_html($hero_desc); ?></p>

          <!-- Hero info box -->
          <div style="display: flex; flex-wrap: wrap; gap: var(--space-6); background: var(--color-bg-alt); padding: var(--space-5); border-radius: var(--radius-md); border-left: 4px solid var(--royal-gold); margin-bottom: var(--space-6);">
            <div>
              <div style="font-size: var(--text-xs); text-transform: uppercase; letter-spacing: 1px; color: var(--color-fg-muted);">Lịch học</div>
              <div style="font-weight: 700; color: var(--color-fg);"><?php echo esc_html($hero_schedule); ?></div>
            </div>
            <div>
              <div style="font-size: var(--text-xs); text-transform: uppercase; letter-spacing: 1px; color: var(--color-fg-muted);">Khai giảng</div>
              <div style="font-weight: 700; color: var(--color-fg);"><?php echo esc_html($hero_date); ?></div>
            </div>
            <div>
              <div style="font-size: var(--text-xs); text-transform: uppercase; letter-spacing: 1px; color: var(--color-fg-muted);">Chi phí</div>
              <div style="font-weight: 700; color: var(--royal-gold);"><?php echo esc_html($hero_price); ?></div>
            </div>
          </div>

          <p style="font-size: var(--text-sm); font-style: italic; color: var(--royal-gold); margin-bottom: var(--space-4);"><?php echo esc_html($hero_max_note); ?></p>

          <!-- Countdown -->
          <div class="countdown" data-target="<?php echo esc_attr($hero_countdown); ?>" style="margin-bottom: var(--space-6);">
            <div class="countdown-unit">
              <div class="countdown-num countdown-num--days">00</div>
              <div class="countdown-label">Ngày</div>
            </div>
            <div class="countdown-unit">
              <div class="countdown-num countdown-num--hours">00</div>
              <div class="countdown-label">Giờ</div>
            </div>
            <div class="countdown-unit">
              <div class="countdown-num countdown-num--mins">00</div>
              <div class="countdown-label">Phút</div>
            </div>
            <div class="countdown-unit">
              <div class="countdown-num countdown-num--secs">00</div>
              <div class="countdown-label">Giây</div>
            </div>
          </div>

          <a href="<?php echo esc_url($hero_cta_url); ?>" class="btn btn--primary btn--lg"><?php echo esc_html($hero_cta_label); ?></a>
        </div>
        <div class="srv-hero-img">
          <?php if ($hero_image) : ?>
            <img src="<?php echo esc_url($hero_image); ?>" alt="<?php echo esc_attr($coach_name . ' – Business to Freedom'); ?>" loading="eager">
          <?php else : ?>
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/placeholder-hero.png'); ?>" alt="<?php echo esc_attr($coach_name . ' – Business to Freedom'); ?>" loading="eager">
          <?php endif; ?>
        </div>
      </div>
    </section>


    <!-- ═══ S2: PAIN POINTS ═══ -->
    <section class="srv-section--alt" aria-label="Nỗi đau của chủ quán">
      <div class="container">
        <div class="section-header">
          <span class="badge"><?php echo esc_html($pain_badge); ?></span>
          <h2 style="margin-top: var(--space-4);"><?php echo esc_html($pain_title); ?></h2>
          <div class="divider"></div>
        </div>
        <div class="pain-grid" data-reveal-stagger>
          <?php foreach ($pains as $i => $pain) : ?>
          <div class="pain-card" data-reveal>
            <div class="pain-num"><?php echo esc_html(str_pad($i + 1, 2, '0', STR_PAD_LEFT)); ?></div>
            <h3><?php echo esc_html($pain['title']); ?></h3>
            <p><?php echo esc_html($pain['desc']); ?></p>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>


    <!-- ═══ S3: TARGET AUDIENCE ═══ -->
    <section class="srv-section" aria-label="Đối tượng tham gia">
      <div class="container">
        <div class="section-header">
          <span class="badge"><?php echo esc_html($target_badge); ?></span>
          <h2 style="margin-top: var(--space-4);"><?php echo esc_html($target_title); ?></h2>
          <div class="divider"></div>
        </div>
        <div class="target-grid" style="grid-template-columns: repeat(2, 1fr);" data-reveal-stagger>
          <?php foreach ($targets as $i => $tgt) : ?>
          <div class="target-card" data-reveal>
            <div class="target-num"><?php echo esc_html(str_pad($i + 1, 2, '0', STR_PAD_LEFT)); ?></div>
            <h3 style="font-family: var(--font-body); font-size: var(--text-base); font-weight: 700; margin-bottom: var(--space-2);"><?php echo wp_kses_post($tgt['title']); ?></h3>
            <p><?php echo wp_kses_post($tgt['desc']); ?></p>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>


    <!-- ═══ S4: BENEFITS – MMF ═══ -->
    <section class="srv-section--alt" aria-label="3 trụ cột giá trị">
      <div class="container">
        <div class="section-header">
          <span class="badge badge--gold"><?php echo esc_html($mmf_badge); ?></span>
          <h2 style="margin-top: var(--space-4);"><?php echo esc_html($mmf_title); ?></h2>
          <div class="divider"></div>
          <p><?php echo esc_html($mmf_desc); ?></p>
        </div>
        <div class="value-grid" data-reveal-stagger>
          <?php foreach ($mmf_items as $mmf) : ?>
          <div class="value-card" data-reveal style="text-align: center;">
            <div style="font-family: var(--font-heading); font-size: 5rem; color: var(--page-accent); line-height: 1; margin-bottom: var(--space-4); opacity: 0.2;"><?php echo esc_html($mmf['letter']); ?></div>
            <h3 style="color: var(--page-accent);"><?php echo esc_html($mmf['title']); ?></h3>
            <p><?php echo esc_html($mmf['desc']); ?></p>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>


    <!-- ═══ S5: DIFFERENTIATORS ═══ -->
    <section class="srv-section" aria-label="Khác biệt của chương trình">
      <div class="container">
        <div class="section-header">
          <span class="badge"><?php echo esc_html($diff_badge); ?></span>
          <h2 style="margin-top: var(--space-4);"><?php echo esc_html($diff_title); ?></h2>
          <div class="divider"></div>
        </div>
        <div class="method-layout">
          <div class="method-col method-col--negative">
            <h3><?php echo esc_html($diff_neg_title); ?></h3>
            <ul class="method-list">
              <?php foreach ($diff_negs as $neg) : ?>
              <li>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#b32d2e" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                <span><?php echo wp_kses_post($neg); ?></span>
              </li>
              <?php endforeach; ?>
            </ul>
          </div>
          <div class="method-col method-col--positive">
            <h3><?php echo esc_html($diff_pos_title); ?></h3>
            <ul class="method-list">
              <?php foreach ($diff_poss as $pos) : ?>
              <li>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--page-accent)" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                <span><?php echo wp_kses_post($pos); ?></span>
              </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
    </section>


    <!-- ═══ S6: 10-WEEK CURRICULUM ═══ -->
    <section class="srv-section--alt" aria-label="Lộ trình 10 tuần">
      <div class="container container--narrow">
        <div class="section-header">
          <span class="badge badge--gold"><?php echo esc_html($cur_badge); ?></span>
          <h2 style="margin-top: var(--space-4);"><?php echo esc_html($cur_title); ?></h2>
          <div class="divider"></div>
          <p><?php echo esc_html($cur_desc); ?></p>
          <div class="focus-badge-row">
            <?php foreach ($cur_focuses as $focus) : ?>
            <span class="focus-badge"><?php echo esc_html($focus); ?></span>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="timeline">
          <?php foreach ($weeks as $week) : ?>
          <div class="timeline-item" data-reveal>
            <div class="timeline-week"><?php echo esc_html($week['label']); ?></div>
            <h3><?php echo wp_kses_post($week['title']); ?></h3>
            <p><?php echo wp_kses_post($week['desc']); ?></p>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>


    <!-- ═══ S7: TESTIMONIALS ═══ -->
    <section class="srv-section" aria-label="Học viên chia sẻ">
      <div class="container">
        <div class="section-header">
          <span class="badge"><?php echo esc_html($testi_badge); ?></span>
          <h2 style="margin-top: var(--space-4);"><?php echo esc_html($testi_title); ?></h2>
          <div class="divider"></div>
        </div>
        <?php edt_render_testimonials('dich-vu-2'); ?>
      </div>
    </section>


    <!-- ═══ S8: INSTRUCTOR ═══ -->
    <section class="srv-section--dark" aria-label="Giảng viên">
      <div class="container">
        <div class="instructor-layout">
          <div class="instructor-img" data-reveal style="border-color: var(--royal-gold); max-width: 420px; margin-inline: auto;">
            <?php if ($inst_image) : ?>
              <img src="<?php echo esc_url($inst_image); ?>" alt="<?php echo esc_attr($coach_name . ' – Professional Coach, ICF PCC'); ?>" loading="lazy" style="border-radius: var(--radius-lg);">
            <?php else : ?>
              <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/placeholder-instructor.jpg'); ?>" alt="<?php echo esc_attr($coach_name . ' – Professional Coach, ICF PCC'); ?>" loading="lazy" style="border-radius: var(--radius-lg);">
            <?php endif; ?>
          </div>
          <div data-reveal>
            <div class="section-header" style="text-align: left; margin-bottom: var(--space-6); max-width: none;">
              <h2>Ai là người đồng hành cùng bạn?</h2>
              <div class="divider divider--left"></div>
            </div>
            <h3 class="instructor-name" style="color: #fff;"><?php echo esc_html($coach_name); ?></h3>
            <p class="instructor-title" style="color: var(--champagne-glow);"><?php echo esc_html($coach_title); ?></p>
            <div class="cred-list">
              <?php foreach ($inst_creds as $i => $cred) : ?>
              <div class="cred-item" style="background: rgba(255,255,255,0.06);">
                <span class="cred-num"><?php echo esc_html(str_pad($i + 1, 2, '0', STR_PAD_LEFT)); ?></span>
                <p style="color: rgba(255,255,255,0.9);"><?php echo wp_kses_post($cred); ?></p>
              </div>
              <?php endforeach; ?>
            </div>
            <div class="social-links" style="margin-top: var(--space-6);">
              <?php if ($social_fb) : ?>
              <a href="<?php echo esc_url($social_fb); ?>" target="_blank" rel="noopener" aria-label="Facebook" style="border-color: rgba(255,255,255,0.15); color: rgba(255,255,255,0.7);">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path></svg>
              </a>
              <?php endif; ?>
              <?php if ($social_ig) : ?>
              <a href="<?php echo esc_url($social_ig); ?>" target="_blank" rel="noopener" aria-label="Instagram" style="border-color: rgba(255,255,255,0.15); color: rgba(255,255,255,0.7);">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
              </a>
              <?php endif; ?>
              <?php if ($social_web) : ?>
              <a href="<?php echo esc_url($social_web); ?>" target="_blank" rel="noopener" aria-label="Website" style="border-color: rgba(255,255,255,0.15); color: rgba(255,255,255,0.7);">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"></path></svg>
              </a>
              <?php endif; ?>
              <?php if ($contact_email) : ?>
              <a href="mailto:<?php echo esc_attr($contact_email); ?>" aria-label="Email" style="border-color: rgba(255,255,255,0.15); color: rgba(255,255,255,0.7);">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
              </a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- ═══ S9: FAQ ═══ -->
    <section class="srv-section--alt" aria-label="Câu hỏi thường gặp">
      <div class="container container--narrow">
        <div class="section-header">
          <span class="badge"><?php echo esc_html($faq_badge); ?></span>
          <h2 style="margin-top: var(--space-4);"><?php echo esc_html($faq_title); ?></h2>
          <div class="divider"></div>
        </div>
        <?php edt_render_faqs('dich-vu-2'); ?>
      </div>
    </section>


    <!-- ═══ S10: CTA FINAL ═══ -->
    <section class="srv-cta-final" aria-label="Đăng ký ngay">
      <div class="container">
        <h2><?php echo wp_kses_post($cta_title); ?></h2>
        <p style="max-width: 560px;"><?php echo esc_html($cta_desc); ?></p>
        <a href="<?php echo esc_url($cta_url); ?>" class="btn btn--accent btn--lg" target="_blank" rel="noopener"><?php echo esc_html($cta_label); ?></a>
        <p class="cta-note"><?php echo wp_kses_post($cta_note); ?></p>
      </div>
    </section>

  </main>

<?php get_footer(); ?>
