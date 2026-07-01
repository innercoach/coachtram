<?php
/**
 * Template: TINA Awakening
 * Port từ static-site/dich-vu-2.html — nội dung theo bản HTML đã chốt.
 * Chrome (header/footer/nav/glow-blobs) do get_header()/get_footer() lo.
 */
if (!defined('ABSPATH')) exit;
get_header();
?>
  <!-- ═══ STICKY CTA BAR ═══ -->
  <div class="sticky-cta" role="banner" aria-label="Đăng ký nhanh">
    <div class="sticky-cta-dot"></div>
    <div class="sticky-cta-info">
      <span class="sticky-cta-title">TINA Awakening - 90 ngày chuyển hoá</span>
      <span class="sticky-cta-meta">Coaching &amp; Mentoring 1:1 · 12 module</span>
    </div>
    <a href="https://calendly.com/edinatram/phien-kham-pha" target="_blank" rel="noopener" class="btn btn--accent">Đặt lịch phiên khám phá</a>
  </div>

  <style>
    :root {
      --page-accent: #005B45;
      --page-accent-rgb: 0, 91, 69;
    }

    body { padding-bottom: 80px; }

    .tina-hero-card {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: var(--space-3);
      max-width: 560px;
      margin-bottom: var(--space-6);
    }

    .tina-hero-stat {
      background: var(--color-bg-alt);
      border: 1px solid var(--color-border-light);
      border-radius: var(--radius-md);
      padding: var(--space-4);
    }

    .tina-hero-stat span {
      display: block;
      font-size: var(--text-xs);
      text-transform: uppercase;
      letter-spacing: 0.08em;
      color: var(--color-fg-muted);
      margin-bottom: var(--space-1);
    }

    .tina-hero-stat strong {
      display: block;
      font-size: var(--text-sm);
      color: var(--color-fg);
      line-height: 1.45;
    }

    .tina-visual {
      background: #fff;
      border: 1px solid var(--color-border-light);
      border-radius: var(--radius-lg);
      padding: var(--space-6);
      box-shadow: var(--shadow-lg);
    }

    .tina-visual img {
      width: 100%;
      max-height: 540px;
      object-fit: contain;
      mask-image: none;
      -webkit-mask-image: none;
    }

    .tina-quote {
      border-left: 4px solid var(--royal-gold);
      background: rgba(200, 162, 68, 0.08);
      border-radius: 0 var(--radius-md) var(--radius-md) 0;
      padding: var(--space-5) var(--space-6);
      margin-block: var(--space-6);
    }

    .tina-quote p {
      color: var(--color-fg);
      font-family: var(--font-heading);
      font-size: clamp(var(--text-xl), 2.4vw, var(--text-2xl));
      font-weight: 500;
      font-style: italic;
      line-height: 1.55;
      margin: 0;
    }

    /* ── Premium câu-chốt callout (editorial declaration) ── */
    .tina-callout {
      position: relative;
      max-width: 880px;
      margin: var(--space-8) auto 0;
      padding: var(--space-8) var(--space-8) calc(var(--space-8) + 4px);
      text-align: center;
      background:
        radial-gradient(120% 140% at 50% 0%, rgba(200, 162, 68, 0.12), transparent 60%),
        linear-gradient(180deg, #fbf8f1, #ffffff);
      border: 1px solid rgba(200, 162, 68, 0.40);
      border-radius: var(--radius-lg);
      box-shadow: var(--shadow-lg);
      overflow: hidden;
    }

    .tina-callout::before {
      content: "\201C";
      position: absolute;
      top: -0.18em;
      left: 50%;
      transform: translateX(-50%);
      font-family: var(--font-heading);
      font-size: 5rem;
      line-height: 1;
      color: var(--royal-gold);
      opacity: 0.28;
      pointer-events: none;
    }

    .tina-callout p {
      position: relative;
      margin: 0;
      font-family: var(--font-heading);
      font-size: clamp(var(--text-2xl), 3.2vw, var(--text-3xl));
      font-weight: 600;
      line-height: 1.45;
      color: var(--color-fg);
    }

    /* Strongest declaration — emerald surface */
    .tina-callout--emerald {
      background:
        radial-gradient(120% 140% at 50% 0%, rgba(241, 216, 154, 0.18), transparent 60%),
        linear-gradient(155deg, #06513c, #00372a);
      border-color: rgba(200, 162, 68, 0.5);
    }
    .tina-callout--emerald::before { color: var(--champagne-glow); opacity: 0.35; }
    .tina-callout--emerald p { color: #ffffff; }

    /* Strong declaration — filled champagne gold (warm alternative to emerald) */
    .tina-callout--gold {
      background:
        radial-gradient(120% 140% at 50% 0%, rgba(255, 255, 255, 0.55), transparent 62%),
        linear-gradient(155deg, #ecd28d, #c8a244);
      border-color: rgba(0, 55, 42, 0.28);
    }
    .tina-callout--gold::before { color: #00372a; opacity: 0.22; }
    .tina-callout--gold p { color: #0b1f19; }

    /* Lead line above the 3-tầng list */
    .method-lead {
      font-family: var(--font-heading);
      font-size: var(--text-lg);
      font-weight: 600;
      font-style: italic;
      color: var(--page-accent);
      margin-bottom: var(--space-4);
    }

    .tina-copy {
      max-width: 820px;
      margin-inline: auto;
    }

    .tina-copy p + p { margin-top: var(--space-4); }

    .pain-num {
      color: rgba(var(--page-accent-rgb), 0.18);
      font-weight: 600;
    }

    .tina-sign-grid {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: var(--space-4);
    }

    .tina-sign-card {
      background: var(--color-surface);
      border: 1px solid var(--color-border);
      border-radius: var(--radius-lg);
      padding: var(--space-6);
      text-align: left;
    }

    .tina-sign-card h3 {
      font-family: var(--font-body);
      font-size: var(--text-base);
      font-weight: 700;
      color: var(--page-accent);
      margin-bottom: var(--space-2);
    }

    .tina-sign-card p {
      font-size: var(--text-sm);
      line-height: 1.7;
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

    .tina-stage {
      background: var(--color-surface);
      border: 1px solid var(--color-border);
      border-radius: var(--radius-lg);
      padding: var(--space-8);
      margin-bottom: var(--space-6);
      text-align: left;
    }

    .tina-stage-title {
      display: flex;
      flex-wrap: wrap;
      gap: var(--space-3);
      align-items: center;
      margin-bottom: var(--space-5);
    }

    .tina-stage-title span {
      color: var(--royal-gold);
      font-size: var(--text-xs);
      text-transform: uppercase;
      letter-spacing: 0.08em;
      font-weight: 700;
    }

    .tina-stage-title h3 {
      font-family: var(--font-body);
      color: var(--page-accent);
      font-size: var(--text-lg);
      font-weight: 700;
      margin: 0;
    }

    .tina-module-grid {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: var(--space-4);
    }

    .tina-module {
      border-left: 3px solid var(--royal-gold);
      padding-left: var(--space-4);
    }

    .tina-module strong {
      display: block;
      color: var(--color-fg);
      margin-bottom: var(--space-1);
      font-size: var(--text-sm);
    }

    .tina-module p {
      font-size: var(--text-sm);
      line-height: 1.65;
    }

    .offer-grid {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: var(--space-6);
      align-items: stretch;
      margin-top: var(--space-8);
    }

    .offer-card {
      background: var(--color-surface);
      border: 1px solid var(--color-border);
      border-radius: var(--radius-lg);
      padding: var(--space-8);
      text-align: left;
      border-top: 4px solid var(--page-accent);
    }

    .offer-card--featured {
      border-top-color: var(--royal-gold);
      box-shadow: var(--shadow-gold);
    }

    .offer-label {
      color: var(--royal-gold);
      font-size: var(--text-xs);
      text-transform: uppercase;
      letter-spacing: 0.08em;
      font-weight: 700;
      margin-bottom: var(--space-3);
    }

    .offer-card h3 {
      font-family: var(--font-body);
      font-size: var(--text-lg);
      font-weight: 700;
      color: var(--page-accent);
      margin-bottom: var(--space-3);
    }

    .offer-card p {
      font-size: var(--text-sm);
      line-height: 1.7;
    }

    /* Funnel offer (single path) */
    .offer-single { max-width: 640px; margin-inline: auto; text-align: center; }
    .offer-price {
      font-family: var(--font-heading);
      font-size: clamp(var(--text-3xl), 5vw, var(--text-5xl));
      font-weight: 600; color: var(--page-accent);
      margin: var(--space-2) 0 var(--space-3); line-height: 1;
    }
    .offer-price small { display:block; font-family: var(--font-body); font-size: var(--text-xs); letter-spacing:.1em; text-transform:uppercase; color: var(--color-fg-muted); margin-bottom: var(--space-2); }
    .offer-anchor {
      display:flex; flex-direction:column; gap:4px; align-items:center;
      margin: var(--space-6) auto var(--space-5); padding: var(--space-5) var(--space-6);
      border-radius: var(--radius-lg); max-width: 460px;
      background: linear-gradient(135deg, rgba(200,162,68,0.12), rgba(246,225,162,0.05));
      border: 1px solid rgba(200,162,68,0.35);
    }
    .offer-anchor-label { font-size: var(--text-sm); color: var(--color-fg-muted); }
    .offer-anchor-price { font-family: var(--font-heading); font-size: var(--text-2xl); }
    .offer-anchor-price s { color: var(--color-fg-subtle); margin-right:10px; font-size: var(--text-lg); }
    .offer-anchor-price strong { color: var(--page-accent); text-transform:uppercase; letter-spacing:.05em; }
    .offer-note { font-size: var(--text-sm); color: var(--color-fg-muted); margin-top: var(--space-5); }

    .value-num {
      color: rgba(var(--page-accent-rgb), 0.12);
      z-index: 0;
      pointer-events: none;
    }

    .value-card h3,
    .value-card p {
      position: relative;
      z-index: 1;
    }

    .contact-line {
      display: flex;
      flex-wrap: wrap;
      gap: var(--space-4);
      justify-content: center;
      margin-top: var(--space-6);
      color: rgba(255,255,255,0.72);
      font-size: var(--text-sm);
    }

    @media (max-width: 992px) {
      .tina-hero-card,
      .tina-sign-grid,
      .tina-profile-list,
      .tina-module-grid,
      .offer-grid {
        grid-template-columns: 1fr;
      }

      .tina-hero-card { margin-inline: auto; }
      .tina-visual { max-width: 520px; margin-inline: auto; }
    }

    @media (max-width: 600px) {
      .tina-hero-stat,
      .tina-sign-card,
      .offer-card,
      .tina-stage {
        padding: var(--space-5);
      }
    }
    /* ── Signature triangle section — two-column layout ── */
    .tina-layout {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: var(--space-10, 3rem);
      align-items: center;
      margin-top: var(--space-8, 2rem);
    }

    .triangle-visual {
      text-align: center;
    }

    .triangle-visual svg {
      max-width: 560px;
      width: 100%;
      height: auto;
      margin-inline: auto;
      filter: drop-shadow(0 18px 40px rgba(1, 79, 61, 0.16));
    }

    .tina-cards {
      display: flex;
      flex-direction: column;
      gap: var(--space-5, 1.25rem);
    }

    .tina-card {
      position: relative;
      overflow: hidden;
      background: var(--color-surface, #fff);
      border: 1px solid var(--color-border-light, #ece6d8);
      border-radius: var(--radius-lg, 1.25rem);
      padding: var(--space-7, 1.75rem) var(--space-8, 2rem);
      text-align: left;
      box-shadow: var(--shadow-sm, 0 2px 10px rgba(1, 79, 61, 0.05));
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .tina-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 28px rgba(1, 79, 61, 0.1);
    }

    .tina-card::after {
      content: 'C';
      position: absolute;
      top: 50%;
      right: var(--space-6, 1.5rem);
      transform: translateY(-50%);
      font-family: var(--font-heading, 'Cormorant Garamond', Georgia, serif);
      font-size: 5rem;
      font-weight: 700;
      line-height: 1;
      color: var(--color-primary, #005B45);
      opacity: 0.06;
      pointer-events: none;
    }

    .tina-card h3 {
      font-family: var(--font-body, 'Be Vietnam Pro', sans-serif);
      font-size: 1rem;
      font-weight: 700;
      color: var(--color-primary, #005B45);
      margin: 0 0 var(--space-2, 0.5rem);
      letter-spacing: 0.01em;
    }

    .tina-card h3 span {
      font-weight: 400;
      color: var(--color-fg, #0b1f19);
    }

    .tina-card p {
      font-size: 0.9rem;
      line-height: 1.7;
      color: var(--color-fg-muted, #4A5B54);
      margin: 0;
      position: relative;
    }

    @media (max-width: 960px) {
      .tina-layout {
        grid-template-columns: 1fr;
      }

      .triangle-visual svg {
        max-width: 480px;
      }
    }
    /* ── Outcome section — 2/3 content + 1/3 image ── */
    .outcome-layout {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: var(--space-8, 2rem);
      align-items: start;
      margin-top: var(--space-8, 2rem);
    }

    .outcome-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: var(--radius-lg, 1.25rem);
      border: 3px solid var(--pale-gold-sand, #F5ECD7);
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
    }

    @media (max-width: 860px) {
      .outcome-layout {
        grid-template-columns: 1fr;
      }

      .outcome-img {
        order: -1;
        max-width: 400px;
        margin-inline: auto;
      }
    }
  </style>
    <!-- ═══ S1: HERO ═══ -->
    <section class="srv-hero" aria-label="Giới thiệu chương trình TINA Awakening">
      <div class="container srv-hero-grid">
        <div class="srv-hero-content">
          <span class="badge" style="margin-bottom: var(--space-4); display: inline-block;">COACHING & MENTORING 1:1</span>
          <h1>90 NGÀY<br>CHUYỂN HOÁ<br><span>TINA AWAKENING</span></h1>
          <p class="srv-hero-tagline">T.I.N.A - Transformation Into New Awareness</p>
          <p class="srv-hero-desc">Một hành trình 12 module dành cho những ai đang đi tìm một hướng đi mới cho cuộc đời mình: rõ hơn, vững hơn, và kết nối sâu hơn với chính bản thân.</p>

          <div class="tina-hero-card">
            <div class="tina-hero-stat">
              <span>Thời lượng</span>
              <strong>90 ngày đồng hành</strong>
            </div>
            <div class="tina-hero-stat">
              <span>Lộ trình</span>
              <strong>12 module 1:1</strong>
            </div>
            <div class="tina-hero-stat">
              <span>Trụ cột</span>
              <strong>Clarity · Confidence · Connection</strong>
            </div>
          </div>

          <a href="https://calendly.com/edinatram/phien-kham-pha" target="_blank" rel="noopener" class="btn btn--accent btn--lg">Đặt lịch phiên khám phá</a>
        </div>
        <div class="srv-hero-img" data-reveal="right">
          <img src="<?php echo edt_asset('images/hero_trang_tina_awakening.jpg'); ?>" alt="Edina Trâm - TINA Awakening" loading="eager" fetchpriority="high" width="1707" height="2560">
        </div>
      </div>
    </section>

    <!-- ═══ S2: OPEN LETTER ═══ -->
    <section class="srv-section--alt" aria-label="Thư ngỏ từ Edina Trâm">
      <div class="container container--narrow">
        <div class="section-header">
          <span class="badge">Thư ngỏ</span>
          <h2 style="margin-top: var(--space-4);">Cảm ơn bạn đã có mặt ở đây</h2>
          <div class="divider"></div>
        </div>
        <div class="tina-copy" data-reveal>
          <p>Tôi không biết điều gì đã đưa bạn đến trang này - một đêm trằn trọc, một câu hỏi chưa có lời đáp, hay một khao khát thay đổi mà bạn còn chưa gọi thành tên. Nhưng tôi tin chắc một điều: bạn đang tìm kiếm điều gì đó lớn hơn hiện tại của mình. Một sự chuyển mình thật sự.</p>
          <p>Và nếu bạn đã đọc đến đây, tôi tin bạn không chỉ muốn "dễ chịu hơn một chút". Bạn muốn kiến tạo một cuộc sống mới.</p>
          <div class="tina-quote">
            <p>Không có gì là ngẫu nhiên. Việc bạn dừng lại ở đây, đọc đến tận dòng này, đã là một nhân duyên đẹp.</p>
          </div>
          <p>Trâm xin được đón bạn bằng tất cả sự trân trọng. Tôi từng đứng đúng nơi bạn đang đứng, mang đúng những trăn trở bạn mang lúc này. Nên tôi hiểu - và tôi biết ơn vì bạn đã cho chúng ta cơ hội được kết nối.</p>
          <p>Điều tôi mong mỏi là được trao lại phước lành mà chính Trâm đã may mắn nhận được trên hành trình của mình: sự hàn gắn và sáng tỏ cho những ai đang đi trong bóng tối mà vẫn khát khao một tia sáng ở cuối đường hầm.</p>
        </div>
      </div>
    </section>

    <!-- ═══ S3: WHY THIS JOURNEY ═══ -->
    <section class="srv-section" aria-label="Lý do tạo ra hành trình TINA">
      <div class="container">
        <div class="section-header">
          <span class="badge">Vì sao hành trình này ra đời?</span>
          <h2 style="margin-top: var(--space-4);">Khi bế tắc cũ cứ quay lại</h2>
          <div class="divider"></div>
          <p>Trước khi đọc tiếp, hãy dừng lại một nhịp và tự hỏi: vì sao mình cứ quay lại đúng chỗ bế tắc cũ dù đã cố gắng, đã trị liệu, đã chữa lành, đã đọc bao nhiêu sách?</p>
        </div>
        <div class="pain-grid" data-reveal-stagger>
          <div class="pain-card" data-reveal>
            <div class="pain-num">01</div>
            <h3>Thành công nhưng mất kết nối</h3>
            <p>Từ một người thành công theo chuẩn mực xã hội, Trâm đã đi qua hai lần phá sản, một cuộc hôn nhân đổ vỡ và ba năm suy sụp cả thể chất lẫn tinh thần.</p>
          </div>
          <div class="pain-card" data-reveal>
            <div class="pain-num">02</div>
            <h3>Làm lại từ con số không</h3>
            <p>Ở đáy sâu ấy, một sự thức tỉnh bắt đầu. Trâm từng bước dựng lại đời sống tài chính, sống Đời và Đạo song hành, rồi biến trải nghiệm ấy thành sứ mệnh phụng sự.</p>
          </div>
          <div class="pain-card" data-reveal>
            <div class="pain-num">03</div>
            <h3>Không tự mò mẫm mãi</h3>
            <p>Trâm học cách đứng trên vai người khổng lồ: đầu tư đúng vào người thầy, người khai vấn, người dẫn dắt để vực dậy nhanh hơn và tránh tổn hao nhiều công sức.</p>
          </div>
          <div class="pain-card" data-reveal>
            <div class="pain-num">04</div>
            <h3>Trở thành người đồng hành</h3>
            <p>TINA Awakening ra đời để trở thành người đồng hành mà chính Trâm từng ao ước có được trong những ngày tăm tối nhất.</p>
          </div>
        </div>
        <div class="tina-quote" style="max-width: 860px; margin-inline: auto;">
          <p>Tôi không giỏi hơn bạn. Tôi chỉ vấp ngã trước bạn.</p>
        </div>
        <div class="tina-callout tina-callout--emerald" data-reveal>
          <p>Tôi không chỉ truyền đạt lý thuyết chuyển hoá. Tôi đã đi qua đúng con đường mà bạn đang đi.</p>
        </div>
      </div>
    </section>

    <!-- ═══ S4: WHY CRISIS RETURNS ═══ -->
    <section class="srv-section bg-sacred-pattern" aria-label="Vì sao khủng hoảng cứ quay lại">
      <div class="container">
        <div class="section-header">
          <span class="badge badge--gold">Gốc rễ chuyển hoá</span>
          <h2 style="margin-top: var(--space-4);">Khủng hoảng quay lại không phải vì bạn yếu</h2>
          <div class="divider"></div>
          <p>Phần lớn giải pháp chỉ chữa phần ngọn: coaching ngắn hạn, trị liệu tách rời đời sống thật, chữa lành dừng ở cảm xúc.</p>
        </div>
        <div class="method-layout">
          <div class="method-col method-col--negative" data-reveal>
            <h3>Khi chỉ xử lý phần ngọn</h3>
            <ul class="method-list">
              <li><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#b32d2e" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg><span>Bạn thấy nhẹ đi một thời gian, rồi mọi thứ lặng lẽ trở về như cũ.</span></li>
              <li><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#b32d2e" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg><span>Bạn cảm thấy mình chưa đủ cố gắng, chưa đủ kỷ luật, chưa đủ tốt.</span></li>
              <li><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#b32d2e" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg><span>Bạn học thêm rất nhiều nhưng vẫn không thoát khỏi vòng lặp cũ.</span></li>
            </ul>
          </div>
          <div class="method-col method-col--positive" data-reveal>
            <h3>TINA làm việc ở tầng sâu hơn</h3>
            <p class="method-lead">Chuyển hoá chỉ bền vững khi ba tầng cùng thay đổi.</p>
            <ul class="method-list">
              <li><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--page-accent)" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg><span>Nhận thức được khai mở để bạn thật sự thấy rõ mình đang sống từ đâu.</span></li>
              <li><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--page-accent)" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg><span>Hành vi được làm mới bằng công cụ thực hành, không chỉ bằng cảm hứng.</span></li>
              <li><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--page-accent)" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg><span>Nghiệp lực và nhân cách sống được soi chiếu để chuyển hoá bền vững cả Đời lẫn Đạo.</span></li>
            </ul>
          </div>
        </div>
        <div class="tina-callout tina-callout--gold" data-reveal>
          <p>Khủng hoảng quay lại vì tiềm thức — nền tảng sống bên trong bạn — chưa được tái cấu trúc. Tôi không chỉ giúp bạn ổn hơn. Tôi giúp bạn thoát khỏi vòng lặp khiến bạn cứ quay lại bế tắc cũ.</p>
        </div>
      </div>
    </section>

    <!-- ═══ S6: TARGET AUDIENCE ═══ -->
    <section class="srv-section" aria-label="Chương trình dành cho ai">
      <div class="container">
        <div class="section-header">
          <span class="badge badge--gold">Dành cho bạn</span>
          <h2 style="margin-top: var(--space-4);">TINA Awakening dành cho bạn nếu</h2>
          <div class="divider"></div>
        </div>
        <div class="target-grid" data-reveal-stagger>
          <div class="target-card" data-reveal>
            <div class="target-num">01</div>
            <h3 style="font-family: var(--font-body); font-size: var(--text-base); font-weight: 700; margin-bottom: var(--space-2);">ĐANG CHUYỂN MÌNH</h3>
            <p>Bạn đang mất phương hướng, mất kết nối, hoặc mất niềm tin vào chính mình trong một giai đoạn quan trọng của đời sống.</p>
          </div>
          <div class="target-card" data-reveal>
            <div class="target-num">02</div>
            <h3 style="font-family: var(--font-body); font-size: var(--text-base); font-weight: 700; margin-bottom: var(--space-2);">ĐÃ THỬ NHIỀU CÁCH</h3>
            <p>Bạn từng coaching, trị liệu hoặc chữa lành, nhưng cảm giác bình an không bền và bạn cứ quay lại điểm cũ.</p>
          </div>
          <div class="target-card" data-reveal>
            <div class="target-num">03</div>
            <h3 style="font-family: var(--font-body); font-size: var(--text-base); font-weight: 700; margin-bottom: var(--space-2);">SẴN SÀNG NHÌN SÂU</h3>
            <p>Bạn khao khát hiểu sâu chính mình và sẵn sàng nhìn thẳng vào những điều khó chấp nhận, thay vì tìm một viên thuốc thần kỳ.</p>
          </div>
        </div>
        <div class="tina-quote" style="max-width: 860px; margin-inline: auto;">
          <p>Chương trình này chưa dành cho bạn nếu bạn đang tìm một con đường tắt, một lời trấn an nhanh, hoặc mong người khác thay đổi cuộc đời giùm mình.</p>
        </div>
      </div>
    </section>

    <!-- ═══ S6b: WHAT MAKES IT DIFFERENT ═══ -->
    <section class="srv-section--alt" aria-label="Điều gì khiến 90 ngày với TINA Awakening trở nên khác biệt">
      <div class="container">
        <div class="section-header">
          <span class="badge badge--gold">Vì sao chọn TINA Awakening</span>
          <h2 style="margin-top: var(--space-4);">Điều gì khiến 90 ngày với TINA Awakening trở nên khác biệt?</h2>
          <div class="divider"></div>
          <p>Không phải một khoá học đại trà, mà là một hành trình được may đo cho riêng bạn — bởi một người đồng hành hội tụ cả bốn thế giới và đã đi qua chính con đường ấy.</p>
        </div>
        <div class="tina-sign-grid" data-reveal-stagger>
          <div class="tina-sign-card" data-reveal><h3>Hành trình 1:1, may đo riêng cho bạn</h3><p>Không phải một khoá học đại trà. Mỗi buổi xoay quanh đúng câu chuyện, đúng nỗi đau, đúng nhịp của riêng bạn.</p></div>
          <div class="tina-sign-card" data-reveal><h3>Bốn thế giới trong một người đồng hành</h3><p>Tâm lý học, Khai vấn, Tâm linh và Tài chính kết hợp nhuần nhuyễn — để bạn được chữa lành mà vẫn vững vàng giữa đời thật.</p></div>
          <div class="tina-sign-card" data-reveal><h3>Một không gian an toàn, kiên nhẫn và không phán xét</h3><p>Nơi bạn được phép mong manh, được phép thật, để buông những gì đã mang theo quá lâu.</p></div>
          <div class="tina-sign-card" data-reveal><h3>Không chỉ thấu hiểu, mà có công cụ</h3><p>Bạn rời mỗi buổi với một bộ công cụ thực hành để tự ra quyết định, tự làm dịu mình và tự đứng vững khi sóng gió quay lại.</p></div>
          <div class="tina-sign-card" data-reveal><h3>Người đồng hành đã đi qua chính con đường ấy</h3><p>Tôi không nói với bạn từ trên bục giảng, mà từ chính những vết sẹo đã lành của đời mình.</p></div>
        </div>
      </div>
    </section>

    <!-- ═══ S7: BENEFITS / 3C ═══ -->
    <section class="section section--alt bg-sacred-pattern bg-tram-1" aria-label="Tam giác chuyển hoá 3C">
      <div class="container">
        <div class="section-header">
          <span class="badge badge--gold">Tam giác chuyển hoá 3C</span>
          <h2 style="margin-top: var(--space-4);">Clarity · Confidence · Connection</h2>
          <div class="divider"></div>
          <p>Transformation · Into · New · Awareness</p>
        </div>
        <div class="tina-layout" data-reveal>
          <!-- Left column: Triangle visual -->
          <div class="triangle-visual">
            <svg viewBox="0 0 680 640" role="img"
              aria-label="Biểu đồ tam giác chuyển hoá T.I.N.A — Clarity, Confidence, Connection"
              xmlns="http://www.w3.org/2000/svg">
              <defs>
                <linearGradient id="goldMetal" x1="0" y1="0" x2="1" y2="1">
                  <stop offset="0%" stop-color="#8A6A28" />
                  <stop offset="24%" stop-color="#C8A244" />
                  <stop offset="50%" stop-color="#F6E1A2" />
                  <stop offset="63%" stop-color="#DCB95C" />
                  <stop offset="80%" stop-color="#C8A244" />
                  <stop offset="100%" stop-color="#8A6A28" />
                </linearGradient>
                <radialGradient id="emeraldGlow" cx="50%" cy="50%" r="50%">
                  <stop offset="0%" stop-color="#0B8A66" stop-opacity="0.20" />
                  <stop offset="55%" stop-color="#005B45" stop-opacity="0.06" />
                  <stop offset="100%" stop-color="#005B45" stop-opacity="0" />
                </radialGradient>
              </defs>

              <circle cx="340" cy="360" r="232" fill="url(#emeraldGlow)" />
              <circle cx="340" cy="360" r="250" fill="none" stroke="#C8A244" stroke-opacity="0.22" stroke-width="1" />
              <circle cx="340" cy="360" r="250" fill="none" stroke="#C8A244" stroke-opacity="0.30" stroke-width="1"
                stroke-dasharray="2 12" />

              <!-- Triangle -->
              <path d="M340 190 L510 452 L170 452 Z" fill="#005B45" fill-opacity="0.05" stroke="url(#goldMetal)"
                stroke-width="2.5" stroke-linejoin="round" />

              <!-- Vertex nodes -->
              <circle cx="340" cy="190" r="6" fill="url(#goldMetal)" />
              <circle cx="170" cy="452" r="6" fill="url(#goldMetal)" />
              <circle cx="510" cy="452" r="6" fill="url(#goldMetal)" />

              <!-- Center wordmark -->
              <text x="340" y="345" text-anchor="middle" font-family="'Cormorant Garamond', Georgia, serif" font-size="48"
                font-weight="600" letter-spacing="4" fill="url(#goldMetal)">T.I.N.A<tspan font-size="16" dy="-20"
                  letter-spacing="0" fill="#C8A244">™</tspan></text>
              <text x="340" y="380" text-anchor="middle" font-family="'Be Vietnam Pro', sans-serif" font-size="11.5"
                letter-spacing="2" fill="#F1D89A" fill-opacity="0.78">TRANSFORMATION INTO NEW AWARENESS</text>

              <!-- Vertex label: Clarity (top) -->
              <text x="340" y="60" text-anchor="middle" font-family="'Be Vietnam Pro', sans-serif" font-size="14"
                font-weight="700" letter-spacing="2.5" fill="#E2C36C">CLARITY</text>
              <text x="340" y="84" text-anchor="middle" font-family="'Cormorant Garamond', Georgia, serif" font-size="19"
                font-style="italic" fill="#F1D89A">Sự thông suốt</text>
              <text x="340" y="106" text-anchor="middle" font-family="'Be Vietnam Pro', sans-serif" font-size="12"
                fill="rgba(255,255,255,0.74)">Thấy rõ hướng đi của chính mình</text>

              <!-- Vertex label: Confidence (bottom-left) -->
              <text x="170" y="502" text-anchor="middle" font-family="'Be Vietnam Pro', sans-serif" font-size="14"
                font-weight="700" letter-spacing="2.5" fill="#E2C36C">CONFIDENCE</text>
              <text x="170" y="526" text-anchor="middle" font-family="'Cormorant Garamond', Georgia, serif" font-size="19"
                font-style="italic" fill="#F1D89A">Tự tin làm chủ</text>
              <text x="170" y="548" text-anchor="middle" font-family="'Be Vietnam Pro', sans-serif" font-size="12"
                fill="rgba(255,255,255,0.74)">Vững vàng từ bên trong</text>

              <!-- Vertex label: Connection (bottom-right) -->
              <text x="510" y="502" text-anchor="middle" font-family="'Be Vietnam Pro', sans-serif" font-size="14"
                font-weight="700" letter-spacing="2.5" fill="#E2C36C">CONNECTION</text>
              <text x="510" y="526" text-anchor="middle" font-family="'Cormorant Garamond', Georgia, serif" font-size="19"
                font-style="italic" fill="#F1D89A">Khơi dậy kết nối</text>
              <text x="510" y="548" text-anchor="middle" font-family="'Be Vietnam Pro', sans-serif" font-size="12"
                fill="rgba(255,255,255,0.74)">Kết nối lại với chính mình</text>
            </svg>
          </div>

          <!-- Right column: 3C description cards -->
          <div class="tina-cards">
            <div class="tina-card">
              <h3>CLARITY – <span>Sự thông suốt</span></h3>
              <p>Một lộ trình rõ ràng giúp chữa lành nỗi đau mất phương hướng, để bạn biết mình đang ở đâu và thật sự muốn đi đâu.</p>
            </div>
            <div class="tina-card">
              <h3>CONFIDENCE – <span>Tự tin làm chủ</span></h3>
              <p>Phục hồi năng lực ra quyết định và sự vững vàng nội tâm, chữa lành sự mất mát niềm tin vào chính mình.</p>
            </div>
            <div class="tina-card">
              <h3>CONNECTION – <span>Khơi dậy kết nối</span></h3>
              <p>Kết nối lại với bản thân và người thân, chữa lành sự thiếu hoà hợp trong những mối quan hệ quan trọng.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ═══ S8: CURRICULUM ═══ -->
    <section class="srv-section--alt" aria-label="Lộ trình 12 module">
      <div class="container">
        <div class="section-header">
          <span class="badge badge--gold">Lộ trình 90 ngày</span>
          <h2 style="margin-top: var(--space-4);">12 module đi từ Quá khứ đến Hiện tại và Tương lai</h2>
          <div class="divider"></div>
          <p>Hành trình bắt đầu bằng ổn định và yêu thương bản thân, rồi đi vào hiểu mình, phục hồi nội lực, hàn gắn quan hệ và phóng tầm nhìn cho tương lai.</p>
          <div class="focus-badge-row">
            <span class="focus-badge">Clarity</span>
            <span class="focus-badge">Confidence</span>
            <span class="focus-badge">Connection</span>
            <span class="focus-badge">Integration</span>
          </div>
        </div>

        <div class="tina-stage" data-reveal>
          <div class="tina-stage-title">
            <span>Giai đoạn 1 · Module 1-4</span>
            <h3>Hiểu rõ chính mình · Clarity</h3>
          </div>
          <div class="tina-module-grid">
            <div class="tina-module"><strong>Module 1 · Khởi đầu</strong><p>Làm rõ bạn đang ở đâu, thật sự muốn đi đâu và đặt ngọn hải đăng cho cả hành trình.</p></div>
            <div class="tina-module"><strong>Module 2 · Yêu thương bản thân & chữa lành nội tâm</strong><p>Làm dịu giọng nói tự dằn vặt bên trong và học cách đối xử với chính mình bằng lòng trắc ẩn.</p></div>
            <div class="tina-module"><strong>Module 3 · Giá trị cốt lõi & điểm mạnh</strong><p>Tìm lại bạn là ai khi gạt bỏ kỳ vọng của người khác: những giá trị và sức mạnh tự nhiên làm nên con người bạn.</p></div>
            <div class="tina-module"><strong>Module 4 · Cá tính & bản đồ tính cách</strong><p>Soi chiếu qua Tử Vi, Nhân số học và công cụ Tâm lý học để hiểu cá tính, thế mạnh và điểm yếu.</p></div>
          </div>
        </div>

        <div class="tina-stage" data-reveal>
          <div class="tina-stage-title">
            <span>Giai đoạn 2 · Module 5-7</span>
            <h3>Tự tin làm chủ · Confidence</h3>
          </div>
          <div class="tina-module-grid">
            <div class="tina-module"><strong>Module 5 · Tư duy làm chủ & khung đạo đức</strong><p>Dựng la bàn nội tâm, chuyển hoá Tham-Sân-Si thành Bi-Trí-Dũng để các quyết định có gốc rễ vững chắc.</p></div>
            <div class="tina-module"><strong>Module 6 · Nghệ thuật ra quyết định</strong><p>Học cách đi qua những quyết định khó mà không còn dằn vặt, kết hợp trí tuệ phương Đông và công cụ phương Tây.</p></div>
            <div class="tina-module"><strong>Module 7 · Ý nghĩa cuộc đời</strong><p>Hợp nhất đời sống thực tế và đời sống tinh thần, để Đời và Đạo cân bằng trong một cuộc sống có ý nghĩa.</p></div>
          </div>
        </div>

        <div class="tina-stage" data-reveal>
          <div class="tina-stage-title">
            <span>Giai đoạn 3 · Module 8-10</span>
            <h3>Kết nối lại & phóng tầm nhìn · Connection</h3>
          </div>
          <div class="tina-module-grid">
            <div class="tina-module"><strong>Module 8 · Chữa lành & ranh giới trong quan hệ</strong><p>Hàn gắn tổn thương trong các mối quan hệ thân mật và học cách thiết lập ranh giới lành mạnh.</p></div>
            <div class="tina-module"><strong>Module 9 · Giao tiếp thật & bày tỏ nhu cầu</strong><p>Tập nói ra điều mình cần một cách rõ ràng, tự tin thông qua những bài thực hành nhập vai sống động.</p></div>
            <div class="tina-module"><strong>Module 10 · Tầm nhìn 5-10 năm & mục tiêu 90 ngày</strong><p>Nhìn thấy phiên bản tương lai của mình và vạch những bước đầu tiên để biến nó thành hiện thực.</p></div>
          </div>
        </div>

        <div class="tina-stage" data-reveal>
          <div class="tina-stage-title">
            <span>Khép lại & neo giữ · Module 11-12</span>
            <h3>Integration</h3>
          </div>
          <div class="tina-module-grid">
            <div class="tina-module"><strong>Module 11 · Tổng kết & kế hoạch duy trì</strong><p>Đo lường chặng đường đã đi, neo giữ con người mới và lập kế hoạch để không trượt về lối cũ.</p></div>
            <div class="tina-module"><strong>Module 12 · Module dự phòng linh hoạt</strong><p>Một module đệm để đào sâu điều bạn cần nhất, hoặc đồng hành cùng những gì mới nảy sinh trên đường.</p></div>
          </div>
        </div>
      </div>
    </section>

    <!-- ═══ S9: OUTCOMES AND GUARANTEE ═══ -->
    <section class="srv-section" aria-label="Kết quả sau 90 ngày">
      <div class="container">
        <div class="section-header">
          <span class="badge">Sau 90 ngày</span>
          <h2 style="margin-top: var(--space-4);">Bạn mang theo một nền tảng sống mới</h2>
          <div class="divider"></div>
        </div>
        <div class="outcome-layout">
          <!-- Left 2/3: content -->
          <div>
            <div class="deliv-grid" data-reveal-stagger>
              <div class="deliv-card" data-reveal>
                <h3>Bình an không còn dễ vỡ</h3>
                <p>Một sự bình an đến từ bên trong, không còn phải vay mượn từ bên ngoài.</p>
              </div>
              <div class="deliv-card" data-reveal>
                <h3>Con đường sống rõ ràng</h3>
                <p>Bạn biết mình muốn đi đâu, về đâu, và không còn loay hoay trong cảm giác mơ hồ.</p>
              </div>
              <div class="deliv-card" data-reveal>
                <h3>Bộ công cụ tự đứng vững</h3>
                <p>Bạn có công cụ để tự ra quyết định, tự làm dịu mình và tự đứng vững khi sóng gió quay lại.</p>
              </div>
            </div>
            <div class="method-layout" style="margin-top: var(--space-8);">
              <div class="method-col method-col--positive" data-reveal>
                <h3>Cam kết của tôi</h3>
                <p>Tôi tin vào giá trị của hành trình này, nên tôi muốn bạn bắt đầu mà không phải gánh rủi ro một mình.</p>
                <div class="tina-quote" style="margin-bottom: 0;">
                  <p>Trong 30 ngày đầu tiên, nếu bạn thấy hành trình này không phù hợp, tôi sẽ hoàn lại toàn bộ học phí - không cần lý do.</p>
                </div>
              </div>
              <div class="method-col" data-reveal>
                <h3>Điều tôi cần ở bạn</h3>
                <p>Hãy thật sự hiện diện. Hãy có mặt và làm việc với chính mình trong những buổi đồng hành. Phần còn lại, hãy để chúng tôi lo.</p>
              </div>
            </div>
          </div>
          <!-- Right 1/3: image -->
          <div class="outcome-img" data-reveal="right">
            <img src="<?php echo edt_asset('images/tina_awakening_success_sau_90_ngay.jpg'); ?>" alt="Kết quả sau 90 ngày TINA Awakening" loading="lazy">
          </div>
        </div>
      </div>
    </section>

    <!-- ═══ S10: TESTIMONIALS ═══ -->
    <section class="srv-section--alt" aria-label="Khách hàng nói gì về Trâm">
      <div class="container">
        <div class="section-header">
          <span class="badge badge--gold">Khách hàng nói gì</span>
          <h2 style="margin-top: var(--space-4);">Những chia sẻ sau hành trình đồng hành</h2>
          <div class="divider"></div>
          <p>Những lời chia sẻ dưới đây được trích từ các video và ghi âm phản hồi của khách hàng sau hành trình đồng hành cùng Trâm.</p>
        </div>
        <div class="testi-grid" data-reveal-stagger>
          <div class="testi-card" data-reveal>
            <div>
              <p class="testi-name">Chị Hoàng Hương</p>
              <p class="testi-role">1984 · Phó phòng Tín dụng khách hàng, Ngân hàng BIDV</p>
              <p class="testi-quote">Tôi đã sống 40 năm, va chạm xã hội nhiều, nhưng hôm nay tôi mới thật sự sáng mắt ra. Trâm giúp tôi hiểu tam giác Bi - Trí - Dũng và soi thẳng vào đời mình. Một tháng trước, lúc bế tắc nhất, tôi đã cầu xin một quý nhân dẫn đường. Và Trâm đã xuất hiện.</p>
            </div>
          </div>
          <div class="testi-card" data-reveal>
            <div>
              <p class="testi-name">Chị Minh Hương</p>
              <p class="testi-role">1984 · Boston, Massachusetts</p>
              <p class="testi-quote">Phiên coach với Trâm là một trong những trải nghiệm sâu nhất tôi từng có. Trâm giúp tôi chạm vào một ký ức tưởng đã quên từ lâu. Ở Trâm luôn có cảm giác an toàn, kiên nhẫn và không bao giờ phán xét.</p>
            </div>
          </div>
          <div class="testi-card" data-reveal>
            <div>
              <p class="testi-name">Anh Lê Thế Hào</p>
              <p class="testi-role">1993 · Dịch giả, TP. Hồ Chí Minh</p>
              <p class="testi-quote">Hai điều giá trị nhất trong phiên: em nhìn rõ hơn đâu là phương tiện và đâu mới thật sự là cứu cánh của đời mình; và bài học "còn thở là còn gỡ". Em cảm nhận được một tình thương thiêng liêng trong đó.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ═══ S11: INSTRUCTOR ═══ -->
    <?php edt_section('instructor', ['label' => 'Người đồng hành', 'alt' => 'Edina Trâm - người đồng hành trong chương trình TINA Awakening']); ?>

    <!-- ═══ S12: NEXT JOURNEY / OFFER ═══ -->
    <section class="srv-section" aria-label="Bắt đầu hành trình 90 ngày">
      <div class="container">
        <div class="section-header">
          <span class="badge">Bước tiếp theo</span>
          <h2 style="margin-top: var(--space-4);">Bắt đầu bằng một phiên khám phá</h2>
          <div class="divider"></div>
          <p>Đây không phải một khoá học để mua theo gói. Chỉ có một con đường duy nhất để bắt đầu: một phiên khám phá đủ sâu để cùng xem hành trình này có thật sự dành cho bạn.</p>
        </div>
        <div class="offer-single" data-reveal>
          <div class="offer-card offer-card--featured">
            <div class="offer-label">Chương trình · TINA Awakening</div>
            <h3>90 ngày chuyển hoá 1:1 · 12 module</h3>
            <div class="offer-price"><small>Học phí trọn hành trình</small>29.000.000 VNĐ</div>
            <p>Một hành trình may đo riêng cho từng người. Bạn không mua một khoá học — bạn bắt đầu một sự chuyển hoá.</p>
            <div class="offer-anchor">
              <span class="offer-anchor-label">Phiên khám phá 1:1 với Edina Trâm</span>
              <span class="offer-anchor-price"><s>1.000.000đ</s> <strong>Miễn phí</strong></span>
            </div>
            <a href="https://calendly.com/edinatram/phien-kham-pha" target="_blank" rel="noopener" class="btn btn--accent btn--lg">Đặt lịch phiên khám phá</a>
            <p class="offer-note">Phiên khám phá là một buổi trò chuyện giá trị, không phải buổi bán hàng. Số lượng có hạn mỗi tuần để đảm bảo chiều sâu cho từng người.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- ═══ S13: FAQ ═══ -->
    <section class="srv-section--alt" aria-label="Câu hỏi thường gặp">
      <div class="container container--narrow">
        <div class="section-header">
          <span class="badge">FAQ</span>
          <h2 style="margin-top: var(--space-4);">Câu hỏi thường gặp</h2>
          <div class="divider"></div>
        </div>
        <div class="faq-list">
          <!-- Signature question — điểm chạm tâm lý quan trọng nhất -->
          <div class="faq-item" data-reveal>
            <button class="faq-q" aria-expanded="false">
              <span>Tôi chưa biết vấn đề của mình là gì thì sao?</span>
            </button>
            <div class="faq-a"><div><div class="faq-a-inner">Đó chính là lý do nên bắt đầu. Rất nhiều người đến với TINA Awakening trong trạng thái "biết là có gì đó chưa ổn" nhưng chưa gọi được thành tên. Phiên khám phá và những module đầu tiên được thiết kế để giúp bạn định vị hiện trạng, làm rõ điều mình thật sự muốn và nhìn thấy những vòng lặp đang âm thầm vận hành bên trong.</div></div></div>
          </div>
          <div class="faq-item" data-reveal>
            <button class="faq-q" aria-expanded="false">
              <span>Tôi có cần chuẩn bị gì trước phiên khám phá không?</span>
            </button>
            <div class="faq-a"><div><div class="faq-a-inner">Bạn chỉ cần mang theo sự thành thật với chính mình: điều đang khiến bạn bế tắc, điều bạn khao khát thay đổi, và mức độ sẵn sàng nhìn sâu vào bên trong.</div></div></div>
          </div>
          <div class="faq-item" data-reveal>
            <button class="faq-q" aria-expanded="false">
              <span>Vì sao chương trình kéo dài 90 ngày?</span>
            </button>
            <div class="faq-a"><div><div class="faq-a-inner">Chuyển hoá thật không phải một sự kiện đơn lẻ. 90 ngày cho phép nhận thức mới có thời gian ngấm vào hành vi, lựa chọn, quan hệ và kế hoạch sống của bạn.</div></div></div>
          </div>
          <div class="faq-item" data-reveal>
            <button class="faq-q" aria-expanded="false">
              <span>Sau 90 ngày có thể đi tiếp không?</span>
            </button>
            <div class="faq-a"><div><div class="faq-a-inner">Có. 90 Ngày Chuyển Hoá là chặng khai sáng đầu tiên. Khi đã thấy rõ tầm nhìn 5-10 năm, nhiều người chọn đi tiếp vào TINA Alignment để lên kế hoạch và hiện thực hoá tầm nhìn ấy.</div></div></div>
          </div>
          <div class="faq-item" data-reveal>
            <button class="faq-q" aria-expanded="false">
              <span>TINA Awakening có phải trị liệu tâm lý không?</span>
            </button>
            <div class="faq-a"><div><div class="faq-a-inner">Đây là hành trình Coaching & Mentoring 1:1 kết hợp nền tảng tâm lý học, khai vấn, tâm linh và đời sống thực tế. Chương trình không thay thế điều trị y khoa hay trị liệu lâm sàng khi bạn đang cần hỗ trợ chuyên môn y tế.</div></div></div>
          </div>
        </div>
      </div>
    </section>

    <!-- ═══ S14: CTA FINAL ═══ -->
    <section class="srv-cta-final bg-silk-orbit bg-tram-3" aria-label="Đặt lịch bắt đầu hành trình">
      <div class="container">
        <h2>Hãy đặt lịch ngay hôm nay</h2>
        <p style="max-width: 660px;">Đừng bỏ lỡ cơ hội thay đổi cuộc đời mình. Một cuộc trò chuyện đủ thành thật có thể là điểm khởi đầu cho một hướng đi hoàn toàn mới.</p>
        <a href="https://calendly.com/edinatram/phien-kham-pha" target="_blank" rel="noopener" class="btn btn--accent btn--lg">Đặt lịch phiên khám phá</a>
        <div class="contact-line">
          <span>Website: edinatram.vn</span>
          <span>WhatsApp/Zalo: (+84) 88-9590-888</span>
          <span>Email: lequynhtram@gmail.com</span>
        </div>
      </div>
    </section>

  

<?php get_footer();
