<?php
/**
 * Edina Trâm V3 — footer.php
 * Đóng <main>, footer dùng chung (hệ TINA), nút scroll-to-top.
 */
if (!defined('ABSPATH')) exit;
?>
</main>

<!-- ═══ FOOTER ═══ -->
<footer class="site-footer">
  <div class="container">
    <div class="footer-inner">
      <div>
        <div class="footer-logo">Edina <span>Trâm</span></div>
        <p class="footer-tagline">Dẫn lối bình an, khai mở nội lực. Đồng hành cùng bạn trên hành trình kiến tạo cuộc sống chất lượng.</p>
      </div>
      <div class="footer-col">
        <h4>Về Trâm</h4>
        <div class="footer-links">
          <a href="<?php echo esc_url(home_url('/cau-chuyen-cua-toi/')); ?>">Câu chuyện của tôi</a>
          <a href="<?php echo esc_url(home_url('/bai-viet-cua-tram/')); ?>">Bài viết của Trâm</a>
          <a href="<?php echo esc_url(home_url('/lien-he/')); ?>">Kết nối 1:1</a>
        </div>
      </div>
      <div class="footer-col">
        <h4>Dịch vụ</h4>
        <div class="footer-links">
          <a href="<?php echo esc_url(home_url('/dich-vu-1/')); ?>">TINA Awareness</a>
          <a href="<?php echo esc_url(home_url('/dich-vu-2/')); ?>">TINA Awakening</a>
          <a href="<?php echo esc_url(home_url('/dich-vu-3/')); ?>">TINA Alignment</a>
        </div>
      </div>
      <div class="footer-col">
        <h4>Kết nối</h4>
        <div class="footer-links">
          <a href="<?php echo esc_url(home_url('/lien-he/')); ?>">Liên hệ</a>
          <a href="mailto:lequynhtram@gmail.com">lequynhtram@gmail.com</a>
          <a href="tel:+84889590888">(+84) 88-9590-888</a>
          <a href="https://edinatram.vn" target="_blank" rel="noopener">edinatram.vn</a>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© <?php echo esc_html(date('Y')); ?> Edina Trâm. All rights reserved.</span>
      <div class="footer-social">
        <a href="https://www.facebook.com/edina.quynhtram" target="_blank" rel="noopener" aria-label="Facebook"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path></svg></a>
        <a href="mailto:lequynhtram@gmail.com" aria-label="Email"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg></a>
        <a href="https://edinatram.vn" target="_blank" rel="noopener" aria-label="Website"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"></path></svg></a>
      </div>
    </div>
  </div>
</footer>

<button class="scroll-top-btn" aria-label="Cuộn lên đầu trang">↑</button>

<?php wp_footer(); ?>
</body>
</html>
