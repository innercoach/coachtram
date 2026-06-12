<?php
/**
 * seed.php — Edina Trâm V2
 * Chạy qua: wp eval-file /docker/seed.php
 *
 * Seed toàn bộ: pages, post_meta, global options,
 * testimonials (CPT), FAQs (CPT), taxonomy terms, nav menu.
 */

WP_CLI::log( '──────────────────────────────────────────' );
WP_CLI::log( '  Edina Trâm V2 · Content Seeder' );
WP_CLI::log( '──────────────────────────────────────────' );


/* ============================================================
   HELPERS
   ============================================================ */

function seed_page( $title, $slug, $template = '' ) {
    $existing = get_page_by_path( $slug );
    if ( $existing ) {
        WP_CLI::log( "  ↩  Trang đã có: $title (ID {$existing->ID})" );
        return $existing->ID;
    }
    $args = [
        'post_title'  => $title,
        'post_name'   => $slug,
        'post_status' => 'publish',
        'post_type'   => 'page',
    ];
    if ( $template ) $args['page_template'] = $template;
    $id = wp_insert_post( $args, true );
    if ( is_wp_error( $id ) ) {
        WP_CLI::warning( "  ✗  Không tạo được trang: $title — " . $id->get_error_message() );
        return null;
    }
    WP_CLI::log( "  ✓  Tạo trang: $title (ID $id)" );
    return $id;
}

function seed_post( $post_type, $title, $content = '', $meta = [], $terms = [] ) {
    // Idempotent: tìm post đã tồn tại theo post_type + title
    $found = get_posts( [
        'post_type'   => $post_type,
        'post_status' => 'publish',
        'title'       => $title,
        'numberposts' => 1,
        'fields'      => 'ids',
    ] );

    if ( $found ) {
        $id = $found[0];
    } else {
        $id = wp_insert_post( [
            'post_type'    => $post_type,
            'post_title'   => $title,
            'post_content' => $content,
            'post_status'  => 'publish',
        ], true );
        if ( is_wp_error( $id ) ) {
            WP_CLI::warning( "  ✗  Không tạo được $post_type: $title" );
            return null;
        }
    }

    foreach ( $meta as $k => $v ) {
        update_post_meta( $id, $k, $v );
    }
    foreach ( $terms as $taxonomy => $slug ) {
        $term = get_term_by( 'slug', $slug, $taxonomy );
        if ( $term ) {
            wp_set_object_terms( $id, $term->term_id, $taxonomy );
        }
    }
    return $id;
}

function seed_meta( $post_id, array $meta ) {
    foreach ( $meta as $k => $v ) {
        update_post_meta( $post_id, $k, $v );
    }
}

/**
 * Tạo avatar placeholder 200×200 cho testimonial, set làm featured image.
 * Idempotent: bỏ qua nếu post đã có thumbnail.
 */
function seed_testimonial_avatar( $post_id, $name, $idx ) {
    if ( get_post_meta( $post_id, '_thumbnail_id', true ) ) return;

    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    // 6 màu nền xoay vòng (brand-adjacent)
    $palettes = [
        [ 12,  59,  46 ], // emerald đậm
        [ 18,  74,  58 ], // emerald sáng
        [ 45,  74,  10 ], // olive
        [ 59,  42,  12 ], // amber-nâu
        [ 26,  37,  74 ], // navy
        [ 59,  12,  42 ], // plum
    ];
    $c = $palettes[ ( $idx - 1 ) % count( $palettes ) ];

    $w  = 200;
    $h  = 200;
    $im = imagecreatetruecolor( $w, $h );

    $bg    = imagecolorallocate( $im, $c[0], $c[1], $c[2] );
    $gold  = imagecolorallocate( $im, 200, 162, 68  );
    $white = imagecolorallocate( $im, 240, 235, 220 );

    imagefill( $im, 0, 0, $bg );
    imageellipse( $im, $w / 2, $h / 2, $w - 20, $h - 20, $gold );

    // Số thứ tự căn giữa
    $num = str_pad( $idx, 2, '0', STR_PAD_LEFT );
    $fw  = imagefontwidth( 5 );
    $fh  = imagefontheight( 5 );
    imagestring( $im, 5,
        (int)( ( $w - strlen($num) * $fw ) / 2 ),
        (int)( ( $h - $fh ) / 2 ),
        $num, $gold
    );

    // Tên nhỏ phía dưới
    $short = mb_substr( $name, 0, 12 );
    $sw    = imagefontwidth(2);
    imagestring( $im, 2,
        (int)( ( $w - strlen($short) * $sw ) / 2 ),
        (int)( $h / 2 ) + $fh + 6,
        $short, $white
    );

    $tmp = sys_get_temp_dir() . '/edt_av_' . $post_id . '.jpg';
    imagejpeg( $im, $tmp, 85 );
    imagedestroy( $im );

    if ( ! file_exists( $tmp ) ) return;

    $file = [
        'name'     => 'avatar-' . str_pad( $idx, 2, '0', STR_PAD_LEFT ) . '.jpg',
        'type'     => 'image/jpeg',
        'tmp_name' => $tmp,
        'error'    => 0,
        'size'     => filesize( $tmp ),
    ];

    $att_id = media_handle_sideload( $file, $post_id, $name );
    @unlink( $tmp );

    if ( is_wp_error( $att_id ) ) {
        WP_CLI::warning( "  ✗  Avatar #{$idx}: " . $att_id->get_error_message() );
        return;
    }

    update_post_meta( $att_id, '_wp_attachment_image_alt', $name );
    set_post_thumbnail( $post_id, $att_id );
}

/**
 * Tạo ảnh placeholder bằng GD, import vào media library,
 * rồi lưu attachment ID vào post meta (hoặc option nếu $is_option=true).
 * Idempotent: bỏ qua nếu field đã có attachment hợp lệ.
 */
function seed_image( $post_id, $meta_key, $w, $h, $label, $alt, $is_option = false ) {
    $existing = $is_option
        ? get_option( $meta_key )
        : get_post_meta( $post_id, $meta_key, true );

    if ( $existing && wp_attachment_is_image( (int) $existing ) ) {
        return (int) $existing;
    }

    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    // ── Tạo ảnh placeholder bằng GD ──
    $im    = imagecreatetruecolor( $w, $h );
    $bg    = imagecolorallocate( $im, 12,  59,  46  ); // #0C3B2E emerald
    $gold  = imagecolorallocate( $im, 200, 162, 68  ); // #C8A244
    $white = imagecolorallocate( $im, 240, 235, 220 ); // #F0EBDC
    $grid  = imagecolorallocate( $im, 25,  72,  55  ); // subtle grid

    imagefill( $im, 0, 0, $bg );

    // Diagonal grid pattern
    for ( $i = -$h; $i < $w + $h; $i += 36 ) {
        imageline( $im, $i, 0, $i + $h, $h, $grid );
    }

    // Gold border
    imagerectangle( $im, 3, 3, $w - 4, $h - 4, $gold );

    // Center crosshair
    $cx = (int)( $w / 2 );
    $cy = (int)( $h / 2 );
    imageline( $im, $cx - 24, $cy, $cx + 24, $cy, $gold );
    imageline( $im, $cx, $cy - 24, $cx, $cy + 24, $gold );

    // Label (font 5 = largest built-in)
    $fw5 = imagefontwidth(5);
    $fh5 = imagefontheight(5);
    $fw3 = imagefontwidth(3);
    $dim = "{$w}x{$h}";
    $lx  = max( 6, (int)(( $w - strlen($label) * $fw5 ) / 2) );
    $sx  = max( 6, (int)(( $w - strlen($dim)   * $fw3 ) / 2) );

    imagestring( $im, 5, $lx, $cy - $fh5 - 8, $label, $gold );
    imagestring( $im, 3, $sx, $cy + 10,        $dim,   $white );

    $tmp = sys_get_temp_dir() . '/edt_ph_' . md5( $meta_key ) . '.jpg';
    imagejpeg( $im, $tmp, 85 );
    imagedestroy( $im );

    if ( ! file_exists( $tmp ) ) {
        WP_CLI::warning( "  ✗  {$meta_key}: GD imagejpeg failed" );
        return 0;
    }

    // ── Import vào media library ──
    $slug = trim( preg_replace( '/-+/', '-',
        str_replace( [ '_home_', '_dv1_', '_dv2_', '_dv3_', '_', 'edt-' ],
                     [ 'home-',  'dv1-',  'dv2-',  'dv3-',  '-', '' ],
                     ltrim( $meta_key, '_' ) )
    ), '-' );

    $file = [
        'name'     => "placeholder-{$slug}.jpg",
        'type'     => 'image/jpeg',
        'tmp_name' => $tmp,
        'error'    => 0,
        'size'     => filesize( $tmp ),
    ];

    $att_id = media_handle_sideload( $file, $is_option ? 0 : $post_id, $label );
    @unlink( $tmp );

    if ( is_wp_error( $att_id ) ) {
        WP_CLI::warning( "  ✗  {$meta_key}: " . $att_id->get_error_message() );
        return 0;
    }

    update_post_meta( $att_id, '_wp_attachment_image_alt', $alt );

    if ( $is_option ) {
        update_option( $meta_key, $att_id );
    } else {
        update_post_meta( $post_id, $meta_key, $att_id );
    }

    return $att_id;
}


/* ============================================================
   1. GLOBAL OPTIONS
   ============================================================ */
WP_CLI::log( '' );
WP_CLI::log( '1. Global options...' );

$options = [
    'edt_logo_text'         => 'Edina <span>Trâm</span>',
    'edt_header_cta_label'  => 'Đặt lịch Tư vấn',
    'edt_header_cta_url'    => '/lien-he',
    'edt_footer_tagline'    => 'Dẫn lối bình an, khai mở nội lực. Đồng hành cùng bạn trên hành trình kiến tạo cuộc sống chất lượng.',
    'edt_footer_copyright'  => '© 2026 Edina Trâm. All rights reserved.',
    'edt_contact_email'     => 'coachtram@gmail.com',
    'edt_contact_phone'     => '0901 234 567',
    'edt_social_facebook'   => 'https://facebook.com/coachtram',
    'edt_social_instagram'  => 'https://instagram.com/coachtram',
    'edt_social_youtube'    => 'https://youtube.com/@coachtram',
    'edt_social_website'    => 'https://coachtram.com',
    'edt_coach_name'        => 'Edina Trâm',
    'edt_coach_title'       => 'F&B Startup Coach · ICF PCC',
    'edt_coach_bio'         => 'Với hơn 16 năm kinh nghiệm trong ngành F&B và hành trình phát triển bản thân không ngừng, tôi tin rằng mỗi người đều sở hữu một nguồn nội lực phi thường. Sứ mệnh của tôi là đồng hành cùng bạn khơi dậy tiềm năng ấy, để bạn sống một cuộc đời ý nghĩa và trọn vẹn.',
];
foreach ( $options as $k => $v ) {
    update_option( $k, $v );
}
WP_CLI::log( '  ✓  ' . count( $options ) . ' options đã lưu' );


/* ============================================================
   2. TAXONOMY TERMS (program_cat)
   ============================================================ */
WP_CLI::log( '' );
WP_CLI::log( '2. Taxonomy terms...' );

$term_defs = [
    'home'      => 'Trang chủ',
    'dich-vu-1' => 'Passion to Profit',
    'dich-vu-2' => 'Business to Freedom',
    'dich-vu-3' => 'Business Mastery',
];
foreach ( $term_defs as $slug => $name ) {
    if ( ! term_exists( $slug, 'program_cat' ) ) {
        wp_insert_term( $name, 'program_cat', [ 'slug' => $slug ] );
        WP_CLI::log( "  ✓  Term: $name ($slug)" );
    } else {
        WP_CLI::log( "  ↩  Term đã có: $slug" );
    }
}


/* ============================================================
   3. PAGES
   ============================================================ */
WP_CLI::log( '' );
WP_CLI::log( '3. Pages...' );

$home_id = seed_page( 'Trang chủ', 'trang-chu' );
$dv1_id  = seed_page( 'Passion to Profit', 'dich-vu-1' );
$dv2_id  = seed_page( 'Business to Freedom', 'dich-vu-2' );
$dv3_id  = seed_page( 'Business Mastery', 'dich-vu-3' );
$ct_id   = seed_page( 'Liên hệ', 'lien-he' );

// Set front page
update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $home_id );
WP_CLI::log( "  ✓  Front page = ID $home_id" );


/* ============================================================
   4. HOME PAGE META
   ============================================================ */
WP_CLI::log( '' );
WP_CLI::log( '4. Home page meta...' );

seed_meta( $home_id, [
    // Hero
    '_home_hero_badge'          => 'COACHING · MINDFULNESS · TRANSFORMATION',
    '_home_hero_title'          => 'Dẫn lối bình an,<br>khai mở <em>nội lực.</em>',
    '_home_hero_desc'           => 'Đồng hành cùng bạn tìm lại sự rõ ràng trong tâm trí, tự tin trong hành động và sống một cuộc đời đúng với giá trị của chính mình.',
    '_home_hero_cta1_label'     => 'Khám phá dịch vụ',
    '_home_hero_cta1_url'       => '#services',
    '_home_hero_cta2_label'     => 'Tư vấn 1:1 miễn phí',
    '_home_hero_cta2_url'       => '/lien-he',
    '_home_hero_image_alt'      => 'Coach Edina Trâm',
    '_home_hero_value1_title'   => 'Chân thực',
    '_home_hero_value1_desc'    => 'Coaching từ trải nghiệm thực tế, không phải lý thuyết',
    '_home_hero_value2_title'   => 'Cá nhân hóa',
    '_home_hero_value2_desc'    => 'Mỗi hành trình đều được thiết kế riêng cho bạn',
    '_home_hero_value3_title'   => 'Chuyển hóa',
    '_home_hero_value3_desc'    => 'Kết quả đo lường được, thay đổi bền vững',
    '_home_hero_scroll_text'    => 'Cuộn xuống',

    // Services section
    '_home_srv_badge'           => 'Hệ sinh thái dịch vụ',
    '_home_srv_title'           => 'Ba chương trình chuyển hóa',
    '_home_srv_desc'            => 'Mỗi chương trình được thiết kế riêng biệt, phục vụ từng giai đoạn trên hành trình phát triển của bạn — từ đam mê cá nhân đến tự do tài chính.',
    '_home_srv1_num'            => '01',
    '_home_srv1_title'          => 'Passion to Profit',
    '_home_srv1_subtitle'       => 'Workshop 2 ngày',
    '_home_srv1_desc'           => 'Chuyển hóa đam mê thành mô hình kinh doanh có lợi nhuận. Tìm ra lợi thế cạnh tranh, xây dựng nền tảng vững chắc và bắt đầu hành trình khởi nghiệp đầy tự tin.',
    '_home_srv1_url'            => '/dich-vu-1',
    '_home_srv1_cta'            => 'Tìm hiểu thêm →',
    '_home_srv2_num'            => '02',
    '_home_srv2_title'          => 'Business to Freedom',
    '_home_srv2_subtitle'       => 'Khoá học 10 tuần',
    '_home_srv2_desc'           => 'Mở rộng quy mô doanh nghiệp, xây dựng hệ thống vận hành tự động và tạo ra cuộc sống tự do mà bạn hằng mơ ước — không cần phải hy sinh sức khỏe hay gia đình.',
    '_home_srv2_url'            => '/dich-vu-2',
    '_home_srv2_cta'            => 'Tìm hiểu thêm →',
    '_home_srv3_num'            => '03',
    '_home_srv3_title'          => 'Business Mastery',
    '_home_srv3_subtitle'       => 'Coaching 1:1 chiến lược',
    '_home_srv3_desc'           => 'Chương trình coaching cá nhân hóa dành cho doanh nhân muốn làm chủ mọi khía cạnh — từ chiến lược kinh doanh, lãnh đạo đội ngũ đến phát triển bản thân.',
    '_home_srv3_url'            => '/dich-vu-3',
    '_home_srv3_cta'            => 'Tìm hiểu thêm →',

    // About section
    '_home_about_badge'         => 'Người đồng hành',
    '_home_about_title'         => 'Chân thực. Thấu hiểu.<br>Truyền cảm hứng.',
    '_home_about_name'          => 'Edina Trâm',
    '_home_about_image_alt'     => 'Coach Edina Trâm',
    '_home_about_badge_overlay' => 'ICF PCC Coach',
    '_home_about_bio'           => 'Với hơn 16 năm kinh nghiệm trong ngành F&B và hành trình phát triển bản thân không ngừng, tôi tin rằng mỗi người đều sở hữu một nguồn nội lực phi thường. Sứ mệnh của tôi là đồng hành cùng bạn khơi dậy tiềm năng ấy, để bạn sống một cuộc đời ý nghĩa và trọn vẹn.',
    '_home_about_cred1'         => 'ICF PCC',
    '_home_about_cred2'         => '16+ Năm Kinh Nghiệm',
    '_home_about_cred3'         => 'F&B Expert',
    '_home_about_cred4'         => '50+ Doanh Nghiệp',
    '_home_about_stat1_num'     => '16',
    '_home_about_stat1_suffix'  => '+',
    '_home_about_stat1_label'   => 'Năm kinh nghiệm',
    '_home_about_stat2_num'     => '50',
    '_home_about_stat2_suffix'  => '+',
    '_home_about_stat2_label'   => 'Doanh nghiệp đồng hành',
    '_home_about_stat3_num'     => '1000',
    '_home_about_stat3_suffix'  => '+',
    '_home_about_stat3_label'   => 'Cuốn sách đã đọc',
    '_home_about_stat4_num'     => '3',
    '_home_about_stat4_suffix'  => '',
    '_home_about_stat4_label'   => 'Chương trình chuyển hóa',

    // Book section
    '_home_book_badge'          => 'Sách mới',
    '_home_book_title'          => 'Ánh Sáng Của Ước Mơ',
    '_home_book_desc'           => 'Cuốn sách chia sẻ hành trình chuyển hóa cá nhân và những bài học quý giá trên con đường kiến tạo cuộc sống ý nghĩa. Một nguồn cảm hứng cho bất kỳ ai đang tìm kiếm sự rõ ràng và mục đích sống.',
    '_home_book_image_alt'      => 'Sách Ánh Sáng Của Ước Mơ – Edina Trâm',
    '_home_book_cta1_label'     => 'Đặt sách ngay',
    '_home_book_cta1_url'       => 'https://tiki.vn',
    '_home_book_cta2_label'     => 'Xem thêm',
    '_home_book_cta2_url'       => '',

    // Testimonials section header
    '_home_testi_badge'         => 'Khách hàng nói gì',
    '_home_testi_title'         => 'Hành trình chuyển hóa thật sự',

    // Channels section
    '_home_channel_badge'       => 'Kết nối đa kênh',
    '_home_channel_title'       => 'Đi cùng Edina trên mọi nền tảng',
    '_home_ch1_title'           => 'Facebook',
    '_home_ch1_desc'            => 'Cộng đồng chia sẻ kiến thức, cảm hứng và kết nối hàng ngày cùng hàng nghìn doanh nhân.',
    '_home_ch2_title'           => 'YouTube',
    '_home_ch2_desc'            => 'Video chia sẻ chuyên sâu về coaching, mindfulness và phát triển bản thân cho doanh nhân.',
    '_home_ch3_title'           => 'Newsletter',
    '_home_ch3_desc'            => 'Nhận bài viết chuyên sâu, tài nguyên miễn phí và cập nhật mới nhất mỗi tuần qua email.',
    '_home_ch4_title'           => 'Edina Workspace',
    '_home_ch4_desc'            => 'Không gian làm việc và học tập trực tuyến dành riêng cho cộng đồng học viên Edina Trâm.',

    // Final CTA
    '_home_cta_badge'           => 'Bắt đầu hành trình',
    '_home_cta_title'           => 'Bạn đã sẵn sàng cho phiên bản<br>tuyệt vời nhất?',
    '_home_cta_desc'            => 'Đặt lịch tư vấn miễn phí để cùng tôi tìm ra chương trình phù hợp nhất cho hành trình chuyển hóa của bạn.',
    '_home_cta_label'           => 'Đặt lịch Tư vấn miễn phí',
    '_home_cta_url'             => '/lien-he',
] );
WP_CLI::log( '  ✓  Home meta OK' );


/* ============================================================
   5. DV1 — PASSION TO PROFIT
   ============================================================ */
WP_CLI::log( '' );
WP_CLI::log( '5. DV1 (Passion to Profit) meta...' );

seed_meta( $dv1_id, [
    // Sticky CTA
    '_dv1_sticky_title'         => 'Passion to Profit – Workshop',
    '_dv1_sticky_meta'          => '22–23/03/2026 · 2 ngày cuối tuần · 499.000 VNĐ',
    '_dv1_sticky_cta_label'     => 'Đăng Ký Ngay',
    '_dv1_sticky_cta_url'       => 'https://zalo.me/0901234567',

    // Hero
    '_dv1_hero_badge'           => 'WORKSHOP 2 NGÀY',
    '_dv1_hero_title'           => 'PASSION<br>TO <span>PROFIT</span>',
    '_dv1_hero_tagline'         => 'Chuyển đổi đam mê thành mô hình kinh doanh thực tế',
    '_dv1_hero_desc'            => 'Workshop thực chiến 2 ngày giúp bạn tìm ra giao điểm giữa đam mê, thế mạnh và nhu cầu thị trường – từ đó phác thảo mô hình kinh doanh đầu tiên có khả năng sinh lợi nhuận bền vững. Đồng hành bởi Coach Edina Trâm với hơn 15 năm kinh nghiệm thực chiến.',
    '_dv1_hero_duration'        => '2 ngày cuối tuần, 9:00–17:00',
    '_dv1_hero_date'            => '22–23/03/2026',
    '_dv1_hero_price'           => '499.000 VNĐ',
    '_dv1_hero_countdown'       => '2026-03-22T09:00:00',
    '_dv1_hero_cta_label'       => 'Đăng Ký Ngay →',
    '_dv1_hero_cta_url'         => 'https://zalo.me/0901234567',
    '_dv1_hero_scholarship'     => '🎓 <strong style="color:var(--color-primary)">Học bổng 50%</strong> dành cho sinh viên &amp; người mới bắt đầu. <a href="https://zalo.me/0901234567" style="color:var(--royal-gold);text-decoration:underline;">Liên hệ để biết thêm</a>',

    // Credibility
    '_dv1_cred_badge'           => 'UY TÍN & KINH NGHIỆM',
    '_dv1_cred_title'           => 'Người đồng hành thực chiến',
    '_dv1_cred_desc'            => 'Edina Trâm không chỉ chia sẻ lý thuyết – cô ấy đã sống, trải nghiệm và xây dựng từ con số không.',
    '_dv1_cred_stat1_num'       => '15',
    '_dv1_cred_stat1_label'     => 'Năm kinh nghiệm kinh doanh',
    '_dv1_cred_stat2_num'       => '9',
    '_dv1_cred_stat2_label'     => 'Năm xây dựng startup',
    '_dv1_cred_stat3_num'       => '1000',
    '_dv1_cred_stat3_label'     => 'Cuốn sách đã nghiên cứu',
    '_dv1_cred_stat4_num'       => '30',
    '_dv1_cred_stat4_label'     => 'Khách hàng được coaching',

    // Target
    '_dv1_target_badge'         => 'DÀNH CHO AI',
    '_dv1_target_title'         => 'Ai sẽ phù hợp với workshop này?',
    '_dv1_target1_desc'         => '<strong>Nhân viên văn phòng</strong> muốn thoát khỏi guồng quay 9-to-5 và bắt đầu công việc kinh doanh từ đam mê cá nhân.',
    '_dv1_target2_desc'         => '<strong>Freelancer &amp; người tự do</strong> có kỹ năng nhưng chưa biết cách biến nó thành nguồn thu nhập ổn định, có hệ thống.',
    '_dv1_target3_desc'         => '<strong>Người trẻ khởi nghiệp</strong> nhiều ý tưởng nhưng không biết bắt đầu từ đâu, cần một lộ trình rõ ràng để hành động.',
    '_dv1_target4_desc'         => '<strong>Phụ nữ muốn độc lập tài chính</strong> – xây dựng thu nhập riêng bên cạnh gia đình mà không đánh đổi cuộc sống.',
    '_dv1_target5_desc'         => '<strong>Người đang chuyển giao sự nghiệp</strong> – muốn tìm lại mục đích và xây dựng điều gì đó có ý nghĩa hơn.',
    '_dv1_target6_desc'         => '<strong>Bất kỳ ai có đam mê</strong> nhưng chưa dám hành động – Workshop sẽ cho bạn sự tự tin và bước đi đầu tiên.',

    // Benefits
    '_dv1_benefit_badge'        => 'GIÁ TRỊ NHẬN ĐƯỢC',
    '_dv1_benefit_title'        => 'Bạn sẽ đạt được gì sau 2 ngày?',
    '_dv1_ben1_icon'            => '🔍',
    '_dv1_ben1_title'           => 'Khám phá giao điểm vàng',
    '_dv1_ben1_desc'            => 'Tìm ra nơi đam mê, thế mạnh và nhu cầu thị trường gặp nhau – giao điểm sinh lợi nhuận bền vững nhất.',
    '_dv1_ben2_icon'            => '🧭',
    '_dv1_ben2_title'           => 'Xác định khách hàng mục tiêu',
    '_dv1_ben2_desc'            => 'Hiểu rõ khách hàng lý tưởng, nỗi đau của họ và cách bạn giải quyết được vấn đề của họ tốt hơn ai hết.',
    '_dv1_ben3_icon'            => '📐',
    '_dv1_ben3_title'           => 'Phác thảo mô hình kinh doanh',
    '_dv1_ben3_desc'            => 'Xây dựng Business Model Canvas đầu tiên – nền tảng để biến ý tưởng thành doanh nghiệp thực tế có doanh thu.',
    '_dv1_ben4_icon'            => '💡',
    '_dv1_ben4_title'           => 'Tư duy doanh nhân thực chiến',
    '_dv1_ben4_desc'            => 'Chuyển đổi từ tư duy nhân viên sang tư duy doanh nhân – biết cách nghĩ, ra quyết định và hành động.',
    '_dv1_ben5_icon'            => '📋',
    '_dv1_ben5_title'           => 'Kế hoạch hành động 90 ngày',
    '_dv1_ben5_desc'            => 'Ra về với bản kế hoạch 90 ngày chi tiết – biết chính xác phải làm gì mỗi tuần để tiến đến mục tiêu.',
    '_dv1_ben6_icon'            => '🤝',
    '_dv1_ben6_title'           => 'Cộng đồng & hỗ trợ sau workshop',
    '_dv1_ben6_desc'            => 'Tham gia cộng đồng học viên cùng chí hướng, được hỗ trợ và kết nối lâu dài sau khóa học.',

    // Modules
    '_dv1_mod_badge'            => 'NỘI DUNG WORKSHOP',
    '_dv1_mod_title'            => 'Nội dung chi tiết',
    '_dv1_mod1_label'           => 'WHY',
    '_dv1_mod1_title'           => 'Tại sao bắt đầu?',
    '_dv1_mod1_desc'            => 'Khám phá động lực sâu xa đằng sau mong muốn kinh doanh của bạn. Xác định giá trị cốt lõi, đam mê thực sự và "ikigai" cá nhân. Hiểu rõ tại sao đây là thời điểm phù hợp để bắt đầu – và vượt qua nỗi sợ hãi "mình không đủ giỏi" để dám hành động.',
    '_dv1_mod2_label'           => 'WHAT',
    '_dv1_mod2_title'           => 'Xây dựng mô hình',
    '_dv1_mod2_desc'            => 'Nghiên cứu thị trường và tìm ngách kinh doanh phù hợp. Xây dựng chân dung khách hàng lý tưởng (Customer Avatar). Thiết kế sản phẩm/dịch vụ đầu tiên, định giá và xây dựng Business Model Canvas hoàn chỉnh. Phác thảo chiến lược marketing ban đầu.',
    '_dv1_mod3_label'           => "WHAT'S NEXT",
    '_dv1_mod3_title'           => 'Hành động ngay',
    '_dv1_mod3_desc'            => 'Xây dựng kế hoạch hành động 90 ngày chi tiết. Thiết lập hệ thống theo dõi tiến độ và KPI đo lường. Cam kết hành động với nhóm accountability partner. Nhận feedback trực tiếp từ Coach Edina Trâm và cộng đồng.',

    // Testimonials header
    '_dv1_testi_badge'          => 'PHẢN HỒI HỌC VIÊN',
    '_dv1_testi_title'          => 'Học viên nói gì',

    // Instructor
    '_dv1_inst_cred1_num'       => '15+',
    '_dv1_inst_cred1_text'      => 'Năm kinh nghiệm kinh doanh và tư vấn chiến lược',
    '_dv1_inst_cred2_num'       => '9+',
    '_dv1_inst_cred2_text'      => 'Năm trực tiếp xây dựng và vận hành startup',
    '_dv1_inst_cred3_num'       => 'ICF',
    '_dv1_inst_cred3_text'      => 'Chứng chỉ coaching quốc tế từ International Coach Federation',
    '_dv1_inst_cred4_num'       => '30+',
    '_dv1_inst_cred4_text'      => 'Khách hàng cá nhân được coaching 1:1 thành công',
    '_dv1_inst_cred5_num'       => '🎤',
    '_dv1_inst_cred5_text'      => 'Diễn giả tại nhiều sự kiện khởi nghiệp và hội thảo doanh nhân',

    // FAQ header
    '_dv1_faq_badge'            => 'GIẢI ĐÁP THẮC MẮC',
    '_dv1_faq_title'            => 'Câu hỏi thường gặp',

    // CTA Final
    '_dv1_cta_quote'            => '"Thời điểm tốt nhất để bắt đầu là 20 năm trước. Thời điểm tốt thứ hai là ngay bây giờ."',
    '_dv1_cta_title'            => 'Đừng chờ đến khi "sẵn sàng" –<br>hãy bắt đầu và trở nên sẵn sàng.',
    '_dv1_cta_desc'             => 'Chỉ 2 ngày, bạn sẽ có tất cả những gì cần thiết để biến đam mê thành lợi nhuận. Hãy để Coach Edina Trâm đồng hành cùng bạn trên hành trình này.',
    '_dv1_cta_label'            => 'Đăng Ký Workshop Ngay →',
    '_dv1_cta_url'              => 'https://zalo.me/0901234567',
    '_dv1_cta_phone'            => '0901 234 567',
] );
WP_CLI::log( '  ✓  DV1 meta OK' );


/* ============================================================
   6. DV2 — BUSINESS TO FREEDOM
   ============================================================ */
WP_CLI::log( '' );
WP_CLI::log( '6. DV2 (Business to Freedom) meta...' );

seed_meta( $dv2_id, [
    // Sticky
    '_dv2_sticky_title'         => 'Business to Freedom – 10 tuần',
    '_dv2_sticky_meta'          => 'Khai giảng 27/03/2026 · Chỉ 10 chỗ',
    '_dv2_sticky_cta_label'     => 'Giữ Chỗ Ngay',
    '_dv2_sticky_cta_url'       => 'https://zalo.me/coachtram',

    // Hero
    '_dv2_hero_badge'           => 'KHOÁ HỌC 10 TUẦN',
    '_dv2_hero_title'           => 'BUSINESS<br>to <span>FREEDOM</span>',
    '_dv2_hero_tagline'         => 'Từ vận hành đến tự do — Xây dựng doanh nghiệp bền vững',
    '_dv2_hero_desc'            => 'Đam mê và Lợi nhuận là nền tảng, nhưng Tự do mới là đích đến. Hãy để chương trình 10 tuần Business to Freedom dẫn bạn đến nơi đó.',
    '_dv2_hero_schedule'        => '10 buổi · 3h/buổi',
    '_dv2_hero_date'            => '27/03 – 29/05/2026',
    '_dv2_hero_price'           => '15.000.000 VNĐ',
    '_dv2_hero_max_note'        => '* Khoá học chỉ nhận tối đa 10 học viên để đảm bảo chất lượng',
    '_dv2_hero_countdown'       => '2026-03-27T10:00:00',
    '_dv2_hero_cta_label'       => 'ĐĂNG KÝ NGAY',
    '_dv2_hero_cta_url'         => 'https://zalo.me/coachtram',

    // Pain
    '_dv2_pain_badge'           => 'Bạn có đang gặp phải?',
    '_dv2_pain_title'           => 'Bạn có đang đối diện với những vấn đề này?',
    '_dv2_pain1_title'          => 'ĐAM MÊ NHƯNG MƠ HỒ',
    '_dv2_pain1_desc'           => 'Bạn yêu ẩm thực, mơ một ngày có quán riêng. Nhưng khi bắt tay vào, bạn không biết viết kế hoạch ra sao, vốn bao nhiêu là đủ, và khách hàng mục tiêu thực sự là ai.',
    '_dv2_pain2_title'          => 'DOANH THU BẤP BÊNH',
    '_dv2_pain2_desc'           => 'Quán của bạn có ngày đông khách, có ngày lại vắng hoe. Dù làm rất nhiều nhưng cuối tháng nhìn vào sổ sách thì lời lãi chẳng thấy đâu.',
    '_dv2_pain3_title'          => 'CHI PHÍ ĐỘI LÊN',
    '_dv2_pain3_desc'           => 'Tiền thuê mặt bằng, nhân sự, nguyên liệu... liên tục "ăn mòn" lợi nhuận. Bạn thấy dòng tiền chảy ra nhiều hơn chảy vào nhưng không rõ nguyên nhân.',
    '_dv2_pain4_title'          => 'NHÂN SỰ BẤT ỔN',
    '_dv2_pain4_desc'           => 'Nhân viên mới vào rồi lại nghỉ. Bạn vừa đào tạo xong một người thì họ lại bỏ đi. Quán thiếu người, còn bạn thì kiệt sức vì phải làm tất cả mọi việc.',
    '_dv2_pain5_title'          => 'BỊ CUỐN 24/7',
    '_dv2_pain5_desc'           => 'Bạn giống như "nô lệ" của quán mình. Ngày nào cũng quần quật, không còn thời gian cho gia đình, bạn bè, hay cho chính bản thân.',
    '_dv2_pain6_title'          => 'THẤT BẠI VÀ HOANG MANG',
    '_dv2_pain6_desc'           => 'Có thể bạn đã từng đóng cửa một quán trước đây. Nỗi đau còn đó, và bạn vẫn tự hỏi: "Nếu mình làm lại lần nữa, liệu có khác không?"',

    // Target
    '_dv2_target_badge'         => 'Dành cho bạn',
    '_dv2_target_title'         => 'Chương trình này dành cho bạn nếu',
    '_dv2_target1_title'        => 'NGƯỜI CHUẨN BỊ KHỞI NGHIỆP F&B',
    '_dv2_target1_desc'         => 'Bạn có <strong>đam mê nhưng chưa bắt đầu</strong>. Bạn muốn đi bài bản ngay từ đầu, có bản đồ rõ ràng để tiết kiệm thời gian, tiền bạc.',
    '_dv2_target2_title'        => 'CHỦ QUÁN ĐANG VẬN HÀNH',
    '_dv2_target2_desc'         => 'Bạn đã khởi sự kinh doanh, nhưng đang <strong>loay hoay với doanh thu, chi phí và nhân sự</strong>. Bạn muốn tìm một cách vận hành bài bản để quán ổn định, lợi nhuận rõ ràng.',
    '_dv2_target3_title'        => 'TỪNG THẤT BẠI & MUỐN LÀM LẠI',
    '_dv2_target3_desc'         => 'Bạn đã <strong>từng đóng cửa một quán</strong> nhưng vẫn đam mê khởi nghiệp với một lộ trình có hệ thống, với sự đồng hành của một coach thực chiến.',
    '_dv2_target4_title'        => 'NGƯỜI KHAO KHÁT TỰ DO',
    '_dv2_target4_desc'         => 'Bạn muốn <strong>xây dựng một mô hình kinh doanh có lợi nhuận bền vững</strong> để bạn vừa kinh doanh hiệu quả, vừa có một cuộc đời tự do.',

    // MMF
    '_dv2_mmf_badge'            => 'Lợi ích',
    '_dv2_mmf_title'            => '3 Trụ cột giá trị',
    '_dv2_mmf_desc'             => 'Mỗi trụ cột giúp bạn xây dựng nền tảng vững chắc cho hành trình kinh doanh bền vững.',
    '_dv2_mmf1_letter'          => 'M',
    '_dv2_mmf1_title'           => 'MONEY – Tiền',
    '_dv2_mmf1_desc'            => 'Bạn học cách xây dựng một mô hình kinh doanh có lợi nhuận rõ ràng. Biết quản lý chi phí, định giá đúng, kiểm soát Prime Cost, và tạo ra dòng tiền ổn định.',
    '_dv2_mmf2_letter'          => 'M',
    '_dv2_mmf2_title'           => 'MEANING – Ý nghĩa',
    '_dv2_mmf2_desc'            => 'Kinh doanh không chỉ là bán món ăn. Đó là hành trình bạn gửi gắm niềm đam mê, giá trị và dấu ấn cá nhân, để mỗi bữa ăn trở thành một trải nghiệm mang ý nghĩa.',
    '_dv2_mmf3_letter'          => 'F',
    '_dv2_mmf3_title'           => 'FREEDOM – Tự do',
    '_dv2_mmf3_desc'            => 'Không còn bị trói chặt 24/7 trong quán. Với kế hoạch, đội ngũ và quy trình rõ ràng, bạn có thể vừa vận hành kinh doanh, vừa tận hưởng tự do.',

    // Diff
    '_dv2_diff_badge'           => 'Vì sao khác biệt?',
    '_dv2_diff_title'           => 'Đây không phải khoá học thông thường',
    '_dv2_diff_neg_title'       => 'Không phải khoá học thông thường',
    '_dv2_diff_neg1'            => 'Không phải kiến thức lý thuyết sách vở, xa rời thực tế',
    '_dv2_diff_neg2'            => 'Không phải lớp học đại trà hàng trăm người, không ai hỏi thăm ai',
    '_dv2_diff_neg3'            => 'Không phải hứa hẹn thành công dễ dàng hay công thức "làm giàu nhanh"',
    '_dv2_diff_neg4'            => 'Không phải giảng dạy từ người chưa từng kinh doanh thực tế',
    '_dv2_diff_pos_title'       => 'Thay vào đó, bạn nhận được',
    '_dv2_diff_pos1'            => 'Kiến thức thực chiến từ 15+ năm kinh nghiệm F&B tại Mỹ và Việt Nam',
    '_dv2_diff_pos2'            => 'Lớp học chỉ tối đa 10 người, được coaching sâu sát từng mô hình',
    '_dv2_diff_pos3'            => 'Bộ template chuẩn: P&L, Menu Engineering, SOP, Lean Canvas',
    '_dv2_diff_pos4'            => 'Cộng đồng chủ quán F&B đồng hành lâu dài sau khoá học',

    // Curriculum
    '_dv2_cur_badge'            => 'Lộ trình',
    '_dv2_cur_title'            => 'Hành trình 10 tuần',
    '_dv2_cur_desc'             => 'Mỗi tuần đi sâu vào một trụ cột trong khung chiến lược 5P để bạn xây dựng mô hình bền vững.',
    '_dv2_cur_focus1'           => 'Purpose',
    '_dv2_cur_focus2'           => 'People',
    '_dv2_cur_focus3'           => 'Product',
    '_dv2_cur_focus4'           => 'Profit',
    '_dv2_cur_focus5'           => 'Peace',
    '_dv2_cur_w1_label'         => 'Tuần 1',
    '_dv2_cur_w1_title'         => 'Passion – Vai trò chủ doanh nghiệp',
    '_dv2_cur_w1_desc'          => 'Xác định rõ vai trò người chủ, vẽ bản đồ đam mê và kiểm tra mức độ sẵn sàng khởi nghiệp F&B.',
    '_dv2_cur_w2_label'         => 'Tuần 2',
    '_dv2_cur_w2_title'         => 'Plan – Khởi điểm & mô hình',
    '_dv2_cur_w2_desc'          => 'Lựa chọn mô hình kinh doanh phù hợp, phát triển ý tưởng từ đam mê thành kế hoạch cụ thể.',
    '_dv2_cur_w3_label'         => 'Tuần 3',
    '_dv2_cur_w3_title'         => 'Plan – Kế hoạch tài chính',
    '_dv2_cur_w3_desc'          => 'Dự toán vốn đầu tư, tính toán điểm hoà vốn, xây dựng bản kế hoạch kinh doanh khả thi.',
    '_dv2_cur_w4_label'         => 'Tuần 4',
    '_dv2_cur_w4_title'         => 'Product – Thực đơn chiến lược',
    '_dv2_cur_w4_desc'          => 'Xây dựng menu, định giá từng món, thiết kế thực đơn để vừa thu hút khách vừa đảm bảo lợi nhuận.',
    '_dv2_cur_w5_label'         => 'Tuần 5',
    '_dv2_cur_w5_title'         => 'Product – Mặt bằng & Trải nghiệm',
    '_dv2_cur_w5_desc'          => 'Chọn mặt bằng phù hợp, thiết kế trải nghiệm khách hàng độc đáo để tạo dấu ấn thương hiệu.',
    '_dv2_cur_w6_label'         => 'Tuần 6',
    '_dv2_cur_w6_title'         => 'People – Năng lực & mục tiêu',
    '_dv2_cur_w6_desc'          => 'Phân tích năng lực bản thân ở vai trò chủ doanh nghiệp, xác định mục tiêu phát triển.',
    '_dv2_cur_w7_label'         => 'Tuần 7',
    '_dv2_cur_w7_title'         => 'People – Kế hoạch nhân sự',
    '_dv2_cur_w7_desc'          => 'Xây dựng JD, sơ đồ đội nhóm ban đầu và kế hoạch tuyển dụng – đào tạo nhân sự hiệu quả.',
    '_dv2_cur_w8_label'         => 'Tuần 8',
    '_dv2_cur_w8_title'         => 'Process – Hệ thống SOP',
    '_dv2_cur_w8_desc'          => 'Thiết kế quy trình chuẩn FOH, BOH và toàn quán để nhân sự vận hành trơn tru, giảm thất thoát.',
    '_dv2_cur_w9_label'         => 'Tuần 9',
    '_dv2_cur_w9_title'         => 'Profit – Chỉ số tài chính',
    '_dv2_cur_w9_desc'          => 'Nắm vững các chỉ số tài chính cốt lõi, công thức lợi nhuận, báo cáo P&L và Menu Engineering.',
    '_dv2_cur_w10_label'        => 'Tuần 10',
    '_dv2_cur_w10_title'        => 'Tổng kết & Định hướng',
    '_dv2_cur_w10_desc'         => 'Thuyết trình thành quả 10 tuần, nhận phản hồi từ coach và cộng đồng, định hướng bước tiếp theo.',

    // Testimonials header
    '_dv2_testi_badge'          => 'Học viên nói gì',
    '_dv2_testi_title'          => 'Học viên nói gì về Business to Freedom?',

    // Instructor
    '_dv2_inst_cred1'           => '16 năm trong lĩnh vực kinh doanh & Hospitality tại Mỹ và Việt Nam',
    '_dv2_inst_cred2'           => '10 năm khởi nghiệp: Đồng sáng lập & điều hành Edina Workspace – chuỗi nhà hàng Mỹ tại Hà Nội',
    '_dv2_inst_cred3'           => 'ICF PCC Coach: Top 80 người Việt đạt chứng nhận quốc tế Coach chuyên nghiệp. Đồng hành 50+ chủ doanh nghiệp',
    '_dv2_inst_cred4'           => 'Tác giả sách <em>Ánh sáng của ước mơ</em>, đã bán hơn 1.000 bản, truyền cảm hứng cho người trẻ khởi nghiệp',

    // FAQ header
    '_dv2_faq_badge'            => 'FAQ',
    '_dv2_faq_title'            => 'Câu hỏi thường gặp',

    // CTA Final
    '_dv2_cta_title'            => 'Bắt đầu hành trình<br>từ Đam mê đến Tự do',
    '_dv2_cta_desc'             => 'Khai giảng 27/03/2026 – Chỉ 10 chỗ/khoá. Đăng ký ngay để giữ suất cho hành trình 10 tuần đầy giá trị.',
    '_dv2_cta_label'            => 'Nhắn Zalo Giữ Chỗ',
    '_dv2_cta_url'              => 'https://zalo.me/coachtram',
    '_dv2_cta_note'             => '📅 27/03 – 29/05/2026 &nbsp;·&nbsp; 🕘 Thứ 6 hàng tuần &nbsp;·&nbsp; 💰 15.000.000 VNĐ',
] );
WP_CLI::log( '  ✓  DV2 meta OK' );


/* ============================================================
   7. DV3 — BUSINESS MASTERY
   ============================================================ */
WP_CLI::log( '' );
WP_CLI::log( '7. DV3 (Business Mastery) meta...' );

seed_meta( $dv3_id, [
    // Sticky
    '_dv3_sticky_title'         => 'Business Mastery – Coaching 1:1',
    '_dv3_sticky_cta_label'     => 'Liên hệ ngay',
    '_dv3_sticky_cta_url'       => '/lien-he',

    // Hero
    '_dv3_hero_badge'           => 'COACHING 1:1 CHIẾN LƯỢC DÀI HẠN',
    '_dv3_hero_title'           => 'BUSINESS<br><span>MASTERY</span>',
    '_dv3_hero_tagline'         => 'Khai vấn chiến lược 1:1 cho doanh nhân F&B',
    '_dv3_hero_desc'            => 'Chương trình coaching cá nhân hoá cao cấp nhất, nơi bạn được đồng hành 1:1 cùng Coach Edina Trâm để giải quyết các bài toán chiến lược riêng biệt của doanh nghiệp, từ mở rộng quy mô, tối ưu hệ thống đến xây dựng thương hiệu bền vững trong ngành F&B.',
    '_dv3_hero_gift'            => '🎁 Tặng buổi tư vấn chiến lược $200 cho 3 khách đăng ký sớm nhất',
    '_dv3_hero_cta_label'       => 'ĐĂNG KÝ TƯ VẤN 1:1',
    '_dv3_hero_cta_url'         => '/lien-he',

    // Pain
    '_dv3_pain_badge'           => 'THÁCH THỨC',
    '_dv3_pain_title'           => 'Bạn đang đối mặt với những bài toán này?',
    '_dv3_pain_desc'            => 'Khi doanh nghiệp đã vượt qua giai đoạn khởi sự, những thách thức mới ở tầm chiến lược bắt đầu xuất hiện.',
    '_dv3_pain1_title'          => 'DOANH THU CHẠM TRẦN',
    '_dv3_pain1_desc'           => 'Bạn đã có doanh thu ổn, nhưng không thể tăng trưởng thêm. Mọi nỗ lực dường như chỉ giữ nguyên hiện trạng mà không tạo ra đột phá đáng kể nào.',
    '_dv3_pain2_title'          => 'HỆ THỐNG KHÔNG SCALE ĐƯỢC',
    '_dv3_pain2_desc'           => 'Mở thêm chi nhánh nhưng lợi nhuận không tăng tương xứng. Quy trình vận hành phụ thuộc quá nhiều vào bạn, không thể nhân bản.',
    '_dv3_pain3_title'          => 'TEAM QUẢN LÝ YẾU',
    '_dv3_pain3_desc'           => 'Đội ngũ giỏi chuyên môn nhưng thiếu tư duy quản trị. Bạn là người duy nhất ra quyết định và thường xuyên phải "chữa cháy" liên tục.',
    '_dv3_pain4_title'          => 'THƯƠNG HIỆU MỜ NHẠT',
    '_dv3_pain4_desc'           => 'Giữa thị trường F&B ngày càng cạnh tranh, thương hiệu của bạn thiếu điểm khác biệt rõ ràng. Khách hàng đến rồi đi mà không gắn bó lâu dài.',
    '_dv3_pain5_title'          => 'CHỦ DOANH NGHIỆP CÔ ĐƠN',
    '_dv3_pain5_desc'           => 'Bạn không có ai để trao đổi ở cùng tầm. Những quyết định lớn – mở rộng, nhượng quyền, tái cấu trúc – bạn phải tự mình gánh vác.',

    // Target
    '_dv3_target_badge'         => 'DÀNH CHO AI',
    '_dv3_target_title'         => 'Business Mastery dành cho bạn nếu…',
] );
WP_CLI::log( '  ✓  DV3 meta OK' );


/* ============================================================
   8. CONTACT PAGE META
   ============================================================ */
WP_CLI::log( '' );
WP_CLI::log( '8. Contact page meta...' );

seed_meta( $ct_id, [
    '_contact_hero_badge'       => 'Liên hệ',
    '_contact_hero_title'       => 'Hãy kết nối cùng tôi',
    '_contact_hero_desc'        => 'Buổi tư vấn đầu tiên hoàn toàn miễn phí — không có cam kết.',
    '_contact_info_badge'       => 'Thông tin',
    '_contact_info_title'       => 'Tôi muốn lắng nghe bạn',
    '_contact_info_desc'        => 'Đừng ngần ngại liên hệ qua bất kỳ kênh nào bạn thấy tiện nhất. Tôi sẽ phản hồi trong vòng 24 giờ.',
    '_contact_info_hours'       => 'Thứ 2 – Thứ 7, 8:00 – 21:00',
    '_contact_form_badge'       => 'Gửi tin nhắn',
    '_contact_form_title'       => 'Đặt lịch tư vấn miễn phí',
    '_contact_form_lead'        => 'Điền thông tin bên dưới và tôi sẽ liên hệ lại với bạn sớm nhất có thể.',
    '_contact_form_note'        => 'Tôi sẽ phản hồi trong vòng 24 giờ. Thông tin của bạn được bảo mật tuyệt đối.',
] );
WP_CLI::log( '  ✓  Contact meta OK' );


/* ============================================================
   9. TESTIMONIALS (edina_testimonial CPT)
   ============================================================ */
WP_CLI::log( '' );
WP_CLI::log( '9. Testimonials...' );

$testimonials = [
    // ── Home ──
    [
        'title'   => 'Nguyễn Thị Hảo Hảo',
        'content' => 'Trước khi gặp Coach Edina Trâm, tôi đã loay hoay với dự án F&B của mình gần 2 năm mà không có hướng đi rõ ràng. Sau khi được coaching, tôi đã tìm ra định hướng chiến lược rõ ràng và tự tin bước tiếp. Cảm ơn cô đã giúp tôi nhìn thấy tiềm năng của chính mình.',
        'role'    => 'Chủ quán cà phê, Hà Nội',
        'cat'     => 'home',
    ],
    [
        'title'   => 'Lý Khánh Lê',
        'content' => 'Coaching với Edina Trâm là một trong những quyết định đúng đắn nhất tôi từng làm. Chỉ sau 3 buổi, tôi đã có bản kế hoạch hành động cụ thể và lần đầu tiên cảm thấy mình thực sự biết mình đang đi đâu trong hành trình kinh doanh.',
        'role'    => 'Founder startup F&B, TP.HCM',
        'cat'     => 'home',
    ],
    [
        'title'   => 'Trần Thị Lý Ly',
        'content' => 'Tôi đã tham gia nhiều khóa học về kinh doanh nhưng Business to Freedom của Coach Edina là khóa thực tế và có chiều sâu nhất. Sau khóa học, doanh thu quán tôi tăng 40% trong 3 tháng tiếp theo. Không chỉ là kiến thức, cô còn truyền cho tôi nguồn năng lượng để tiếp tục tiến lên.',
        'role'    => 'Chủ chuỗi ăn uống, 3 chi nhánh',
        'cat'     => 'home',
    ],
    [
        'title'   => 'Vũ Thị Thu Hà',
        'content' => 'Workshop Passion to Profit đã thay đổi hoàn toàn cách tôi nhìn nhận bản thân và công việc kinh doanh. Tôi tìm ra được "ikigai" của mình – giao điểm giữa đam mê, thế mạnh và nhu cầu thị trường. Đây là khoản đầu tư tốt nhất tôi từng bỏ ra.',
        'role'    => 'Entrepreneur & Blogger ẩm thực',
        'cat'     => 'home',
    ],

    // ── DV1 ──
    [
        'title'   => 'Chú Phúc Nga',
        'content' => 'Tôi đến workshop với đầy hoài nghi, nhưng ra về với bản Business Model Canvas hoàn chỉnh cho quán bún riêu mà tôi đã mơ ước 5 năm nay. Coach Edina có cách lắng nghe và đặt câu hỏi rất sắc bén, giúp tôi tự tìm ra câu trả lời thay vì chỉ nghe giảng lý thuyết.',
        'role'    => 'Chủ quán bún riêu – Hải Phòng',
        'cat'     => 'dich-vu-1',
    ],
    [
        'title'   => 'Nguyễn Hoàng Lâm',
        'content' => 'Sau 2 ngày workshop, tôi đã có một bản kế hoạch 90 ngày rõ ràng. Tuần đầu tiên về nhà tôi đã thực hiện ngay 3 bước đầu tiên và thấy kết quả ngay. Workshop không chỉ cho tôi kiến thức mà còn cho tôi sự tự tin để bắt đầu.',
        'role'    => 'Nhân viên văn phòng chuyển sang khởi nghiệp',
        'cat'     => 'dich-vu-1',
    ],
    [
        'title'   => 'Ngô Thị Thùy Nga',
        'content' => 'Là người theo đuổi đam mê nấu ăn từ nhỏ nhưng không biết biến nó thành tiền, workshop Passion to Profit đã cho tôi đúng những gì mình cần. 6 tháng sau workshop, tôi đã ra mắt thương hiệu bánh homemade và có doanh thu ổn định.',
        'role'    => 'Chủ thương hiệu bánh ngọt handmade',
        'cat'     => 'dich-vu-1',
    ],
    [
        'title'   => 'Điềm Trương',
        'content' => 'Tôi đã từng nghĩ coaching là xa xỉ và không thiết thực. Nhưng buổi workshop của Coach Edina đã thay đổi quan điểm của tôi hoàn toàn. Rất thực tế, rất cụ thể và đầy cảm hứng. Tôi đã giới thiệu cho 4 người bạn tham gia sau đó.',
        'role'    => 'Freelancer & Food Photographer',
        'cat'     => 'dich-vu-1',
    ],

    // ── DV2 ──
    [
        'title'   => 'Caolan Bùi',
        'content' => 'Business to Freedom đã thay đổi hoàn toàn cách tôi vận hành quán. Trước đây tôi làm 14 tiếng/ngày mà vẫn không đủ. Sau khoá học, tôi xây dựng được SOP rõ ràng, đội nhóm chạy tốt và tôi chỉ cần 6 tiếng/ngày để quản lý. Lợi nhuận tăng 30%.',
        'role'    => 'Chủ nhà hàng buffet nướng, 2 chi nhánh',
        'cat'     => 'dich-vu-2',
    ],
    [
        'title'   => 'Phạm Hiếu',
        'content' => 'Tôi đã từng thất bại với một quán cafe trước đây và mất gần 300 triệu. Nhưng sau khoá Business to Freedom, tôi hiểu mình đã sai ở đâu. Quán thứ 2 của tôi mở ra với bản kế hoạch bài bản hơn và sau 6 tháng đã hòa vốn – nhanh hơn dự kiến 3 tháng.',
        'role'    => 'Chủ quán cà phê rang xay thủ công',
        'cat'     => 'dich-vu-2',
    ],
    [
        'title'   => 'Thanh Nga Trần',
        'content' => 'Coach Edina không chỉ dạy kinh doanh mà còn dạy tôi cách làm chủ cuộc sống. Khóa học giúp tôi xây dựng hệ thống để quán có thể chạy mà không cần tôi có mặt hàng ngày. Tôi đã lấy lại được thời gian cho gia đình sau 3 năm bị "giam cầm" trong quán.',
        'role'    => 'Chủ chuỗi trà sữa 4 cửa hàng',
        'cat'     => 'dich-vu-2',
    ],
    [
        'title'   => 'Lê Quỳnh',
        'content' => 'Sau 10 tuần với Coach Edina, tôi đã có một bộ tài liệu kinh doanh hoàn chỉnh: Business Plan, P&L dự phóng 12 tháng, SOP vận hành và kế hoạch marketing. Đây là nền tảng để tôi tiếp cận nhà đầu tư và mở rộng quy mô.',
        'role'    => 'Startup F&B đang gọi vốn',
        'cat'     => 'dich-vu-2',
    ],

    // ── DV3 ──
    [
        'title'   => 'Phương Na Bi',
        'content' => 'Coaching 1:1 với Edina Trâm là khoản đầu tư lớn nhất tôi từng bỏ ra cho bản thân, và nó xứng đáng từng đồng. Chỉ sau 4 tháng coaching, tôi đã tái cơ cấu hoàn toàn doanh nghiệp, tăng biên lợi nhuận từ 8% lên 22% và xây dựng được đội ngũ management đáng tin cậy.',
        'role'    => 'CEO chuỗi nhà hàng fine dining, 5 chi nhánh',
        'cat'     => 'dich-vu-3',
    ],
    [
        'title'   => 'Lê Quốc Minh',
        'content' => 'Điều tôi trân trọng nhất ở Coach Edina là cô ấy không đưa ra giải pháp sẵn có. Cô ấy giúp tôi tự khám phá ra câu trả lời phù hợp với doanh nghiệp của mình. Sau 6 tháng coaching, tôi đã nhượng quyền thành công chi nhánh đầu tiên và đang trong quá trình mở thêm 3 chi nhánh nữa.',
        'role'    => 'Founder thương hiệu F&B nhượng quyền',
        'cat'     => 'dich-vu-3',
    ],
    [
        'title'   => 'Lâu Lan Anh',
        'content' => 'Tôi tìm đến Business Mastery vì đang ở ngưỡng cửa của một quyết định lớn: mở rộng hay thu hẹp. Coach Edina giúp tôi nhìn rõ bức tranh toàn cảnh và đưa ra quyết định tự tin. Doanh nghiệp của tôi hiện tại đang trong giai đoạn tăng trưởng tốt nhất từ trước đến nay.',
        'role'    => 'Chủ doanh nghiệp F&B 10 năm kinh nghiệm',
        'cat'     => 'dich-vu-3',
    ],
];

$testi_count = 0;
foreach ( $testimonials as $t ) {
    $id = seed_post( 'edina_testimonial', $t['title'], $t['content'],
        [ '_testimonial_role' => $t['role'] ],
        [ 'program_cat' => $t['cat'] ]
    );
    if ( $id ) $testi_count++;
}
WP_CLI::log( "  ✓  $testi_count testimonials OK" );

// Set avatar cho tất cả testimonials (kể cả đã tạo từ lần chạy trước)
WP_CLI::log( '9b. Testimonial avatars...' );
$all_testi = get_posts( [
    'post_type'      => 'edina_testimonial',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'ID',
    'order'          => 'ASC',
    'fields'         => 'ids',
] );
$av_count = 0;
foreach ( $all_testi as $idx => $tid ) {
    seed_testimonial_avatar( $tid, get_the_title( $tid ), $idx + 1 );
    $av_count++;
}
WP_CLI::log( "  ✓  {$av_count} testimonials có avatar" );


/* ============================================================
   10. FAQs (edina_faq CPT)
   ============================================================ */
WP_CLI::log( '' );
WP_CLI::log( '10. FAQs...' );

$faqs = [
    // ── DV1 FAQs ──
    [
        'title'   => 'Workshop Passion to Profit dành cho ai?',
        'content' => 'Workshop phù hợp với bất kỳ ai muốn biến đam mê thành kinh doanh: nhân viên văn phòng muốn khởi nghiệp, freelancer muốn scale lên doanh nghiệp, người trẻ chưa biết bắt đầu từ đâu, hay phụ nữ muốn xây dựng nguồn thu nhập độc lập. Không yêu cầu kinh nghiệm kinh doanh trước đó.',
        'cat'     => 'dich-vu-1',
    ],
    [
        'title'   => 'Workshop diễn ra ở đâu và kéo dài bao lâu?',
        'content' => '2 ngày cuối tuần liên tiếp (Thứ 7 và Chủ nhật), từ 9:00 đến 17:00 mỗi ngày. Địa điểm tại Hà Nội hoặc TP.HCM (thông báo cụ thể sau khi đăng ký). Có thể có lựa chọn online cho học viên ở xa.',
        'cat'     => 'dich-vu-1',
    ],
    [
        'title'   => 'Học phí và có hoàn tiền không?',
        'content' => 'Học phí 499.000 VNĐ. Có chính sách hoàn 100% học phí nếu bạn không hài lòng sau ngày đầu tiên. Ngoài ra có học bổng 50% dành cho sinh viên và người mới tốt nghiệp – liên hệ trực tiếp để biết điều kiện.',
        'cat'     => 'dich-vu-1',
    ],
    [
        'title'   => 'Sau workshop tôi sẽ có được gì?',
        'content' => 'Bạn sẽ ra về với: (1) Business Model Canvas đầu tiên đã được validate, (2) Kế hoạch hành động 90 ngày chi tiết, (3) Workbook tổng hợp toàn bộ nội dung, (4) Quyền tham gia cộng đồng học viên Edina Trâm, (5) 1 buổi Q&A follow-up sau 30 ngày.',
        'cat'     => 'dich-vu-1',
    ],
    [
        'title'   => 'Tôi đã có ý tưởng kinh doanh, có phù hợp không?',
        'content' => 'Hoàn toàn phù hợp! Workshop giúp bạn validate ý tưởng, tìm điểm khác biệt và xây dựng mô hình kinh doanh từ ý tưởng đó. Dù bạn đang ở bước "có ý tưởng" hay "chưa có ý tưởng", workshop đều có nội dung phù hợp.',
        'cat'     => 'dich-vu-1',
    ],

    // ── DV2 FAQs ──
    [
        'title'   => 'Khoá Business to Freedom có phù hợp với quán đang thua lỗ không?',
        'content' => 'Có. Khoá học được thiết kế để giúp cả người đang chuẩn bị mở quán lẫn quán đang gặp khó khăn. Bạn sẽ được phân tích cụ thể nguyên nhân và xây dựng lộ trình khắc phục phù hợp với tình trạng thực tế của mình.',
        'cat'     => 'dich-vu-2',
    ],
    [
        'title'   => 'Học theo hình thức nào và lịch học như thế nào?',
        'content' => '10 buổi online/offline linh hoạt, mỗi buổi 3 tiếng, thường vào tối Thứ 6 hàng tuần từ 19:30 – 22:30. Ngoài ra có các buổi Q&A thêm và nhóm hỗ trợ trên Zalo. Tất cả buổi học đều được ghi lại để xem lại.',
        'cat'     => 'dich-vu-2',
    ],
    [
        'title'   => 'Tôi không có nền tảng tài chính, có theo được không?',
        'content' => 'Hoàn toàn được. Khoá học bắt đầu từ nền tảng cơ bản nhất và Coach Edina có cách giải thích tài chính rất dễ hiểu, không cần biết kế toán hay tài chính trước. Mục tiêu là giúp bạn hiểu con số trong chính doanh nghiệp của mình.',
        'cat'     => 'dich-vu-2',
    ],
    [
        'title'   => 'Lớp có bao nhiêu học viên?',
        'content' => 'Tối đa 10 học viên/khoá để đảm bảo Coach Edina có thể coaching sâu sát cho từng bạn. Điều này có nghĩa là suất học rất có hạn và thường được đặt trước 2-4 tuần trước khai giảng.',
        'cat'     => 'dich-vu-2',
    ],
    [
        'title'   => 'Sau khoá học có được hỗ trợ tiếp không?',
        'content' => 'Có. Sau khoá học bạn được tham gia cộng đồng học viên Business to Freedom – một nhóm chủ quán F&B đang tích cực phát triển. Ngoài ra có các buổi alumni Q&A hàng tháng với Coach Edina để cập nhật và giải quyết các vấn đề mới phát sinh.',
        'cat'     => 'dich-vu-2',
    ],

    // ── DV3 FAQs ──
    [
        'title'   => 'Business Mastery coaching 1:1 có gì khác với các khoá học nhóm?',
        'content' => 'Business Mastery là chương trình hoàn toàn cá nhân hóa: 100% nội dung xoay quanh doanh nghiệp của bạn, không có template chung hay curriculum cố định. Coach Edina sẽ làm việc trực tiếp trên dữ liệu, thách thức và cơ hội cụ thể của bạn.',
        'cat'     => 'dich-vu-3',
    ],
    [
        'title'   => 'Mỗi tháng tôi có bao nhiêu buổi coaching?',
        'content' => 'Gói tiêu chuẩn bao gồm 2 buổi coaching 1:1 mỗi tháng (90 phút/buổi) cộng với hỗ trợ qua tin nhắn không giới hạn trong giờ hành chính. Có thể điều chỉnh tần suất theo nhu cầu và giai đoạn của doanh nghiệp.',
        'cat'     => 'dich-vu-3',
    ],
    [
        'title'   => 'Tôi cần chuẩn bị gì trước buổi coaching đầu tiên?',
        'content' => 'Trước buổi đầu tiên, bạn sẽ điền một bảng đánh giá doanh nghiệp chi tiết (Business Diagnostic) để Coach Edina hiểu rõ tình trạng hiện tại. Sau đó chúng ta sẽ có buổi Discovery Session miễn phí 45 phút để xác định mục tiêu coaching và xem đây có phải sự kết hợp phù hợp không.',
        'cat'     => 'dich-vu-3',
    ],
    [
        'title'   => 'Chương trình kéo dài bao lâu?',
        'content' => 'Tối thiểu 3 tháng để có thể thấy kết quả rõ ràng và bền vững. Hầu hết khách hàng làm việc với Coach Edina từ 6-12 tháng tùy theo quy mô doanh nghiệp và mục tiêu. Không có hợp đồng dài hạn bắt buộc – bạn có thể tiếp tục hoặc dừng sau mỗi tháng.',
        'cat'     => 'dich-vu-3',
    ],
    [
        'title'   => 'Coaching có thể giúp gì nếu tôi đang có ý định nhượng quyền?',
        'content' => 'Đây là một trong những lĩnh vực Coach Edina có kinh nghiệm thực tế sâu. Chương trình sẽ giúp bạn chuẩn bị hệ thống, quy trình và tài liệu cần thiết để nhượng quyền thành công, tránh những bẫy phổ biến mà các thương hiệu F&B Việt Nam hay mắc phải.',
        'cat'     => 'dich-vu-3',
    ],
];

$faq_count = 0;
foreach ( $faqs as $faq ) {
    $id = seed_post( 'edina_faq', $faq['title'], $faq['content'],
        [],
        [ 'program_cat' => $faq['cat'] ]
    );
    if ( $id ) $faq_count++;
}
WP_CLI::log( "  ✓  $faq_count FAQs đã tạo" );


/* ============================================================
   11. NAV MENU
   ============================================================ */
WP_CLI::log( '' );
WP_CLI::log( '11. Nav menu...' );

$menu_name = 'Menu chính';
$menu_id   = wp_create_nav_menu( $menu_name );

if ( ! is_wp_error( $menu_id ) ) {
    $menu_items = [
        [ 'title' => 'Trang chủ',           'url' => '/',           'order' => 1 ],
        [ 'title' => 'Passion to Profit',   'url' => '/dich-vu-1',  'order' => 2 ],
        [ 'title' => 'Business to Freedom', 'url' => '/dich-vu-2',  'order' => 3 ],
        [ 'title' => 'Business Mastery',    'url' => '/dich-vu-3',  'order' => 4 ],
        [ 'title' => 'Liên hệ',             'url' => '/lien-he',    'order' => 5 ],
    ];
    foreach ( $menu_items as $item ) {
        wp_update_nav_menu_item( $menu_id, 0, [
            'menu-item-title'  => $item['title'],
            'menu-item-url'    => home_url( $item['url'] ),
            'menu-item-status' => 'publish',
            'menu-item-type'   => 'custom',
            'menu-item-position' => $item['order'],
        ] );
    }
    // Gán menu vào vị trí primary
    $locations = get_theme_mod( 'nav_menu_locations', [] );
    $locations['primary'] = $menu_id;
    set_theme_mod( 'nav_menu_locations', $locations );
    WP_CLI::log( "  ✓  Menu '{$menu_name}' đã tạo với " . count( $menu_items ) . ' items' );
} else {
    WP_CLI::warning( '  ✗  Không tạo được menu: ' . $menu_id->get_error_message() );
}


/* ============================================================
   12. IMAGE PLACEHOLDERS (GD → media library)
   ============================================================ */
WP_CLI::log( '' );
WP_CLI::log( '12. Image placeholders...' );

// [ post_id, meta_key, width, height, label, alt, is_option ]
$img_defs = [
    [ $home_id, '_home_hero_image',   600, 680, 'Home Hero',      'Coach Edina Trâm',                      false ],
    [ $home_id, '_home_about_image',  520, 640, 'About Coach',    'Coach Edina Trâm – giới thiệu',          false ],
    [ $home_id, '_home_book_image',   340, 420, 'Book Cover',     'Sách Ánh Sáng Của Ước Mơ',              false ],
    [ $dv1_id,  '_dv1_hero_image',    600, 600, 'DV1 Hero',       'Passion to Profit – Hero',               false ],
    [ $dv1_id,  '_dv1_inst_image',    420, 520, 'DV1 Instructor', 'Coach Edina Trâm – Passion to Profit',   false ],
    [ $dv2_id,  '_dv2_hero_image',    600, 600, 'DV2 Hero',       'Business to Freedom – Hero',             false ],
    [ $dv2_id,  '_dv2_inst_image',    420, 520, 'DV2 Instructor', 'Coach Edina Trâm – Business to Freedom', false ],
    [ $dv3_id,  '_dv3_hero_image',    600, 600, 'DV3 Hero',       'Business Mastery – Hero',                false ],
];

$img_count = 0;
foreach ( $img_defs as [ $pid, $key, $w, $h, $lbl, $alt, $is_opt ] ) {
    $att = seed_image( $pid, $key, $w, $h, $lbl, $alt, $is_opt );
    if ( $att ) {
        WP_CLI::log( "  ✓  {$key} → attachment #{$att}" );
        $img_count++;
    }
}
WP_CLI::log( "  ✓  {$img_count} ảnh placeholder đã tạo" );


/* ============================================================
   DONE
   ============================================================ */
WP_CLI::log( '' );
WP_CLI::log( '══════════════════════════════════════════' );
WP_CLI::log( '  ✅ Seed hoàn tất!' );
WP_CLI::log( '' );
WP_CLI::log( '  Pages    : Home, DV1, DV2, DV3, Liên hệ' );
WP_CLI::log( "  Testi    : {$testi_count} entries" );
WP_CLI::log( "  FAQ      : {$faq_count} entries" );
WP_CLI::log( '  Options  : ' . count( $options ) . ' edt_* options' );
WP_CLI::log( '  Nav menu : Menu chính (5 items)' );
WP_CLI::log( "  Images   : {$img_count} placeholders" );
WP_CLI::log( '══════════════════════════════════════════' );
WP_CLI::log( '' );
