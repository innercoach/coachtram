<?php
/**
 * Template Name: Dịch vụ 1 — Passion to Profit
 * Slug: dich-vu-1
 */
get_header();

/* ── Field helpers ── */
$f = function($key, $default = '') { return edt_field($key, null, $default); };
$img = function($key, $size = 'large') { return edt_img_url($key, $size); };
?>

<style>:root { --page-accent: #0B8A66; } body { padding-bottom: 80px; }</style>


<!-- ═══ STICKY CTA BAR ═══ -->
<div class="sticky-cta">
    <div class="sticky-cta-info">
        <span class="sticky-cta-dot"></span>
        <div>
            <p class="sticky-cta-title"><?php echo esc_html($f('dv1_sticky_title', 'Passion to Profit – Workshop')); ?></p>
            <span class="sticky-cta-meta"><?php echo esc_html($f('dv1_sticky_meta', '22–23/03/2026 · 2 ngày cuối tuần · 499.000 VNĐ')); ?></span>
        </div>
    </div>
    <a href="<?php echo esc_url($f('dv1_sticky_cta_url', 'https://zalo.me/0901234567')); ?>" class="btn btn--accent btn--sm"><?php echo esc_html($f('dv1_sticky_cta_label', 'Đăng Ký Ngay')); ?></a>
</div>


<!-- ═══ MAIN ═══ -->
<main>

    <!-- Glow Blobs -->
    <div class="glow-blob glow-blob--gold glow-blob--1" aria-hidden="true"></div>
    <div class="glow-blob glow-blob--emerald glow-blob--2" aria-hidden="true"></div>


    <!-- ─── 1. HERO ─── -->
    <section class="srv-hero">
      <div class="container srv-hero-grid">
        <div class="srv-hero-content" data-reveal>
          <span class="badge"><?php echo esc_html($f('dv1_hero_badge', 'WORKSHOP 2 NGÀY')); ?></span>
          <h1>
            <?php echo wp_kses_post($f('dv1_hero_title', 'PASSION<br>TO <span>PROFIT</span>')); ?>
          </h1>
          <p class="srv-hero-tagline"><?php echo esc_html($f('dv1_hero_tagline', 'Chuyển đổi đam mê thành mô hình kinh doanh thực tế')); ?></p>
          <p class="srv-hero-desc">
            <?php echo esc_html($f('dv1_hero_desc', 'Workshop thực chiến 2 ngày giúp bạn tìm ra giao điểm giữa đam mê, thế mạnh và nhu cầu thị trường – từ đó phác thảo mô hình kinh doanh đầu tiên có khả năng sinh lợi nhuận bền vững. Đồng hành bởi Coach Edina Trâm với hơn 15 năm kinh nghiệm thực chiến.')); ?>
          </p>

          <div class="srv-hero-meta">
            <span class="meta-item">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
              <?php echo esc_html($f('dv1_hero_duration', '2 ngày cuối tuần, 9:00–17:00')); ?>
            </span>
            <span class="meta-item">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
              <?php echo esc_html($f('dv1_hero_date', '22–23/03/2026')); ?>
            </span>
          </div>

          <div class="price-badge"><?php echo esc_html($f('dv1_hero_price', '499.000 VNĐ')); ?></div>

          <?php $countdown_target = $f('dv1_hero_countdown', '2026-03-22T09:00:00'); ?>
          <div class="countdown" data-target="<?php echo esc_attr($countdown_target); ?>" style="margin-top:var(--space-6);margin-bottom:var(--space-6);">
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

          <a href="<?php echo esc_url($f('dv1_hero_cta_url', 'https://zalo.me/0901234567')); ?>" class="btn btn--primary btn--lg"><?php echo esc_html($f('dv1_hero_cta_label', 'Đăng Ký Ngay →')); ?></a>

          <p class="scholarship-note" style="font-size:var(--text-sm);color:var(--color-fg-muted);margin-top:var(--space-3);">
            <?php echo wp_kses_post($f('dv1_hero_scholarship', '🎓 <strong style="color:var(--color-primary)">Học bổng 50%</strong> dành cho sinh viên &amp; người mới bắt đầu. <a href="https://zalo.me/0901234567" style="color:var(--royal-gold);text-decoration:underline;">Liên hệ để biết thêm</a>')); ?>
          </p>
        </div>

        <div class="srv-hero-img" data-reveal>
          <?php $hero_img = $img('dv1_hero_image'); ?>
          <?php if ($hero_img) : ?>
            <img src="<?php echo esc_url($hero_img); ?>" alt="<?php echo esc_attr($f('dv1_hero_tagline', 'Coach Edina Trâm – Passion to Profit Workshop')); ?>" loading="lazy" />
          <?php else : ?>
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/placeholder.png'); ?>" alt="Coach Edina Trâm – Passion to Profit Workshop" loading="lazy" />
          <?php endif; ?>
        </div>
      </div>
    </section>


    <!-- ─── 2. CREDIBILITY ─── -->
    <section class="srv-section srv-section--alt" data-reveal>
      <div class="container">
        <div class="section-header">
          <span class="badge"><?php echo esc_html($f('dv1_cred_badge', 'UY TÍN & KINH NGHIỆM')); ?></span>
          <h2><?php echo esc_html($f('dv1_cred_title', 'Người đồng hành thực chiến')); ?></h2>
          <div class="divider"></div>
          <p><?php echo esc_html($f('dv1_cred_desc', 'Edina Trâm không chỉ chia sẻ lý thuyết – cô ấy đã sống, trải nghiệm và xây dựng từ con số không.')); ?></p>
        </div>

        <div class="stat-grid" data-reveal-stagger>
          <div class="stat-card" data-reveal>
            <div class="stat-num" data-count="<?php echo esc_attr($f('dv1_cred_stat1_num', '15')); ?>" data-suffix="+">0</div>
            <div class="stat-label"><?php echo esc_html($f('dv1_cred_stat1_label', 'Năm kinh nghiệm kinh doanh')); ?></div>
          </div>
          <div class="stat-card" data-reveal>
            <div class="stat-num" data-count="<?php echo esc_attr($f('dv1_cred_stat2_num', '9')); ?>" data-suffix="+">0</div>
            <div class="stat-label"><?php echo esc_html($f('dv1_cred_stat2_label', 'Năm xây dựng startup')); ?></div>
          </div>
          <div class="stat-card" data-reveal>
            <div class="stat-num" data-count="<?php echo esc_attr($f('dv1_cred_stat3_num', '1000')); ?>" data-suffix="+">0</div>
            <div class="stat-label"><?php echo esc_html($f('dv1_cred_stat3_label', 'Cuốn sách đã nghiên cứu')); ?></div>
          </div>
          <div class="stat-card" data-reveal>
            <div class="stat-num" data-count="<?php echo esc_attr($f('dv1_cred_stat4_num', '30')); ?>" data-suffix="+">0</div>
            <div class="stat-label"><?php echo esc_html($f('dv1_cred_stat4_label', 'Khách hàng được coaching')); ?></div>
          </div>
        </div>
      </div>
    </section>


    <!-- ─── 3. TARGET AUDIENCE ─── -->
    <section class="srv-section" data-reveal>
      <div class="container">
        <div class="section-header">
          <span class="badge"><?php echo esc_html($f('dv1_target_badge', 'DÀNH CHO AI')); ?></span>
          <h2><?php echo esc_html($f('dv1_target_title', 'Ai sẽ phù hợp với workshop này?')); ?></h2>
          <div class="divider"></div>
        </div>

        <div class="target-grid" data-reveal-stagger>
          <?php for ($i = 1; $i <= 6; $i++) :
            $default_titles = [
              1 => 'Nhân viên văn phòng',
              2 => 'Freelancer & người tự do',
              3 => 'Người trẻ khởi nghiệp',
              4 => 'Phụ nữ muốn độc lập tài chính',
              5 => 'Người đang chuyển giao sự nghiệp',
              6 => 'Bất kỳ ai có đam mê',
            ];
            $default_descs = [
              1 => '<strong>Nhân viên văn phòng</strong> muốn thoát khỏi guồng quay 9-to-5 và bắt đầu công việc kinh doanh từ đam mê cá nhân.',
              2 => '<strong>Freelancer &amp; người tự do</strong> có kỹ năng nhưng chưa biết cách biến nó thành nguồn thu nhập ổn định, có hệ thống.',
              3 => '<strong>Người trẻ khởi nghiệp</strong> nhiều ý tưởng nhưng không biết bắt đầu từ đâu, cần một lộ trình rõ ràng để hành động.',
              4 => '<strong>Phụ nữ muốn độc lập tài chính</strong> – xây dựng thu nhập riêng bên cạnh gia đình mà không đánh đổi cuộc sống.',
              5 => '<strong>Người đang chuyển giao sự nghiệp</strong> – muốn tìm lại mục đích và xây dựng điều gì đó có ý nghĩa hơn.',
              6 => '<strong>Bất kỳ ai có đam mê</strong> nhưng chưa dám hành động – Workshop sẽ cho bạn sự tự tin và bước đi đầu tiên.',
            ];
          ?>
          <div class="target-card" data-reveal>
            <div class="target-num"><?php echo esc_html(str_pad($i, 2, '0', STR_PAD_LEFT)); ?></div>
            <p><?php echo wp_kses_post($f('dv1_target' . $i . '_desc', $default_descs[$i])); ?></p>
          </div>
          <?php endfor; ?>
        </div>
      </div>
    </section>


    <!-- ─── 4. BENEFITS ─── -->
    <section class="srv-section srv-section--alt" data-reveal>
      <div class="container">
        <div class="section-header">
          <span class="badge badge--gold"><?php echo esc_html($f('dv1_benefit_badge', 'GIÁ TRỊ NHẬN ĐƯỢC')); ?></span>
          <h2><?php echo esc_html($f('dv1_benefit_title', 'Bạn sẽ đạt được gì sau 2 ngày?')); ?></h2>
          <div class="divider"></div>
        </div>

        <div class="benefit-grid" data-reveal-stagger>
          <?php
          $default_icons  = ['🔍', '🧭', '📐', '💡', '📋', '🤝'];
          $default_titles = [
            'Khám phá giao điểm vàng',
            'Xác định khách hàng mục tiêu',
            'Phác thảo mô hình kinh doanh',
            'Tư duy doanh nhân thực chiến',
            'Kế hoạch hành động 90 ngày',
            'Cộng đồng & hỗ trợ sau workshop',
          ];
          $default_descs = [
            'Tìm ra nơi đam mê, thế mạnh và nhu cầu thị trường gặp nhau – giao điểm sinh lợi nhuận bền vững nhất.',
            'Hiểu rõ khách hàng lý tưởng, nỗi đau của họ và cách bạn giải quyết được vấn đề của họ tốt hơn ai hết.',
            'Xây dựng Business Model Canvas đầu tiên – nền tảng để biến ý tưởng thành doanh nghiệp thực tế có doanh thu.',
            'Chuyển đổi từ tư duy nhân viên sang tư duy doanh nhân – biết cách nghĩ, ra quyết định và hành động.',
            'Ra về với bản kế hoạch 90 ngày chi tiết – biết chính xác phải làm gì mỗi tuần để tiến đến mục tiêu.',
            'Tham gia cộng đồng học viên cùng chí hướng, được hỗ trợ và kết nối lâu dài sau khóa học.',
          ];
          for ($i = 1; $i <= 6; $i++) : ?>
          <div class="benefit-card" data-reveal>
            <div class="benefit-icon"><?php echo esc_html($f('dv1_ben' . $i . '_icon', $default_icons[$i - 1])); ?></div>
            <h3><?php echo esc_html($f('dv1_ben' . $i . '_title', $default_titles[$i - 1])); ?></h3>
            <p><?php echo esc_html($f('dv1_ben' . $i . '_desc', $default_descs[$i - 1])); ?></p>
          </div>
          <?php endfor; ?>
        </div>
      </div>
    </section>


    <!-- ─── 5. MODULES ─── -->
    <section class="srv-section" data-reveal>
      <div class="container">
        <div class="section-header">
          <span class="badge"><?php echo esc_html($f('dv1_mod_badge', 'NỘI DUNG WORKSHOP')); ?></span>
          <h2><?php echo esc_html($f('dv1_mod_title', 'Nội dung chi tiết')); ?></h2>
          <div class="divider"></div>
        </div>

        <div class="modules-list" data-reveal-stagger>
          <?php
          $default_labels = ['WHY', 'WHAT', "WHAT'S NEXT"];
          $default_mod_titles = ['Tại sao bắt đầu?', 'Xây dựng mô hình', 'Hành động ngay'];
          $default_mod_descs = [
            'Khám phá động lực sâu xa đằng sau mong muốn kinh doanh của bạn. Xác định giá trị cốt lõi, đam mê thực sự và "ikigai" cá nhân. Hiểu rõ tại sao đây là thời điểm phù hợp để bắt đầu – và vượt qua nỗi sợ hãi "mình không đủ giỏi" để dám hành động.',
            'Nghiên cứu thị trường và tìm ngách kinh doanh phù hợp. Xây dựng chân dung khách hàng lý tưởng (Customer Avatar). Thiết kế sản phẩm/dịch vụ đầu tiên, định giá và xây dựng Business Model Canvas hoàn chỉnh. Phác thảo chiến lược marketing ban đầu.',
            'Xây dựng kế hoạch hành động 90 ngày chi tiết. Thiết lập hệ thống theo dõi tiến độ và KPI đo lường. Cam kết hành động với nhóm accountability partner. Nhận feedback trực tiếp từ Coach Edina Trâm và cộng đồng.',
          ];
          for ($i = 1; $i <= 3; $i++) : ?>
          <div class="module-card" data-reveal>
            <div class="module-label"><?php echo esc_html($f('dv1_mod' . $i . '_label', $default_labels[$i - 1])); ?></div>
            <div>
              <h3><?php echo esc_html($f('dv1_mod' . $i . '_title', $default_mod_titles[$i - 1])); ?></h3>
              <div><?php echo wp_kses_post($f('dv1_mod' . $i . '_desc', $default_mod_descs[$i - 1])); ?></div>
            </div>
          </div>
          <?php endfor; ?>
        </div>
      </div>
    </section>


    <!-- ─── 6. TESTIMONIALS ─── -->
    <section class="srv-section srv-section--alt" data-reveal>
      <div class="container">
        <div class="section-header">
          <span class="badge badge--gold"><?php echo esc_html($f('dv1_testi_badge', 'PHẢN HỒI HỌC VIÊN')); ?></span>
          <h2><?php echo esc_html($f('dv1_testi_title', 'Học viên nói gì')); ?></h2>
          <div class="divider"></div>
        </div>

        <?php edt_render_testimonials('dich-vu-1'); ?>
      </div>
    </section>


    <!-- ─── 7. INSTRUCTOR ─── -->
    <section class="srv-section" data-reveal>
      <div class="container">
        <div class="section-header">
          <span class="badge"><?php echo esc_html__('NGƯỜI HƯỚNG DẪN', 'edina-tram'); ?></span>
          <h2><?php echo esc_html__('Gặp gỡ Coach của bạn', 'edina-tram'); ?></h2>
          <div class="divider"></div>
        </div>

        <div class="instructor-layout">
          <div class="instructor-img" data-reveal>
            <?php $inst_img = $img('dv1_inst_image'); ?>
            <?php if ($inst_img) : ?>
              <img src="<?php echo esc_url($inst_img); ?>" alt="<?php echo esc_attr(edt_option('coach_name', 'Coach Edina Trâm')); ?>" loading="lazy" />
            <?php else : ?>
              <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/placeholder.png'); ?>" alt="Coach Edina Trâm" loading="lazy" />
            <?php endif; ?>
          </div>
          <div data-reveal>
            <h3 class="instructor-name"><?php echo esc_html(edt_option('coach_name', 'Edina Trâm')); ?></h3>
            <p class="instructor-title"><?php echo esc_html(edt_option('coach_title', 'Business Coach · Life Strategist · Serial Entrepreneur')); ?></p>
            <?php
            $coach_bio = edt_option('coach_bio', '');
            if ($coach_bio) : ?>
            <p style="font-size:var(--text-sm);line-height:1.8;margin-bottom:var(--space-6);">
              <?php echo wp_kses_post($coach_bio); ?>
            </p>
            <?php else : ?>
            <p style="font-size:var(--text-sm);line-height:1.8;margin-bottom:var(--space-6);">
              Với hơn 15 năm kinh nghiệm kinh doanh và coaching, Edina Trâm đã đồng hành cùng hàng trăm
              cá nhân chuyển đổi đam mê thành doanh nghiệp thành công. Cô tin rằng mỗi người đều có
              một "vùng thiên tài" riêng – và nhiệm vụ của cô là giúp bạn tìm ra và khai phá nó.
            </p>
            <?php endif; ?>

            <div class="cred-list">
              <?php
              $default_creds = [
                ['num' => '15+', 'text' => 'Năm kinh nghiệm kinh doanh và tư vấn chiến lược'],
                ['num' => '9+',  'text' => 'Năm trực tiếp xây dựng và vận hành startup'],
                ['num' => 'ICF', 'text' => 'Chứng chỉ coaching quốc tế từ International Coach Federation'],
                ['num' => '30+', 'text' => 'Khách hàng cá nhân được coaching 1:1 thành công'],
                ['num' => '🎤',  'text' => 'Diễn giả tại nhiều sự kiện khởi nghiệp và hội thảo doanh nhân'],
              ];
              for ($i = 1; $i <= 5; $i++) :
                $cred_num  = $f('dv1_inst_cred' . $i . '_num',  $default_creds[$i - 1]['num']);
                $cred_text = $f('dv1_inst_cred' . $i . '_text', $default_creds[$i - 1]['text']);
              ?>
              <div class="cred-item">
                <span class="cred-num"><?php echo esc_html($cred_num); ?></span>
                <p><?php echo esc_html($cred_text); ?></p>
              </div>
              <?php endfor; ?>
            </div>

            <div class="social-links">
              <?php $fb = edt_option('social_facebook'); if ($fb) : ?>
              <a href="<?php echo esc_url($fb); ?>" aria-label="Facebook">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path></svg>
              </a>
              <?php endif; ?>
              <?php $ig = edt_option('social_instagram'); if ($ig) : ?>
              <a href="<?php echo esc_url($ig); ?>" aria-label="Instagram">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
              </a>
              <?php endif; ?>
              <?php $web = edt_option('social_website'); if ($web) : ?>
              <a href="<?php echo esc_url($web); ?>" aria-label="Website">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"></path></svg>
              </a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- ─── 8. FAQ ─── -->
    <section class="srv-section srv-section--alt" data-reveal>
      <div class="container">
        <div class="section-header">
          <span class="badge"><?php echo esc_html($f('dv1_faq_badge', 'GIẢI ĐÁP THẮC MẮC')); ?></span>
          <h2><?php echo esc_html($f('dv1_faq_title', 'Câu hỏi thường gặp')); ?></h2>
          <div class="divider"></div>
        </div>

        <?php edt_render_faqs('dich-vu-1'); ?>
      </div>
    </section>


    <!-- ─── 9. CTA FINAL ─── -->
    <section class="srv-cta-final" data-reveal>
      <div class="container">
        <p style="font-family:var(--font-heading);font-size:var(--text-xl);font-style:italic;color:var(--champagne-glow);margin-bottom:var(--space-6);max-width:600px;margin-inline:auto;">
          <?php echo esc_html($f('dv1_cta_quote', '"Thời điểm tốt nhất để bắt đầu là 20 năm trước. Thời điểm tốt thứ hai là ngay bây giờ."')); ?>
        </p>
        <h2><?php echo wp_kses_post($f('dv1_cta_title', 'Đừng chờ đến khi "sẵn sàng" –<br>hãy bắt đầu và trở nên sẵn sàng.')); ?></h2>
        <p style="max-width:560px;">
          <?php echo esc_html($f('dv1_cta_desc', 'Chỉ 2 ngày, bạn sẽ có tất cả những gì cần thiết để biến đam mê thành lợi nhuận. Hãy để Coach Edina Trâm đồng hành cùng bạn trên hành trình này.')); ?>
        </p>
        <a href="<?php echo esc_url($f('dv1_cta_url', 'https://zalo.me/0901234567')); ?>" class="btn btn--accent btn--lg"><?php echo esc_html($f('dv1_cta_label', 'Đăng Ký Workshop Ngay →')); ?></a>
        <p class="cta-note">
          <?php
          $cta_phone = $f('dv1_cta_phone', '0901 234 567');
          $cta_phone_raw = preg_replace('/\s+/', '', $cta_phone);
          ?>
          Hoặc gọi hotline: <a href="tel:<?php echo esc_attr($cta_phone_raw); ?>" style="color:var(--champagne-glow);"><?php echo esc_html($cta_phone); ?></a> để được tư vấn trực tiếp.
        </p>
      </div>
    </section>

</main>

<?php get_footer(); ?>
