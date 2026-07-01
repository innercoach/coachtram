<?php
/**
 * Template: Câu chuyện của tôi
 * Port từ static-site/cau-chuyen-cua-toi.html — nội dung theo bản HTML đã chốt.
 * Chrome (header/footer/nav/glow-blobs) do get_header()/get_footer() lo.
 */
if (!defined('ABSPATH')) exit;
get_header();
?>
  <style>
    .story-hero {
      min-height: 92dvh;
      display: flex;
      align-items: center;
      padding-top: var(--header-height);
      background: radial-gradient(ellipse at 15% 55%, rgba(11, 138, 102, .08), transparent 55%), radial-gradient(ellipse at 85% 20%, rgba(200, 162, 68, .06), transparent 50%), var(--color-bg);
      overflow: hidden;
    }

    .story-hero-grid {
      display: grid;
      grid-template-columns: 1.15fr .85fr;
      gap: var(--space-12);
      align-items: center;
    }

    .story-hero h1 {
      font-size: clamp(var(--text-4xl), 6vw, var(--text-7xl));
      line-height: 1.05;
      margin-bottom: var(--space-4);
    }

    .story-hero h1 em {
      color: var(--royal-gold);
    }

    .story-subline {
      font-family: var(--font-heading);
      font-size: clamp(1.5rem, 3vw, 2rem);
      color: var(--color-primary);
      margin: var(--space-3) 0 var(--space-1);
    }

    .story-subline-en {
      font-style: italic;
      color: var(--royal-gold);
      font-size: var(--text-base);
      margin-bottom: var(--space-6);
    }

    .story-portrait img {
      border-radius: var(--radius-lg);
      border: 3px solid var(--pale-gold-sand);
      box-shadow: 0 16px 48px rgba(0, 0, 0, 0.18), 0 6px 16px rgba(1, 79, 61, 0.10);
    }

    .story-section-grid {
      display: grid;
      grid-template-columns: 260px 1fr;
      gap: var(--space-10);
      align-items: start;
    }

    .story-kicker {
      position: sticky;
      top: calc(var(--header-height) + var(--space-6));
    }

    .story-kicker span {
      color: var(--royal-gold);
      font-size: var(--text-xs);
      font-weight: 700;
      letter-spacing: .12em;
      text-transform: uppercase;
    }

    .story-kicker h2 {
      margin-top: var(--space-2);
    }

    .story-copy {
      background: var(--color-surface);
      border: 1px solid var(--color-border-light);
      border-radius: var(--radius-lg);
      padding: var(--space-8);
      box-shadow: var(--shadow-sm);
    }

    .story-copy p+p {
      margin-top: var(--space-4);
    }

    .quote-testimonial {
      margin-top: var(--space-8);
      padding: var(--space-8);
      border-radius: var(--radius-lg);
      border: 1px solid rgba(200, 162, 68, .45);
      background: linear-gradient(155deg, #fff, rgba(241, 216, 154, .16));
    }

    .quote-testimonial blockquote {
      margin: 0;
      font-family: var(--font-heading);
      font-size: clamp(1.4rem, 3vw, 1.85rem);
      font-style: italic;
      line-height: 1.5;
      color: var(--color-fg);
    }

    .quote-testimonial cite {
      display: block;
      margin-top: var(--space-4);
      color: var(--color-fg-muted);
      font-style: normal;
      font-size: var(--text-sm);
    }

    .story-stat-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: var(--space-4);
      margin-top: var(--space-8);
    }

    .story-stat {
      background: var(--color-surface);
      border: 1px solid var(--color-border-light);
      border-radius: var(--radius-lg);
      padding: var(--space-6);
      text-align: center;
      box-shadow: var(--shadow-sm);
    }

    .story-stat strong {
      display: block;
      font-family: var(--font-heading);
      font-size: clamp(2rem, 4vw, 2.75rem);
      color: var(--royal-gold);
      line-height: 1;
      margin-bottom: var(--space-2);
    }

    .story-stat span {
      color: var(--color-fg-muted);
      font-size: var(--text-sm);
      line-height: 1.5;
    }

    .cred-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: var(--space-4);
      margin-top: var(--space-6);
    }

    .cred-item {
      background: rgba(255, 255, 255, .08);
      border: 1px solid rgba(255, 255, 255, .14);
      border-radius: var(--radius-md);
      padding: var(--space-4);
      color: rgba(255, 255, 255, .85);
      font-size: var(--text-sm);
      line-height: 1.6;
    }

    .tina-profile-list {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: var(--space-3);
      margin-top: var(--space-6);
    }

    .tina-profile-list li {
      background: rgba(255,255,255,0.06);
      border: 1px solid rgba(255,255,255,0.12);
      border-radius: var(--radius-md);
      padding: var(--space-4);
      color: rgba(255,255,255,0.86);
      font-size: var(--text-sm);
      line-height: 1.6;
    }

    @media (max-width: 900px) {

      .story-hero-grid,
      .story-section-grid,
      .story-stat-grid,
      .cred-grid {
        grid-template-columns: 1fr;
      }

      .story-kicker {
        position: static;
      }

      .story-portrait {
        order: -1;
        max-width: 420px;
        margin-inline: auto;
      }

      .tina-profile-list {
        grid-template-columns: 1fr;
      }
    }
  </style>
    <section class="story-hero">
      <div class="container story-hero-grid">
        <div data-reveal>
          <span class="badge badge--gold">Câu chuyện của tôi</span>
          <h1>Chân thực.<br>Thấu hiểu.<br><em>Truyền cảm hứng.</em></h1>
          <div class="story-subline">Chân thực - Thấu hiểu - Truyền cảm hứng</div>
          <p class="story-subline-en">Authenticity - Compassionate - Inspiration</p>
          <p>Trâm không đến với công việc này từ một lý thuyết đẹp đẽ. Tôi đến từ chính những lần cuộc đời buộc mình
            phải dừng lại, tan ra, nhìn sâu và học cách đứng dậy một lần nữa.</p>
        </div>
        <div class="story-portrait" data-reveal="right">
          <img src="<?php echo edt_asset('images/hero_trang_cau_chuyen.jpg'); ?>" alt="Edina Trâm" loading="eager" width="1707" height="2560">
        </div>
      </div>
    </section>

    <section id="story" class="section">
      <div class="container story-section-grid">
        <div class="story-kicker" data-reveal>
          <span>Story</span>
          <h2>Tôi từng đứng đúng nơi bạn đang đứng</h2>
        </div>
        <div class="story-copy" data-reveal>
          <p>Từ một người thành công theo mọi chuẩn mực xã hội, tôi đi qua hai lần phá sản, một cuộc hôn nhân đổ vỡ, ba
            năm suy sụp cả thể chất lẫn tinh thần và cảm giác mất kết nối hoàn toàn với chính cuộc đời mình.</p>
          <p>Ở đáy sâu ấy, tôi bắt đầu hiểu rằng chuyển hoá không phải là một khẩu hiệu. Đó là một quá trình rất thật,
            rất người, nhiều lúc không ồn ào nhưng chạm đến tận nền tảng sống bên trong.</p>
          <p>Tôi không giỏi hơn bạn. Tôi chỉ vấp ngã trước bạn. Và chính những vấp ngã ấy cho tôi sự mềm lại, lòng trắc
            ẩn và khả năng nhận ra những nỗi đau mà người khác thường giấu rất kỹ.</p>
        </div>
      </div>
    </section>

    <section class="section section--alt">
      <div class="container story-section-grid">
        <div class="story-kicker" data-reveal>
          <span>Solution</span>
          <h2>Tôi học cách dựng lại đời sống từ bên trong</h2>
        </div>
        <div class="story-copy" data-reveal>
          <p>Sau gần 5 năm gần như ẩn tu khỏi cuộc đời, tôi từng bước dựng lại đời sống tài chính vững vàng, sống Đời và
            Đạo song hành, và biến tất cả những gì mình đi qua thành một sứ mệnh phụng sự.</p>
          <p>Tôi học cách đứng trên vai người khổng lồ: đầu tư đúng vào người thầy, người khai vấn, người dẫn dắt, để
            vực dậy nhanh hơn và tránh tổn hao nhiều công sức.</p>
          <p>Đó là lý do tôi làm việc tại giao điểm của Tâm lý học, Khai vấn, Tâm linh và Tài chính. Tôi không chỉ muốn
            giúp bạn dễ chịu hơn trong vài tuần, mà muốn đồng hành để bạn thoát khỏi vòng lặp khiến mình cứ quay lại bế
            tắc cũ.</p>
          <div class="quote-testimonial">
            <blockquote>Điều thú vị ở Edina Trâm không nằm ở một vài tấm bằng, mà ở chỗ rất ít người hội tụ cả bốn thế
              giới: Tâm lý học, Khai vấn, Tâm linh và Tài chính cùng một lúc.</blockquote>
            <cite>chị Mai Hương - Giám đốc Chiến lược khách hàng, cty TNT</cite>
          </div>
        </div>
      </div>
    </section>

    <?php edt_section('instructor'); ?>

    <!-- ═══ KẾT NỐI ĐA KÊNH ═══ -->
    <section class="section">
      <div class="container">

        <div class="section-header" data-reveal>
          <span class="badge">Kết nối đa kênh</span>
          <h2>Đi cùng Edina trên mọi nền tảng</h2>
          <div class="divider"></div>
        </div>

        <div class="eco-grid" data-reveal-stagger>

          <!-- Facebook -->
          <div class="eco-card">
            <div class="eco-icon">
              <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z" />
              </svg>
            </div>
            <h3>Facebook</h3>
            <p>Cộng đồng chia sẻ kiến thức, cảm hứng và kết nối hàng ngày cùng hàng nghìn người trên hành trình chuyển
              hoá.</p>
          </div>

          <!-- YouTube -->
          <div class="eco-card">
            <div class="eco-icon">
              <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path
                  d="M22.54 6.42a2.78 2.78 0 00-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 00-1.94 2A29 29 0 001 11.75a29 29 0 00.46 5.33A2.78 2.78 0 003.4 19.1c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 001.94-2 29 29 0 00.46-5.25 29 29 0 00-.46-5.33z" />
                <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" />
              </svg>
            </div>
            <h3>YouTube</h3>
            <p>Video chia sẻ chuyên sâu về coaching, mindfulness và phát triển bản thân trên hành trình chuyển hoá.</p>
          </div>

          <!-- Newsletter -->
          <div class="eco-card">
            <div class="eco-icon">
              <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                <polyline points="22,6 12,13 2,6" />
              </svg>
            </div>
            <h3>Newsletter</h3>
            <p>Nhận bài viết chuyên sâu, tài nguyên miễn phí và cập nhật mới nhất mỗi tuần qua email.</p>
          </div>

          <!-- Edina Workspace -->
          <div class="eco-card">
            <div class="eco-icon">
              <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <rect x="2" y="3" width="20" height="14" rx="2" ry="2" />
                <line x1="8" y1="21" x2="16" y2="21" />
                <line x1="12" y1="17" x2="12" y2="21" />
              </svg>
            </div>
            <h3>Edina Workspace</h3>
            <p>Không gian làm việc và học tập trực tuyến dành riêng cho cộng đồng học viên Edina Trâm.</p>
          </div>

        </div>
      </div>
    </section>
  

<?php get_footer();
