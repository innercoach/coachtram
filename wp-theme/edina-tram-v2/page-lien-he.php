<?php
/**
 * Template Name: Liên hệ
 * Page slug: lien-he
 */
get_header();

// --- Hero ---
$hero_badge = edt_field('contact_hero_badge') ?: 'Liên hệ';
$hero_title = edt_field('contact_hero_title') ?: 'Hãy kết nối cùng tôi';
$hero_desc  = edt_field('contact_hero_desc')  ?: 'Buổi tư vấn đầu tiên hoàn toàn miễn phí — không có cam kết.';

// --- Info Card ---
$info_badge    = edt_field('contact_info_badge')    ?: 'Thông tin';
$info_title    = edt_field('contact_info_title')    ?: 'Tôi muốn lắng nghe bạn';
$info_desc     = edt_field('contact_info_desc')     ?: 'Đừng ngần ngại liên hệ qua bất kỳ kênh nào bạn thấy tiện nhất. Tôi sẽ phản hồi trong vòng 24 giờ.';
$info_email    = edt_field('contact_info_email')    ?: edt_option('contact_email', 'coachtram@gmail.com');
$info_phone    = edt_field('contact_info_phone')    ?: edt_option('contact_phone', '0901 234 567');
$info_facebook = edt_field('contact_info_facebook') ?: edt_option('social_facebook', 'https://www.facebook.com/coachtram');
$info_hours    = edt_field('contact_info_hours')    ?: 'Thứ 2 – Thứ 7, 8:00 – 21:00';

// --- Form Card ---
$form_badge     = edt_field('contact_form_badge')     ?: 'Gửi tin nhắn';
$form_title     = edt_field('contact_form_title')     ?: 'Đặt lịch tư vấn miễn phí';
$form_lead      = edt_field('contact_form_lead')      ?: 'Điền thông tin bên dưới và tôi sẽ liên hệ lại với bạn sớm nhất có thể.';
$form_note      = edt_field('contact_form_note')      ?: 'Tôi sẽ phản hồi trong vòng 24 giờ. Thông tin của bạn được bảo mật tuyệt đối.';

// Extract display name from Facebook URL
$fb_display = '/coachtram';
if ($info_facebook) {
    $fb_path = wp_parse_url($info_facebook, PHP_URL_PATH);
    if ($fb_path) {
        $fb_display = '/' . trim($fb_path, '/');
    }
}
?>

<main>
    <!-- ═══ Decorative Glow Blobs ═══ -->
    <div class="glow-blob glow-blob--gold glow-blob--1" aria-hidden="true"></div>
    <div class="glow-blob glow-blob--emerald glow-blob--2" aria-hidden="true"></div>

    <!-- ═══ Contact Hero ═══ -->
    <section class="contact-hero" data-reveal>
      <div class="container">
        <span class="badge badge--dark"><?php echo esc_html($hero_badge); ?></span>
        <h1><?php echo esc_html($hero_title); ?></h1>
        <p><?php echo esc_html($hero_desc); ?></p>
      </div>
    </section>

    <!-- ═══ Contact Layout ═══ -->
    <section data-reveal>
      <div class="container">
        <div class="contact-layout">

          <!-- ─── Info Card ─── -->
          <div class="contact-info-card" data-reveal>
            <span class="badge"><?php echo esc_html($info_badge); ?></span>
            <h2><?php echo esc_html($info_title); ?></h2>
            <div class="divider divider--left"></div>
            <p><?php echo esc_html($info_desc); ?></p>

            <div class="info-list">
              <!-- Email -->
              <div class="info-item">
                <div class="info-icon" aria-hidden="true">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                    <polyline points="22,6 12,13 2,6"/>
                  </svg>
                </div>
                <div>
                  <p class="info-label">Email</p>
                  <p class="info-value"><a href="mailto:<?php echo esc_attr($info_email); ?>"><?php echo esc_html($info_email); ?></a></p>
                </div>
              </div>

              <!-- Phone -->
              <div class="info-item">
                <div class="info-icon" aria-hidden="true">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13 19.79 19.79 0 0 1 1.61 4.35 2 2 0 0 1 3.59 2.18h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                  </svg>
                </div>
                <div>
                  <p class="info-label">Số điện thoại</p>
                  <p class="info-value"><a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $info_phone)); ?>"><?php echo esc_html($info_phone); ?></a></p>
                </div>
              </div>

              <!-- Facebook -->
              <div class="info-item">
                <div class="info-icon" aria-hidden="true">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
                  </svg>
                </div>
                <div>
                  <p class="info-label">Facebook</p>
                  <p class="info-value"><a href="<?php echo esc_url($info_facebook); ?>" target="_blank" rel="noopener"><?php echo esc_html($fb_display); ?></a></p>
                </div>
              </div>

              <!-- Working hours -->
              <div class="info-item">
                <div class="info-icon" aria-hidden="true">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <polyline points="12 6 12 12 16 14"/>
                  </svg>
                </div>
                <div>
                  <p class="info-label">Giờ làm việc</p>
                  <p class="info-value"><?php echo esc_html($info_hours); ?></p>
                </div>
              </div>
            </div>
          </div>

          <!-- ─── Form Card ─── -->
          <div class="contact-form-card" data-reveal>
            <span class="badge"><?php echo esc_html($form_badge); ?></span>
            <h2><?php echo esc_html($form_title); ?></h2>
            <p class="form-lead"><?php echo esc_html($form_lead); ?></p>

            <?php
            $shortcode = edt_field('contact_form_shortcode');
            if (!empty($shortcode)) :
                echo do_shortcode(wp_kses_post($shortcode));
            else :
            ?>
                <p style="text-align:center; color: var(--color-fg-muted); padding: var(--space-8) 0;">Vui lòng cài đặt plugin <strong>Fluent Forms</strong> và nhập shortcode trong trang quản trị.</p>
            <?php endif; ?>

            <p class="form-note"><?php echo esc_html($form_note); ?></p>
          </div>

        </div>
      </div>
    </section>
</main>

<?php get_footer(); ?>
