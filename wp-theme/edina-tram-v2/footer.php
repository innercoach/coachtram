<?php
/**
 * Edina Trâm V2 — footer.php
 * Site-wide footer: logo, tagline, link columns, copyright, social icons, scroll-to-top.
 */
?>

</main>


<!-- ═══ FOOTER ═══ -->
<footer class="site-footer">
  <div class="container">
    <div class="footer-inner">

      <!-- Brand column -->
      <div>
        <div class="footer-logo">
          <?php
          $logo_img_id = get_option('edt_logo_image', '');
          if ($logo_img_id) {
              $logo_src = wp_get_attachment_image_src(absint($logo_img_id), 'full');
              if ($logo_src) {
                  echo '<img src="' . esc_url($logo_src[0]) . '" alt="' . esc_attr(get_bloginfo('name')) . '">';
              } else {
                  echo wp_kses_post(get_option('edt_logo_text', 'Edina <span>Trâm</span>'));
              }
          } else {
              echo wp_kses_post(get_option('edt_logo_text', 'Edina <span>Trâm</span>'));
          }
          ?>
        </div>
        <p class="footer-tagline"><?php echo esc_html(edt_option('footer_tagline', 'Dẫn lối bình an, khai mở nội lực. Đồng hành cùng bạn trên hành trình kiến tạo cuộc sống chất lượng.')); ?></p>
      </div>

      <!-- Về Edina -->
      <div class="footer-col">
        <h4>Về Edina</h4>
        <div class="footer-links">
          <a href="#">Câu chuyện của tôi</a>
          <a href="#">Giá trị &amp; Triết lý</a>
          <a href="#">Chứng chỉ &amp; Đào tạo</a>
        </div>
      </div>

      <!-- Dịch vụ -->
      <div class="footer-col">
        <h4>Dịch vụ</h4>
        <div class="footer-links">
          <a href="<?php echo esc_url(home_url('/dich-vu-1/')); ?>">Passion to Profit</a>
          <a href="<?php echo esc_url(home_url('/dich-vu-2/')); ?>">Business to Freedom</a>
          <a href="<?php echo esc_url(home_url('/dich-vu-3/')); ?>">Business Mastery</a>
        </div>
      </div>

      <!-- Kết nối -->
      <div class="footer-col">
        <h4>Kết nối</h4>
        <div class="footer-links">
          <?php
          $contact_email = edt_option('contact_email', 'coachtram@gmail.com');
          $contact_phone = edt_option('contact_phone', '0901 234 567');
          ?>
          <a href="<?php echo esc_url(home_url('/lien-he/')); ?>">Liên hệ</a>
          <a href="mailto:<?php echo esc_attr($contact_email); ?>"><?php echo esc_html($contact_email); ?></a>
          <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $contact_phone)); ?>"><?php echo esc_html($contact_phone); ?></a>
        </div>
      </div>

    </div>

    <!-- Footer bottom bar -->
    <div class="footer-bottom">
      <span><?php echo esc_html(edt_option('footer_copyright', '© 2026 Edina Trâm. All rights reserved.')); ?></span>

      <div class="footer-social">
        <?php $fb_url = edt_option('social_facebook'); if ($fb_url) : ?>
          <a href="<?php echo esc_url($fb_url); ?>" aria-label="Facebook" target="_blank" rel="noopener noreferrer">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path></svg>
          </a>
        <?php endif; ?>

        <?php $ig_url = edt_option('social_instagram'); if ($ig_url) : ?>
          <a href="<?php echo esc_url($ig_url); ?>" aria-label="Instagram" target="_blank" rel="noopener noreferrer">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
          </a>
        <?php endif; ?>

        <?php $yt_url = edt_option('social_youtube'); if ($yt_url) : ?>
          <a href="<?php echo esc_url($yt_url); ?>" aria-label="YouTube" target="_blank" rel="noopener noreferrer">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22.54 6.42a2.78 2.78 0 00-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 00-1.94 2A29 29 0 001 11.75a29 29 0 00.46 5.33A2.78 2.78 0 003.4 19.1c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 001.94-2 29 29 0 00.46-5.25 29 29 0 00-.46-5.33z"></path><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon></svg>
          </a>
        <?php endif; ?>
      </div>
    </div>

  </div>
</footer>

<!-- Scroll-to-top -->
<button class="scroll-top-btn" aria-label="Cuộn lên đầu trang">↑</button>

<?php wp_footer(); ?>
</body>
</html>
