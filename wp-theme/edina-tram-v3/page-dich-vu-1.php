<?php
/**
 * Template: TINA Awareness
 * Port từ static-site/dich-vu-1.html — nội dung theo bản HTML đã chốt.
 * Chrome (header/footer/nav/glow-blobs) do get_header()/get_footer() lo.
 */
if (!defined('ABSPATH')) exit;
get_header();
?>
  <style>
    :root { --page-accent: #0B8A66; --page-accent-rgb: 11, 138, 102; }
    body { padding-bottom: 80px; }
    .intro-grid { display:grid; grid-template-columns: repeat(3, 1fr); gap: var(--space-5); margin-top: var(--space-8); }
    .intro-card { background: var(--color-surface); border: 1px solid var(--color-border-light); border-top: 3px solid var(--page-accent); border-radius: var(--radius-lg); padding: var(--space-7, 1.75rem); box-shadow: var(--shadow-sm); }
    .intro-card h3 { font-family: var(--font-body); font-size: var(--text-lg); color: var(--color-fg); margin-bottom: var(--space-2); }
    .intro-card p { font-size: var(--text-sm); line-height: 1.75; }
    .journey-list { display:grid; gap: var(--space-4); max-width: 900px; margin: var(--space-8) auto 0; }
    .journey-item { display:grid; grid-template-columns: 86px 1fr; gap: var(--space-5); align-items:start; background: linear-gradient(155deg, #fff, rgba(236,245,240,.75)); border: 1px solid var(--color-border-light); border-radius: var(--radius-lg); padding: var(--space-6); }
    .journey-day { font-family: var(--font-heading); font-size: var(--text-3xl); color: var(--royal-gold); line-height:1; }
    .fit-grid { display:grid; grid-template-columns: repeat(2, 1fr); gap: var(--space-6); margin-top: var(--space-8); }
    .fit-card { background: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-lg); padding: var(--space-8); }
    .fit-card h3 { font-family: var(--font-body); font-size: var(--text-lg); color: var(--page-accent); margin-bottom: var(--space-4); }
    .fit-card li { display:flex; gap: var(--space-2); margin-bottom: var(--space-3); color: var(--color-fg-muted); line-height:1.65; }
    .fit-card li::before { content:""; width:7px; height:7px; border-radius:50%; background: var(--royal-gold); flex:0 0 auto; margin-top:.7em; }
    .awareness-callout { max-width: 860px; margin: var(--space-8) auto 0; padding: var(--space-8); text-align:center; border-radius: var(--radius-lg); border: 1px solid rgba(200,162,68,.45); background: radial-gradient(120% 140% at 50% 0%, rgba(241,216,154,.18), transparent 60%), linear-gradient(155deg, #06513c, #00372a); box-shadow: var(--shadow-lg); }
    .awareness-callout p { margin:0; color:#fff; font-family: var(--font-heading); font-size: clamp(1.5rem, 3vw, 1.9rem); font-weight:600; line-height:1.45; }
    @media (max-width: 860px) { .intro-grid, .fit-grid { grid-template-columns: 1fr; } .journey-item { grid-template-columns: 1fr; } }
  </style>
    <section class="srv-hero">
      <div class="container srv-hero-grid">
        <div class="srv-hero-content" data-reveal>
          <span class="badge">NHẬP MÔN · 3 BUỔI KẾT NỐI</span>
          <h1>TINA<br><span>Awareness</span></h1>
          <p class="srv-hero-tagline">Bắt đầu bằng việc nhìn rõ chính mình</p>
          <p class="srv-hero-desc">Ba phiên kết nối 1:1 dành cho những ai đang muốn dừng lại, lắng nghe bản thân và gọi tên điều thật sự đang khiến mình mắc kẹt trước khi bước vào một hành trình chuyển hoá sâu hơn.</p>
          <div class="srv-hero-meta">
            <span class="meta-item">3 ngày · 3 phiên kết nối</span>
            <span class="meta-item">1:1 cùng Edina Trâm</span>
          </div>
          <div class="price-badge">3.000.000 VNĐ</div>
          <div style="margin-top: var(--space-6);">
            <a href="<?php echo esc_url(home_url('/lien-he/?program=awareness')); ?>" class="btn btn--accent btn--lg">Đăng ký gói 3 buổi</a>
          </div>
        </div>
        <div class="srv-hero-img" data-reveal="right">
          <img src="<?php echo edt_asset('images/hero_trang_tina_awareness.jpg'); ?>" alt="Edina Trâm - TINA Awareness" loading="eager" fetchpriority="high" width="2072" height="2560">
        </div>
      </div>
    </section>

    <section class="srv-section--alt">
      <div class="container">
        <div class="section-header" data-reveal>
          <span class="badge badge--gold">Vì sao bắt đầu ở đây?</span>
          <h2>Một khoảng dừng đủ sâu để bạn nghe lại chính mình</h2>
          <div class="divider"></div>
          <p>TINA Awareness không cố “giải quyết cả cuộc đời” trong vài ngày. Gói này tạo ra một không gian gọn, riêng tư và đủ an toàn để bạn bắt đầu nhìn rõ điều mình đang mang theo.</p>
        </div>
        <div class="intro-grid" data-reveal-stagger>
          <div class="intro-card" data-reveal>
            <h3>Gọi tên hiện trạng</h3>
            <p>Bạn nhìn lại mình đang ở đâu, điều gì đang lặp lại, điều gì khiến bạn mệt mỏi hoặc mất phương hướng.</p>
          </div>
          <div class="intro-card" data-reveal>
            <h3>Lắng nghe nhu cầu thật</h3>
            <p>Không vội chạy theo lời khuyên chung chung. Bạn được dẫn dắt để phân biệt điều mình nghĩ là cần và điều mình thật sự cần.</p>
          </div>
          <div class="intro-card" data-reveal>
            <h3>Chọn bước tiếp theo</h3>
            <p>Sau 3 phiên, bạn có một bức tranh rõ hơn để quyết định nên đi sâu vào Awakening, Alignment hay một hướng nhẹ hơn.</p>
          </div>
        </div>
      </div>
    </section>

    <section class="srv-section">
      <div class="container">
        <div class="section-header" data-reveal>
          <span class="badge">Lộ trình 3 phiên</span>
          <h2>Ba ngày để bắt đầu kết nối lại</h2>
          <div class="divider"></div>
        </div>
        <div class="journey-list" data-reveal-stagger>
          <div class="journey-item" data-reveal>
            <div class="journey-day">01</div>
            <div>
              <h3>Phiên 1 · Chạm vào câu hỏi thật</h3>
              <p>Bóc tách điều đang khiến bạn tìm đến hành trình này: bế tắc, mất kết nối, thiếu rõ ràng, hoặc một khao khát thay đổi chưa gọi được thành tên.</p>
            </div>
          </div>
          <div class="journey-item" data-reveal>
            <div class="journey-day">02</div>
            <div>
              <h3>Phiên 2 · Nhìn thấy vòng lặp</h3>
              <p>Nhận diện những mô thức cũ trong suy nghĩ, cảm xúc, lựa chọn và mối quan hệ đang khiến bạn quay lại cùng một điểm mắc kẹt.</p>
            </div>
          </div>
          <div class="journey-item" data-reveal>
            <div class="journey-day">03</div>
            <div>
              <h3>Phiên 3 · Rõ bước đi kế tiếp</h3>
              <p>Chốt lại điều bạn cần ưu tiên, mức độ sẵn sàng của bạn và lộ trình phù hợp nhất để đi tiếp mà không ép mình vào một quyết định vội vàng.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="srv-section--alt">
      <div class="container">
        <div class="section-header" data-reveal>
          <span class="badge badge--gold">Ai phù hợp?</span>
          <h2>TINA Awareness dành cho bạn nếu...</h2>
          <div class="divider"></div>
        </div>
        <div class="fit-grid" data-reveal-stagger>
          <div class="fit-card" data-reveal>
            <h3>Dành cho bạn nếu</h3>
            <ul>
              <li>Bạn đang ở một ngã rẽ nhưng chưa đủ rõ để chọn hướng.</li>
              <li>Bạn đã đọc, học, thử nhiều cách nhưng vẫn thấy mình quay lại điểm cũ.</li>
              <li>Bạn muốn trải nghiệm cách làm việc với Trâm trước khi cam kết một lộ trình dài hơn.</li>
              <li>Bạn cần một không gian riêng tư, không phán xét, để thành thật với chính mình.</li>
            </ul>
          </div>
          <div class="fit-card" data-reveal>
            <h3>Chưa dành cho bạn nếu</h3>
            <ul>
              <li>Bạn muốn một câu trả lời nhanh thay cho việc tự nhìn sâu vào bên trong.</li>
              <li>Bạn đang cần trị liệu lâm sàng hoặc hỗ trợ y khoa khẩn cấp.</li>
              <li>Bạn chỉ muốn người khác quyết định thay mình.</li>
              <li>Bạn chưa sẵn sàng dành thời gian hiện diện trong cả 3 phiên.</li>
            </ul>
          </div>
        </div>
        <div class="awareness-callout" data-reveal>
          <p>Ba buổi đầu tiên không phải để vội vàng thay đổi bạn. Đó là để bạn bắt đầu nhìn rõ mình đang thật sự cần điều gì.</p>
        </div>
      </div>
    </section>

    <!-- ═══ ĐÔI NÉT VỀ EDINA TRÂM ═══ -->
    <?php edt_section('instructor', ['alt' => 'Edina Trâm - người đồng hành trong chương trình TINA Awareness']); ?>

    <!-- ═══ CÂU HỎI THƯỜNG GẶP ═══ -->
    <section class="srv-section--alt" aria-label="Câu hỏi thường gặp">
      <div class="container container--narrow">
        <div class="section-header">
          <span class="badge">FAQ</span>
          <h2 style="margin-top: var(--space-4);">Câu hỏi thường gặp</h2>
          <div class="divider"></div>
        </div>
        <div class="faq-list">
          <div class="faq-item" data-reveal>
            <button class="faq-q" aria-expanded="false">
              <span>Gói 3 buổi TINA Awareness phù hợp với ai?</span>
            </button>
            <div class="faq-a"><div><div class="faq-a-inner">Gói này dành cho bạn đang cần một khoảng dừng để lắng nghe chính mình: bạn cảm thấy có điều gì đó chưa ổn nhưng chưa gọi được thành tên, hoặc đang đứng trước một ngã rẽ và muốn nhìn rõ hơn trước khi quyết định. Đây cũng là cách nhẹ nhàng để bạn trải nghiệm cách làm việc cùng Trâm trước khi cân nhắc một hành trình sâu hơn.</div></div></div>
          </div>
          <div class="faq-item" data-reveal>
            <button class="faq-q" aria-expanded="false">
              <span>Ba buổi sẽ diễn ra như thế nào?</span>
            </button>
            <div class="faq-a"><div><div class="faq-a-inner">Ba buổi không theo một khuôn cứng, nhưng thường đi theo một mạch tự nhiên: buổi đầu để dừng lại và nhìn rõ bạn đang thật sự ở đâu; buổi giữa để lắng nghe và gọi tên điều đang âm thầm giữ bạn lại; buổi cuối để bạn thấy rõ hơn mình đang cần điều gì và bước tiếp theo có thể là gì. Mỗi buổi là một không gian riêng tư, không phán xét, để bạn thành thật với chính mình.</div></div></div>
          </div>
          <div class="faq-item" data-reveal>
            <button class="faq-q" aria-expanded="false">
              <span>TINA Awareness khác gì với hành trình TINA Awakening 90 ngày?</span>
            </button>
            <div class="faq-a"><div><div class="faq-a-inner">TINA Awareness là điểm bắt đầu — ba buổi để bạn nhìn rõ chính mình và gọi tên điều thật sự đang khiến bạn bế tắc. TINA Awakening là hành trình chuyển hoá 1:1 kéo dài 90 ngày, đủ thời gian để nhận thức mới ngấm vào lựa chọn, hành vi và cách bạn sống. Awareness giúp bạn thấy rõ; Awakening đồng hành cùng bạn đi trọn quá trình thay đổi.</div></div></div>
          </div>
          <div class="faq-item" data-reveal>
            <button class="faq-q" aria-expanded="false">
              <span>Các buổi diễn ra online hay offline, và tôi cần chuẩn bị gì?</span>
            </button>
            <div class="faq-a"><div><div class="faq-a-inner">Bạn có thể chọn gặp trực tiếp hoặc qua hình thức online tuỳ điều kiện và mong muốn của mình. Bạn không cần chuẩn bị tài liệu hay câu trả lời sẵn — chỉ cần một không gian yên tĩnh, đủ riêng tư để hiện diện trọn vẹn, và sự thành thật với chính mình về điều đang khiến bạn trăn trở.</div></div></div>
          </div>
          <div class="faq-item" data-reveal>
            <button class="faq-q" aria-expanded="false">
              <span>Sau 3 buổi, nếu muốn đi sâu hơn thì tôi có thể làm gì?</span>
            </button>
            <div class="faq-a"><div><div class="faq-a-inner">Hoàn toàn được. Nhiều người sau ba buổi nhận ra mình đã sẵn sàng cho một hành trình dài hơn. Khi đó, Trâm sẽ cùng bạn xem TINA Awakening — hành trình 90 ngày chuyển hoá 1:1 — có thật sự phù hợp với giai đoạn này của bạn không. Không có áp lực phải đi tiếp: ba buổi tự nó đã là một món quà bạn dành cho chính mình.</div></div></div>
          </div>
        </div>
      </div>
    </section>

    <!-- ═══ CTA CUỐI TRANG ═══ -->
    <section class="srv-cta-final bg-tram-3">
      <div class="container" data-reveal>
        <span class="badge badge--dark">TINA AWARENESS</span>
        <h2>Bắt đầu bằng một cuộc gặp đủ thành thật</h2>
        <p>Đặt lịch để cùng Trâm xem gói 3 buổi có phù hợp với giai đoạn hiện tại của bạn không.</p>
        <a href="<?php echo esc_url(home_url('/lien-he/?program=awareness')); ?>" class="btn btn--accent btn--lg">Đăng ký TINA Awareness</a>
      </div>
    </section>
  

<?php get_footer();
