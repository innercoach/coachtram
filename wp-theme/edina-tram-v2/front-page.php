<?php
/**
 * Template: Front Page
 * Edina Trâm V2 — Homepage
 */
get_header();
?>

  <main>

    <!-- ═══════════════════════════════════════════════════════
         1. HERO SECTION
         ═══════════════════════════════════════════════════════ -->
    <section class="home-hero">
      <div class="container">
        <div class="home-hero-grid">

          <!-- Content -->
          <div class="home-hero-content" data-reveal>
            <span class="badge badge--gold"><?php echo esc_html(edt_field('home_hero_badge', null, 'COACHING · MINDFULNESS · TRANSFORMATION')); ?></span>
            <h1><?php echo wp_kses_post(edt_field('home_hero_title', null, 'Dẫn lối bình an,<br>khai mở <em>nội lực.</em>')); ?></h1>
            <p class="home-hero-desc"><?php echo esc_html(edt_field('home_hero_desc', null, 'Đồng hành cùng bạn tìm lại sự rõ ràng trong tâm trí, tự tin trong hành động và sống một cuộc đời đúng với giá trị của chính mình.')); ?></p>
            <div class="home-hero-ctas">
              <a href="<?php echo esc_url(edt_field('home_hero_cta1_url', null, '#services')); ?>" class="btn btn--primary btn--lg"><?php echo esc_html(edt_field('home_hero_cta1_label', null, 'Khám phá dịch vụ')); ?></a>
              <a href="<?php echo esc_url(edt_field('home_hero_cta2_url', null, '/lien-he')); ?>" class="btn btn--outline btn--lg"><?php echo esc_html(edt_field('home_hero_cta2_label', null, 'Tư vấn 1:1 miễn phí')); ?></a>
            </div>

            <!-- Hero Values Strip -->
            <div class="home-hero-values">
              <div class="home-hero-value">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M12 21C12 21 4 14.5 4 9a4 4 0 018 0 4 4 0 018 0c0 5.5-8 12-8 12z"/></svg>
                <strong><?php echo esc_html(edt_field('home_hero_value1_title', null, 'Lắng Nghe Sâu Sắc')); ?></strong>
                <span><?php echo esc_html(edt_field('home_hero_value1_desc', null, 'Thấu hiểu từ bên trong')); ?></span>
              </div>
              <div class="home-hero-value">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                <strong><?php echo esc_html(edt_field('home_hero_value2_title', null, 'Khai Mở Nội Lực')); ?></strong>
                <span><?php echo esc_html(edt_field('home_hero_value2_desc', null, 'Khơi dậy tiềm năng')); ?></span>
              </div>
              <div class="home-hero-value">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                <strong><?php echo esc_html(edt_field('home_hero_value3_title', null, 'Đồng Hành Từ Tê')); ?></strong>
                <span><?php echo esc_html(edt_field('home_hero_value3_desc', null, 'Bước qua giới hạn')); ?></span>
              </div>
            </div>
          </div>

          <!-- Hero Image -->
          <div class="home-hero-img" data-reveal="right">
            <?php
            $hero_img = edt_img_url('home_hero_image', 'full');
            $hero_img_src = $hero_img ? $hero_img : get_template_directory_uri() . '/assets/images/hero-coach.png';
            ?>
            <img src="<?php echo esc_url($hero_img_src); ?>" alt="<?php echo esc_attr(edt_field('home_hero_image_alt', null, 'Coach Edina Trâm')); ?>" loading="lazy" width="600" height="680">
          </div>

        </div>
      </div>

      <!-- Scroll Indicator -->
      <div class="scroll-indicator"><?php echo esc_html(edt_field('home_hero_scroll_text', null, 'Cuộn xuống')); ?></div>
    </section>


    <!-- ═══════════════════════════════════════════════════════
         2. SERVICES SECTION
         ═══════════════════════════════════════════════════════ -->
    <section id="services" class="section section--alt">
      <div class="container">

        <div class="section-header" data-reveal>
          <span class="badge"><?php echo esc_html(edt_field('home_srv_badge', null, 'Hệ sinh thái dịch vụ')); ?></span>
          <h2><?php echo wp_kses_post(edt_field('home_srv_title', null, 'Ba chương trình chuyển hóa')); ?></h2>
          <div class="divider"></div>
          <p><?php echo esc_html(edt_field('home_srv_desc', null, 'Mỗi chương trình được thiết kế riêng biệt, phục vụ từng giai đoạn trên hành trình phát triển của bạn — từ đam mê cá nhân đến tự do tài chính.')); ?></p>
        </div>

        <div class="srv-grid" data-reveal-stagger>

          <!-- P2P -->
          <div class="srv-card srv-card--p2p">
            <div class="srv-num"><?php echo esc_html(edt_field('home_srv1_num', null, '01')); ?></div>
            <h3><?php echo esc_html(edt_field('home_srv1_title', null, 'Passion to Profit')); ?></h3>
            <div class="srv-sub"><?php echo esc_html(edt_field('home_srv1_subtitle', null, 'Workshop 2 ngày')); ?></div>
            <p><?php echo esc_html(edt_field('home_srv1_desc', null, 'Chuyển hóa đam mê thành mô hình kinh doanh có lợi nhuận. Tìm ra lợi thế cạnh tranh, xây dựng nền tảng vững chắc và bắt đầu hành trình khởi nghiệp đầy tự tin.')); ?></p>
            <a href="<?php echo esc_url(edt_field('home_srv1_url', null, '/dich-vu-1')); ?>" class="btn btn--primary btn--sm"><?php echo esc_html(edt_field('home_srv1_cta', null, 'Tìm hiểu thêm →')); ?></a>
          </div>

          <!-- B2F -->
          <div class="srv-card srv-card--b2f">
            <div class="srv-num"><?php echo esc_html(edt_field('home_srv2_num', null, '02')); ?></div>
            <h3><?php echo esc_html(edt_field('home_srv2_title', null, 'Business to Freedom')); ?></h3>
            <div class="srv-sub"><?php echo esc_html(edt_field('home_srv2_subtitle', null, 'Khoá học 10 tuần')); ?></div>
            <p><?php echo esc_html(edt_field('home_srv2_desc', null, 'Mở rộng quy mô doanh nghiệp, xây dựng hệ thống vận hành tự động và tạo ra cuộc sống tự do mà bạn hằng mơ ước — không cần phải hy sinh sức khỏe hay gia đình.')); ?></p>
            <a href="<?php echo esc_url(edt_field('home_srv2_url', null, '/dich-vu-2')); ?>" class="btn btn--primary btn--sm"><?php echo esc_html(edt_field('home_srv2_cta', null, 'Tìm hiểu thêm →')); ?></a>
          </div>

          <!-- BM -->
          <div class="srv-card srv-card--bm">
            <div class="srv-num"><?php echo esc_html(edt_field('home_srv3_num', null, '03')); ?></div>
            <h3><?php echo esc_html(edt_field('home_srv3_title', null, 'Business Mastery')); ?></h3>
            <div class="srv-sub"><?php echo esc_html(edt_field('home_srv3_subtitle', null, 'Coaching 1:1 chiến lược')); ?></div>
            <p><?php echo esc_html(edt_field('home_srv3_desc', null, 'Chương trình coaching cá nhân hóa dành cho doanh nhân muốn làm chủ mọi khía cạnh — từ chiến lược kinh doanh, lãnh đạo đội ngũ đến phát triển bản thân.')); ?></p>
            <a href="<?php echo esc_url(edt_field('home_srv3_url', null, '/dich-vu-3')); ?>" class="btn btn--primary btn--sm"><?php echo esc_html(edt_field('home_srv3_cta', null, 'Tìm hiểu thêm →')); ?></a>
          </div>

        </div>
      </div>
    </section>


    <!-- ═══════════════════════════════════════════════════════
         3. ABOUT SECTION
         ═══════════════════════════════════════════════════════ -->
    <section class="section">
      <div class="container">
        <div class="about-grid">

          <!-- Image -->
          <div class="about-img-wrap" data-reveal="left">
            <?php
            $about_img = edt_img_url('home_about_image', 'large');
            $about_img_src = $about_img ? $about_img : get_template_directory_uri() . '/assets/images/about-coach.png';
            ?>
            <img src="<?php echo esc_url($about_img_src); ?>" alt="<?php echo esc_attr(edt_field('home_about_image_alt', null, 'Coach Edina Trâm')); ?>" loading="lazy" width="520" height="640">
            <div class="about-badge"><?php echo esc_html(edt_field('home_about_badge_overlay', null, 'ICF PCC Coach')); ?></div>
          </div>

          <!-- Content -->
          <div class="about-content" data-reveal="right">
            <span class="badge"><?php echo esc_html(edt_field('home_about_badge', null, 'Người đồng hành')); ?></span>
            <h2><?php echo wp_kses_post(edt_field('home_about_title', null, 'Chân thực. Thấu hiểu.<br>Truyền cảm hứng.')); ?></h2>
            <div class="divider divider--left"></div>
            <div class="about-name"><?php echo esc_html(edt_field('home_about_name', null, 'Edina Trâm')); ?></div>
            <p class="about-bio"><?php echo wp_kses_post(edt_field('home_about_bio', null, 'Với hơn 16 năm kinh nghiệm trong ngành F&B và hành trình phát triển bản thân không ngừng, tôi tin rằng mỗi người đều sở hữu một nguồn nội lực phi thường. Sứ mệnh của tôi là đồng hành cùng bạn khơi dậy tiềm năng ấy, để bạn sống một cuộc đời ý nghĩa và trọn vẹn.')); ?></p>
            <div class="about-credentials">
              <span class="badge badge--gold"><?php echo esc_html(edt_field('home_about_cred1', null, 'ICF PCC')); ?></span>
              <span class="badge badge--gold"><?php echo esc_html(edt_field('home_about_cred2', null, '16+ Năm Kinh Nghiệm')); ?></span>
              <span class="badge badge--gold"><?php echo esc_html(edt_field('home_about_cred3', null, 'F&B Expert')); ?></span>
              <span class="badge badge--gold"><?php echo esc_html(edt_field('home_about_cred4', null, '50+ Doanh Nghiệp')); ?></span>
            </div>

            <!-- Stats -->
            <div class="stat-grid" data-reveal-stagger>
              <div class="stat-card">
                <div class="stat-num" data-count="<?php echo esc_attr(edt_field('home_about_stat1_num', null, '16')); ?>" data-suffix="<?php echo esc_attr(edt_field('home_about_stat1_suffix', null, '+')); ?>">0</div>
                <div class="stat-label"><?php echo esc_html(edt_field('home_about_stat1_label', null, 'Năm kinh nghiệm')); ?></div>
              </div>
              <div class="stat-card">
                <div class="stat-num" data-count="<?php echo esc_attr(edt_field('home_about_stat2_num', null, '50')); ?>" data-suffix="<?php echo esc_attr(edt_field('home_about_stat2_suffix', null, '+')); ?>">0</div>
                <div class="stat-label"><?php echo esc_html(edt_field('home_about_stat2_label', null, 'Doanh nghiệp đồng hành')); ?></div>
              </div>
              <div class="stat-card">
                <div class="stat-num" data-count="<?php echo esc_attr(edt_field('home_about_stat3_num', null, '1000')); ?>" data-suffix="<?php echo esc_attr(edt_field('home_about_stat3_suffix', null, '+')); ?>">0</div>
                <div class="stat-label"><?php echo esc_html(edt_field('home_about_stat3_label', null, 'Cuốn sách đã đọc')); ?></div>
              </div>
              <div class="stat-card">
                <div class="stat-num" data-count="<?php echo esc_attr(edt_field('home_about_stat4_num', null, '3')); ?>" data-suffix="<?php echo esc_attr(edt_field('home_about_stat4_suffix', null, '')); ?>">0</div>
                <div class="stat-label"><?php echo esc_html(edt_field('home_about_stat4_label', null, 'Chương trình chuyển hóa')); ?></div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>


    <!-- ═══════════════════════════════════════════════════════
         4. BOOK SECTION
         ═══════════════════════════════════════════════════════ -->
    <section class="section book-section">
      <div class="container">
        <div class="book-grid">

          <!-- Book Image -->
          <div class="book-img" data-reveal="left">
            <?php
            $book_img = edt_img_url('home_book_image', 'large');
            $book_img_src = $book_img ? $book_img : get_template_directory_uri() . '/assets/images/book-mockup.png';
            ?>
            <img src="<?php echo esc_url($book_img_src); ?>" alt="<?php echo esc_attr(edt_field('home_book_image_alt', null, 'Sách Ánh Sáng Của Ước Mơ – Edina Trâm')); ?>" loading="lazy" width="340" height="420">
          </div>

          <!-- Book Content -->
          <div class="book-content" data-reveal="right">
            <span class="badge badge--dark"><?php echo esc_html(edt_field('home_book_badge', null, 'Sách mới')); ?></span>
            <h2><?php echo wp_kses_post(edt_field('home_book_title', null, 'Ánh Sáng Của Ước Mơ')); ?></h2>
            <p><?php echo wp_kses_post(edt_field('home_book_desc', null, 'Cuốn sách chia sẻ hành trình chuyển hóa cá nhân và những bài học quý giá trên con đường kiến tạo cuộc sống ý nghĩa. Một nguồn cảm hứng cho bất kỳ ai đang tìm kiếm sự rõ ràng và mục đích sống.')); ?></p>
            <div class="book-ctas">
              <a href="<?php echo esc_url(edt_field('home_book_cta1_url', null, '#')); ?>" class="btn btn--accent btn--lg"><?php echo esc_html(edt_field('home_book_cta1_label', null, 'Đặt sách ngay')); ?></a>
              <a href="<?php echo esc_url(edt_field('home_book_cta2_url', null, '#')); ?>" class="btn btn--outline-light btn--lg"><?php echo esc_html(edt_field('home_book_cta2_label', null, 'Xem thêm')); ?></a>
            </div>
          </div>

        </div>
      </div>
    </section>


    <!-- ═══════════════════════════════════════════════════════
         5. TESTIMONIALS SECTION
         ═══════════════════════════════════════════════════════ -->
    <section class="section section--alt">
      <div class="container">

        <div class="section-header" data-reveal>
          <span class="badge"><?php echo esc_html(edt_field('home_testi_badge', null, 'Khách hàng nói gì')); ?></span>
          <h2><?php echo wp_kses_post(edt_field('home_testi_title', null, 'Hành trình chuyển hóa thật sự')); ?></h2>
          <div class="divider"></div>
        </div>

        <?php edt_render_testimonials('home'); ?>

      </div>
    </section>


    <!-- ═══════════════════════════════════════════════════════
         6. MULTI-CHANNEL SECTION
         ═══════════════════════════════════════════════════════ -->
    <section class="section">
      <div class="container">

        <div class="section-header" data-reveal>
          <span class="badge"><?php echo esc_html(edt_field('home_channel_badge', null, 'Kết nối đa kênh')); ?></span>
          <h2><?php echo wp_kses_post(edt_field('home_channel_title', null, 'Đi cùng Edina trên mọi nền tảng')); ?></h2>
          <div class="divider"></div>
        </div>

        <div class="eco-grid" data-reveal-stagger>

          <!-- Facebook -->
          <div class="eco-card">
            <div class="eco-icon">
              <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
            </div>
            <h3><?php echo esc_html(edt_field('home_ch1_title', null, 'Facebook')); ?></h3>
            <p><?php echo esc_html(edt_field('home_ch1_desc', null, 'Cộng đồng chia sẻ kiến thức, cảm hứng và kết nối hàng ngày cùng hàng nghìn doanh nhân.')); ?></p>
          </div>

          <!-- YouTube -->
          <div class="eco-card">
            <div class="eco-icon">
              <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M22.54 6.42a2.78 2.78 0 00-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 00-1.94 2A29 29 0 001 11.75a29 29 0 00.46 5.33A2.78 2.78 0 003.4 19.1c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 001.94-2 29 29 0 00.46-5.25 29 29 0 00-.46-5.33z"/><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"/></svg>
            </div>
            <h3><?php echo esc_html(edt_field('home_ch2_title', null, 'YouTube')); ?></h3>
            <p><?php echo esc_html(edt_field('home_ch2_desc', null, 'Video chia sẻ chuyên sâu về coaching, mindfulness và phát triển bản thân cho doanh nhân.')); ?></p>
          </div>

          <!-- Newsletter -->
          <div class="eco-card">
            <div class="eco-icon">
              <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            </div>
            <h3><?php echo esc_html(edt_field('home_ch3_title', null, 'Newsletter')); ?></h3>
            <p><?php echo esc_html(edt_field('home_ch3_desc', null, 'Nhận bài viết chuyên sâu, tài nguyên miễn phí và cập nhật mới nhất mỗi tuần qua email.')); ?></p>
          </div>

          <!-- Edina Workspace -->
          <div class="eco-card">
            <div class="eco-icon">
              <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
            </div>
            <h3><?php echo esc_html(edt_field('home_ch4_title', null, 'Edina Workspace')); ?></h3>
            <p><?php echo esc_html(edt_field('home_ch4_desc', null, 'Không gian làm việc và học tập trực tuyến dành riêng cho cộng đồng học viên Edina Trâm.')); ?></p>
          </div>

        </div>
      </div>
    </section>


    <!-- ═══════════════════════════════════════════════════════
         7. CTA FINAL
         ═══════════════════════════════════════════════════════ -->
    <section class="cta-final section--dark">
      <div class="container" data-reveal>
        <span class="badge badge--dark"><?php echo esc_html(edt_field('home_cta_badge', null, 'Bắt đầu hành trình')); ?></span>
        <h2><?php echo wp_kses_post(edt_field('home_cta_title', null, 'Bạn đã sẵn sàng cho phiên bản<br>tuyệt vời nhất?')); ?></h2>
        <p><?php echo esc_html(edt_field('home_cta_desc', null, 'Đặt lịch tư vấn miễn phí để cùng tôi tìm ra chương trình phù hợp nhất cho hành trình chuyển hóa của bạn.')); ?></p>
        <a href="<?php echo esc_url(edt_field('home_cta_url', null, '/lien-he')); ?>" class="btn btn--accent btn--lg"><?php echo esc_html(edt_field('home_cta_label', null, 'Đặt lịch Tư vấn miễn phí')); ?></a>
      </div>
    </section>

  </main>

<?php get_footer(); ?>
