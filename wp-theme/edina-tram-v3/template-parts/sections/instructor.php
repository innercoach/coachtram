<?php
/**
 * Section: instructor — "Đôi nét về Edina Trâm"
 * Nạp qua: edt_section('instructor', ['label' => ..., 'alt' => ..., 'img' => ...]);
 *
 * @var array $args label|alt|img
 */
if (!defined('ABSPATH')) exit;

$label = $args['label'] ?? 'Đôi nét về Edina Trâm';
$alt   = $args['alt']   ?? 'Edina Trâm';
$img   = $args['img']   ?? edt_asset('images/profile.jpg');
?>
<section class="srv-section--dark bg-tram-4" aria-label="<?php echo esc_attr($label); ?>">
  <div class="container">
    <div class="instructor-layout">
      <div class="instructor-img" data-reveal style="border-color: var(--royal-gold); max-width: 420px; margin-inline: auto;">
        <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($alt); ?>" loading="lazy" style="border-radius: var(--radius-lg);">
      </div>
      <div data-reveal>
        <div class="section-header" style="text-align: left; margin-bottom: var(--space-6); max-width: none;">
          <span class="badge badge--gold">Đôi nét về Edina Trâm</span>
          <h2 style="margin-top: var(--space-4);">Thanh lịch, trí tuệ và ấm áp</h2>
          <div class="divider divider--left"></div>
        </div>
        <h3 class="instructor-name" style="color: #fff;">Edina Trâm</h3>
        <p class="instructor-title" style="color: var(--champagne-glow);">Tham vấn Tâm lý · Khai vấn cuộc sống · Tài chính · Tâm linh</p>
        <p style="color: rgba(255,255,255,0.85);">Điều thú vị ở Trâm không nằm ở một vài tấm bằng, mà ở chỗ rất ít người hội tụ cả bốn thế giới: Tâm lý học, Khai vấn, Tâm linh và Tài chính cùng một lúc.</p>
        <ul class="tina-profile-list">
          <li>Thạc sỹ Tâm lý học - Đại học Sư phạm Hà Nội.</li>
          <li>Thạc sỹ Tài chính Ngân hàng - University of Southampton, Anh Quốc.</li>
          <li>ICF Associate Certified Coach (ACC) - International Coaching Federation.</li>
          <li>ACCA - nhiều năm kinh nghiệm tài chính tại các doanh nghiệp.</li>
          <li>Hơn 15 năm nghiên cứu và thực hành tâm linh, thiền định, Tử Vi và Nhân số học.</li>
          <li>Hơn 20 năm sinh sống và làm việc tại Anh, Singapore, Na Uy và Việt Nam.</li>
        </ul>
        <div class="social-links" style="margin-top: var(--space-6);">
          <a href="https://www.facebook.com/edina.quynhtram" target="_blank" rel="noopener" aria-label="Facebook" style="border-color: rgba(255,255,255,0.15); color: rgba(255,255,255,0.7);">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path></svg>
          </a>
          <a href="mailto:lequynhtram@gmail.com" aria-label="Email" style="border-color: rgba(255,255,255,0.15); color: rgba(255,255,255,0.7);">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
          </a>
          <a href="https://edinatram.vn" target="_blank" rel="noopener" aria-label="Website" style="border-color: rgba(255,255,255,0.15); color: rgba(255,255,255,0.7);">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"></path></svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
