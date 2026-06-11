<?php
/**
 * Template Name: Dịch vụ 3 — Business Mastery
 * Slug: dich-vu-3
 */

get_header(); ?>

<style>
  :root { --page-accent: #014F3D; }
  body { padding-bottom: 80px; }
</style>

<?php
/* ── Field helpers (shorthand) ── */
$f = function ($key, $default = '') { return edt_field('dv3_' . $key, null, $default); };
$img = function ($key, $size = 'large') { return edt_img_url('dv3_' . $key, $size); };
?>

<!-- ══ Sticky CTA Bar ══ -->
<div class="sticky-cta">
  <div class="sticky-cta-info">
    <div class="sticky-cta-dot"></div>
    <p class="sticky-cta-title"><?php echo esc_html($f('sticky_title', 'Business Mastery – Coaching 1:1')); ?></p>
  </div>
  <a href="<?php echo esc_url($f('sticky_cta_url', '/lien-he')); ?>" class="btn btn--accent btn--sm"><?php echo esc_html($f('sticky_cta_label', 'Liên hệ ngay')); ?></a>
</div>

<main>
  <!-- Decorative glow blobs (extra prominent) -->
  <div class="glow-blob glow-blob--gold glow-blob--1" aria-hidden="true"></div>
  <div class="glow-blob glow-blob--emerald glow-blob--2" aria-hidden="true"></div>


  <!-- ══════════════════════════════════════════════════════
       SECTION 1 — HERO
       ══════════════════════════════════════════════════════ -->
  <section class="srv-hero">
    <div class="container">
      <div class="srv-hero-grid">
        <div class="srv-hero-content" data-reveal>
          <span class="badge badge--gold"><?php echo esc_html($f('hero_badge', 'COACHING 1:1 CHIẾN LƯỢC DÀI HẠN')); ?></span>
          <?php echo wp_kses_post($f('hero_title', '<h1>BUSINESS<br><span>MASTERY</span></h1>')); ?>
          <p class="srv-hero-tagline"><?php echo esc_html($f('hero_tagline', 'Khai vấn chiến lược 1:1 cho doanh nhân F&B')); ?></p>
          <p class="srv-hero-desc"><?php echo esc_html($f('hero_desc', 'Chương trình coaching cá nhân hoá cao cấp nhất, nơi bạn được đồng hành 1:1 cùng Coach Edina Trâm để giải quyết các bài toán chiến lược riêng biệt của doanh nghiệp, từ mở rộng quy mô, tối ưu hệ thống đến xây dựng thương hiệu bền vững trong ngành F&B.')); ?></p>
          <?php $gift = $f('hero_gift'); if ($gift) : ?>
            <div class="gift-badge"><?php echo esc_html($gift); ?></div>
          <?php endif; ?>
          <a href="<?php echo esc_url($f('hero_cta_url', '/lien-he')); ?>" class="btn btn--accent btn--lg"><?php echo esc_html($f('hero_cta_label', 'ĐĂNG KÝ TƯ VẤN 1:1')); ?></a>
        </div>
        <?php $hero_img = $img('hero_image'); if ($hero_img) : ?>
          <div class="srv-hero-img" data-reveal>
            <img src="<?php echo esc_url($hero_img); ?>" alt="<?php echo esc_attr($f('hero_tagline', 'Coach Edina Trâm – Business Mastery')); ?>" loading="lazy" />
          </div>
        <?php endif; ?>
      </div>
    </div>
    <div class="scroll-indicator" aria-hidden="true">Khám phá</div>
  </section>


  <!-- ══════════════════════════════════════════════════════
       SECTION 2 — PAIN POINTS
       ══════════════════════════════════════════════════════ -->
  <section class="srv-section srv-section--alt">
    <div class="container">
      <div class="section-header" data-reveal>
        <span class="badge badge--gold"><?php echo esc_html($f('pain_badge', 'THÁCH THỨC')); ?></span>
        <h2><?php echo esc_html($f('pain_title', 'Bạn đang đối mặt với những bài toán này?')); ?></h2>
        <div class="divider"></div>
        <p><?php echo esc_html($f('pain_desc', 'Khi doanh nghiệp đã vượt qua giai đoạn khởi sự, những thách thức mới ở tầm chiến lược bắt đầu xuất hiện.')); ?></p>
      </div>

      <div class="pain-grid" data-reveal-stagger>
        <?php
        $pain_defaults = [
          1 => ['DOANH THU CHẠM TRẦN', 'Bạn đã có doanh thu ổn, nhưng không thể tăng trưởng thêm. Mọi nỗ lực dường như chỉ giữ nguyên hiện trạng mà không tạo ra đột phá đáng kể nào.'],
          2 => ['HỆ THỐNG KHÔNG SCALE ĐƯỢC', 'Mở thêm chi nhánh nhưng lợi nhuận không tăng tương xứng. Quy trình vận hành phụ thuộc quá nhiều vào bạn, không thể nhân bản.'],
          3 => ['TEAM QUẢN LÝ YẾU', 'Đội ngũ giỏi chuyên môn nhưng thiếu tư duy quản trị. Bạn là người duy nhất ra quyết định và thường xuyên phải "chữa cháy" liên tục.'],
          4 => ['THƯƠNG HIỆU MỜ NHẠT', 'Giữa thị trường F&B ngày càng cạnh tranh, thương hiệu của bạn thiếu điểm khác biệt rõ ràng. Khách hàng đến rồi đi mà không gắn bó lâu dài.'],
          5 => ['CHỦ DOANH NGHIỆP CÔ ĐƠN', 'Bạn không có ai để trao đổi ở cùng tầm. Những quyết định lớn – mở rộng, nhượng quyền, tái cấu trúc – bạn phải tự mình gánh vác. Bạn cần một người đồng hành chiến lược, không phải thêm nhân viên.'],
        ];
        for ($i = 1; $i <= 5; $i++) :
          $title = $f("pain{$i}_title", $pain_defaults[$i][0]);
          $desc  = $f("pain{$i}_desc",  $pain_defaults[$i][1]);
          $class = $i === 5 ? 'pain-card pain-card--full' : 'pain-card';
        ?>
          <div class="<?php echo esc_attr($class); ?>" data-reveal>
            <div class="pain-num"><?php echo esc_html(str_pad($i, 2, '0', STR_PAD_LEFT)); ?></div>
            <h3><?php echo esc_html($title); ?></h3>
            <p><?php echo esc_html($desc); ?></p>
          </div>
        <?php endfor; ?>
      </div>
    </div>
  </section>


  <!-- ══════════════════════════════════════════════════════
       SECTION 3 — TARGET AUDIENCE
       ══════════════════════════════════════════════════════ -->
  <section class="srv-section">
    <div class="container">
      <div class="section-header" data-reveal>
        <span class="badge badge--gold"><?php echo esc_html($f('target_badge', 'DÀNH CHO AI')); ?></span>
        <h2><?php echo esc_html($f('target_title', 'Business Mastery dành cho bạn nếu…')); ?></h2>
        <div class="divider"></div>
      </div>

      <div class="target-grid" data-reveal-stagger>
        <?php
        $target_defaults = [
          1 => ['🏢', 'Chủ doanh nghiệp F&B đã vận hành 2+ năm', 'Bạn đã có doanh thu ổn định, đội ngũ vận hành, nhưng đang tìm kiếm <strong>bước nhảy tiếp theo</strong> để mở rộng quy mô hoặc tối ưu lợi nhuận.'],
          2 => ['📈', 'Người muốn mở rộng chuỗi / nhượng quyền', 'Bạn đang cân nhắc mở thêm chi nhánh, nhượng quyền hoặc xây dựng hệ thống <strong>vận hành không phụ thuộc bản thân</strong>.'],
          3 => ['🎯', 'Lãnh đạo muốn nâng tầm chiến lược', 'Bạn cần một <strong>không gian chiến lược riêng tư</strong> để suy nghĩ sâu, đặt câu hỏi đúng và có người đồng hành đủ tầm phản biện.'],
          4 => ['⚡', 'Doanh nhân muốn vừa kinh doanh, vừa sống', 'Bạn đã mệt mỏi khi kinh doanh "ăn" hết cuộc sống. Bạn muốn <strong>tái thiết kế doanh nghiệp</strong> để có lợi nhuận VÀ tự do thời gian.'],
        ];
        for ($i = 1; $i <= 4; $i++) :
          $icon  = $f("target{$i}_icon", $target_defaults[$i][0]);
          $title = $f("target{$i}_title", $target_defaults[$i][1]);
          $desc  = $f("target{$i}_desc",  $target_defaults[$i][2]);
        ?>
          <div class="target-card target-card--icon" data-reveal>
            <div class="target-icon"><?php echo esc_html($icon); ?></div>
            <h3><?php echo esc_html($title); ?></h3>
            <p><?php echo wp_kses_post($desc); ?></p>
          </div>
        <?php endfor; ?>
      </div>
    </div>
  </section>


  <!-- ══════════════════════════════════════════════════════
       SECTION 4 — METHOD / APPROACH
       ══════════════════════════════════════════════════════ -->
  <section class="srv-section srv-section--alt">
    <div class="container">
      <div class="section-header" data-reveal>
        <span class="badge badge--gold"><?php echo esc_html($f('method_badge', 'PHƯƠNG PHÁP')); ?></span>
        <h2><?php echo esc_html($f('method_title', 'Coaching 1:1 khác gì khoá học nhóm?')); ?></h2>
        <div class="divider"></div>
      </div>

      <div class="method-layout" data-reveal>
        <!-- Negative column -->
        <div class="method-col method-col--negative">
          <h3><?php echo esc_html($f('method_neg_title', '❌ Khoá học nhóm thông thường')); ?></h3>
          <ul class="method-list">
            <?php
            $neg_defaults = [
              'Nội dung chung, không giải quyết vấn đề riêng của bạn',
              'Kiến thức nhiều nhưng không biết áp dụng vào đâu',
              'Thiếu cam kết follow-up và đo lường kết quả',
              'Không có không gian riêng tư để chia sẻ vấn đề nhạy cảm',
              'Kết thúc khoá học là hết đồng hành',
            ];
            for ($i = 1; $i <= 5; $i++) :
              $item = $f("method_neg{$i}", $neg_defaults[$i - 1]);
              if (!$item) continue;
            ?>
              <li>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b32d2e" stroke-width="2">
                  <path d="M18 6L6 18M6 6l12 12" />
                </svg>
                <span><?php echo esc_html($item); ?></span>
              </li>
            <?php endfor; ?>
          </ul>
        </div>

        <!-- Positive column -->
        <div class="method-col method-col--positive">
          <h3><?php echo esc_html($f('method_pos_title', '✅ Coaching 1:1 Business Mastery')); ?></h3>
          <ul class="method-list">
            <?php
            $pos_defaults = [
              '100% cá nhân hoá theo bài toán doanh nghiệp của bạn',
              'Giải pháp có thể triển khai ngay sau mỗi buổi coaching',
              'Follow-up liên tục, đo lường bằng KPIs rõ ràng',
              'Không gian bảo mật tuyệt đối – chỉ bạn và Coach',
              'Đồng hành dài hạn 3–12 tháng, phát triển bền vững',
            ];
            for ($i = 1; $i <= 5; $i++) :
              $item = $f("method_pos{$i}", $pos_defaults[$i - 1]);
              if (!$item) continue;
            ?>
              <li>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#014F3D" stroke-width="2">
                  <path d="M20 6L9 17l-5-5" />
                </svg>
                <span><?php echo esc_html($item); ?></span>
              </li>
            <?php endfor; ?>
          </ul>
        </div>
      </div>

      <!-- Focus Badges -->
      <div style="text-align: center; margin-top: var(--space-12);" data-reveal>
        <h3 style="margin-bottom: var(--space-2);">Các lĩnh vực khai vấn trọng tâm</h3>
        <div class="divider"></div>
      </div>
      <div class="focus-badge-row" data-reveal>
        <?php
        $badge_defaults = [
          'Chiến lược Tăng trưởng', 'Mở rộng Chuỗi', 'Xây dựng Đội ngũ', 'Tối ưu Vận hành',
          'Branding & Marketing', 'Quản trị Tài chính', 'Phát triển Lãnh đạo', 'Work-Life Harmony',
        ];
        for ($i = 1; $i <= 8; $i++) :
          $badge = $f("method_focus{$i}", $badge_defaults[$i - 1]);
          if (!$badge) continue;
        ?>
          <span class="focus-badge"><?php echo esc_html($badge); ?></span>
        <?php endfor; ?>
      </div>

      <?php $method_note = $f('method_note', '* Mỗi chương trình coaching được thiết kế riêng dựa trên nhu cầu thực tế và mục tiêu kinh doanh cụ thể của bạn. Không có hai chương trình giống nhau.'); ?>
      <?php if ($method_note) : ?>
        <p style="text-align: center; font-size: var(--text-sm); font-style: italic; color: var(--color-fg-muted); margin-top: var(--space-6); max-width: 600px; margin-inline: auto;" data-reveal>
          <?php echo esc_html($method_note); ?>
        </p>
      <?php endif; ?>
    </div>
  </section>


  <!-- ══════════════════════════════════════════════════════
       SECTION 5 — VALUES & DELIVERABLES
       ══════════════════════════════════════════════════════ -->
  <section class="srv-section">
    <div class="container">
      <div class="section-header" data-reveal>
        <span class="badge badge--gold"><?php echo esc_html($f('val_badge', 'GIÁ TRỊ')); ?></span>
        <h2><?php echo esc_html($f('val_title', '3 giá trị cốt lõi bạn nhận được')); ?></h2>
        <div class="divider"></div>
      </div>

      <div class="value-grid" data-reveal-stagger>
        <?php
        $val_defaults = [
          1 => ['CLARITY – SỰ RÕ RÀNG', 'Bạn sẽ có bức tranh toàn cảnh về doanh nghiệp – biết chính xác đâu là nút thắt, đâu là đòn bẩy tăng trưởng, và đâu là bước đi tiếp theo cần ưu tiên.'],
          2 => ['STRATEGY – CHIẾN LƯỢC', 'Không chỉ biết "cần làm gì" mà còn có lộ trình "làm như thế nào" với kế hoạch hành động chi tiết, KPIs đo lường rõ ràng và timeline thực tế.'],
          3 => ['TRANSFORMATION – CHUYỂN HOÁ', 'Không chỉ thay đổi doanh nghiệp mà thay đổi chính bạn – từ tư duy "người thợ" sang tư duy "nhà lãnh đạo", từ làm việc TRONG doanh nghiệp sang làm việc TRÊN doanh nghiệp.'],
        ];
        for ($i = 1; $i <= 3; $i++) :
          $title = $f("val{$i}_title", $val_defaults[$i][0]);
          $desc  = $f("val{$i}_desc",  $val_defaults[$i][1]);
        ?>
          <div class="value-card" data-reveal>
            <div class="value-num"><?php echo esc_html(str_pad($i, 2, '0', STR_PAD_LEFT)); ?></div>
            <h3><?php echo esc_html($title); ?></h3>
            <p><?php echo esc_html($desc); ?></p>
          </div>
        <?php endfor; ?>
      </div>

      <!-- Deliverables -->
      <div style="text-align: center; margin-top: var(--space-16);" data-reveal>
        <h3 style="margin-bottom: var(--space-2);">Bạn sẽ nhận được cụ thể</h3>
        <div class="divider"></div>
      </div>

      <div class="deliv-grid" style="margin-top: var(--space-8);" data-reveal-stagger>
        <?php
        $deliv_defaults = [
          1 => ['🎯 Buổi coaching 1:1 mỗi tuần', '60–90 phút/buổi với Coach Edina Trâm. Tập trung giải quyết bài toán cụ thể của bạn trong tuần đó.'],
          2 => ['📋 Bản chiến lược cá nhân hoá', 'Kế hoạch hành động chi tiết, được thiết kế riêng với KPIs, timeline và milestones cho doanh nghiệp bạn.'],
          3 => ['📞 Hỗ trợ qua chat không giới hạn', 'Gặp vấn đề gấp? Nhắn tin cho Coach bất cứ lúc nào. Cam kết phản hồi trong vòng 24h làm việc.'],
          4 => ['📊 Bộ công cụ quản trị F&B', 'Template tài chính, quy trình vận hành, checklist quản lý, bảng theo dõi KPIs – sẵn sàng áp dụng.'],
          5 => ['🔒 Quyền truy cập khoá B2F', 'Nhận miễn phí toàn bộ nội dung khoá Business to Freedom (trị giá 15.000.000 VNĐ) làm kiến thức nền tảng.'],
          6 => ['🤝 Cộng đồng Mastermind', 'Kết nối với các chủ doanh nghiệp F&B khác trong mạng lưới Business Mastery – chia sẻ, học hỏi và hợp tác.'],
        ];
        for ($i = 1; $i <= 6; $i++) :
          $title = $f("deliv{$i}_title", $deliv_defaults[$i][0]);
          $desc  = $f("deliv{$i}_desc",  $deliv_defaults[$i][1]);
        ?>
          <div class="deliv-card" data-reveal>
            <h3><?php echo esc_html($title); ?></h3>
            <p><?php echo esc_html($desc); ?></p>
          </div>
        <?php endfor; ?>
      </div>
    </div>
  </section>


  <!-- ══════════════════════════════════════════════════════
       SECTION 6 — COMPARE & PRICING
       ══════════════════════════════════════════════════════ -->
  <section class="srv-section srv-section--alt">
    <div class="container">
      <div class="section-header" data-reveal>
        <span class="badge badge--gold"><?php echo esc_html($f('pricing_badge', 'SO SÁNH & ĐẦU TƯ')); ?></span>
        <h2><?php echo esc_html($f('pricing_title', 'Chọn gói phù hợp với bạn')); ?></h2>
        <div class="divider"></div>
      </div>

      <!-- Comparison Table -->
      <div class="compare-table-wrap" data-reveal style="margin-bottom: var(--space-16);">
        <table class="compare-table">
          <thead>
            <tr>
              <th>Tiêu chí</th>
              <th>Business to Freedom</th>
              <th class="highlight-col">Business Mastery</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $compare_defaults = [
              1 => ['Hình thức', 'Khoá học nhóm online', 'Coaching 1:1 riêng tư'],
              2 => ['Thời lượng', '10 tuần cố định', '3 – 12 tháng linh hoạt'],
              3 => ['Nội dung', 'Chương trình có sẵn', '100% cá nhân hoá'],
              4 => ['Đối tượng', 'Mới kinh doanh / startup', 'Chủ DN đã vận hành 2+ năm'],
              5 => ['Hỗ trợ', 'Trong giờ học + nhóm', 'Chat 24/7 + Gọi khẩn cấp'],
              6 => ['Follow-up', 'Bài tập nhóm', 'KPIs & Accountability cá nhân'],
              7 => ['Mức đầu tư', '15.000.000 VNĐ', 'Từ 60.000.000 VNĐ'],
            ];
            for ($i = 1; $i <= 7; $i++) :
              $criteria = $f("compare{$i}_criteria", $compare_defaults[$i][0]);
              $b2f_val  = $f("compare{$i}_b2f",      $compare_defaults[$i][1]);
              $bm_val   = $f("compare{$i}_bm",       $compare_defaults[$i][2]);
            ?>
              <tr>
                <td><?php echo esc_html($criteria); ?></td>
                <td><?php echo esc_html($b2f_val); ?></td>
                <td class="highlight-col"><strong><?php echo esc_html($bm_val); ?></strong></td>
              </tr>
            <?php endfor; ?>
          </tbody>
        </table>
      </div>

      <!-- Pricing Cards -->
      <div class="plans-grid" data-reveal-stagger>
        <?php
        $plan_defaults = [
          1 => ['3 Tháng', 'Trải nghiệm & Khám phá', '60.000.000 VNĐ', "12 buổi coaching 1:1\nBản chiến lược 90 ngày\nHỗ trợ chat trong giờ hành chính\nBộ công cụ quản trị F&B", ''],
          2 => ['6 Tháng', 'Chuyển hoá & Tăng trưởng', '100.000.000 VNĐ', "24 buổi coaching 1:1\nChiến lược 6 tháng toàn diện\nChat không giới hạn + Gọi khẩn cấp\nTruy cập khoá B2F miễn phí\nCộng đồng Mastermind", '1'],
          3 => ['12 Tháng', 'Bền vững & Nhân rộng', '180.000.000 VNĐ', "48 buổi coaching 1:1\nChiến lược dài hạn toàn diện\nChat & Gọi không giới hạn\nTruy cập khoá B2F + Tất cả công cụ\nMastermind VIP + 2 buổi on-site\nƯu tiên slot coaching vĩnh viễn", ''],
        ];
        for ($i = 1; $i <= 3; $i++) :
          $duration = $f("plan{$i}_duration", $plan_defaults[$i][0]);
          $subtitle = $f("plan{$i}_subtitle", $plan_defaults[$i][1]);
          $price    = $f("plan{$i}_price",    $plan_defaults[$i][2]);
          $features = $f("plan{$i}_features", $plan_defaults[$i][3]);
          $featured = $f("plan{$i}_featured", $plan_defaults[$i][4]);
          $card_class = $featured ? 'plan-card plan-card--featured' : 'plan-card';
        ?>
          <div class="<?php echo esc_attr($card_class); ?>" data-reveal>
            <?php if ($featured) : ?>
              <div class="plan-badge">Phổ biến nhất</div>
            <?php endif; ?>
            <h3 class="plan-duration"><?php echo esc_html($duration); ?></h3>
            <p class="plan-subtitle"><?php echo esc_html($subtitle); ?></p>
            <ul class="plan-features">
              <?php
              $feature_lines = array_filter(array_map('trim', explode("\n", $features)));
              foreach ($feature_lines as $line) :
              ?>
                <li>
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M20 6L9 17l-5-5" />
                  </svg>
                  <span><?php echo esc_html($line); ?></span>
                </li>
              <?php endforeach; ?>
            </ul>
            <div class="plan-price-wrap">
              <span class="plan-price"><?php echo esc_html($price); ?></span>
            </div>
          </div>
        <?php endfor; ?>
      </div>

      <?php $capacity = $f('capacity_note', 'Chương trình Business Mastery chỉ nhận tối đa <strong>5 khách hàng</strong> đồng thời để đảm bảo chất lượng đồng hành tuyệt đối.'); ?>
      <?php if ($capacity) : ?>
        <p class="capacity-note" data-reveal>
          ⚡ <?php echo wp_kses_post($capacity); ?>
        </p>
      <?php endif; ?>
    </div>
  </section>


  <!-- ══════════════════════════════════════════════════════
       SECTION 7 — CTA FINAL
       ══════════════════════════════════════════════════════ -->
  <section class="srv-cta-final">
    <div class="container" data-reveal>
      <span class="badge badge--dark"><?php echo esc_html($f('cta_badge', 'BUSINESS MASTERY')); ?></span>
      <?php echo wp_kses_post($f('cta_title', '<h2>Bắt đầu thiết lập tương lai bền vững cho thương hiệu F&B của bạn</h2>')); ?>
      <p><?php echo esc_html($f('cta_desc', 'Đặt lịch trao đổi 30 phút miễn phí với Coach Edina Trâm để cùng đánh giá hiện trạng doanh nghiệp và xác định liệu Business Mastery có phù hợp với bạn.')); ?></p>
      <a href="<?php echo esc_url($f('cta_url', '/lien-he')); ?>" class="btn btn--accent btn--lg"><?php echo esc_html($f('cta_label', 'ĐẶT LỊCH TƯ VẤN MIỄN PHÍ')); ?></a>
      <?php $cta_note = $f('cta_note', '🔒 Mọi thông tin được bảo mật tuyệt đối. Không ràng buộc.'); ?>
      <?php if ($cta_note) : ?>
        <p class="cta-note"><?php echo esc_html($cta_note); ?></p>
      <?php endif; ?>
    </div>
  </section>

</main>

<?php get_footer(); ?>
