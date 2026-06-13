<?php
/**
 * Plugin Name: Edina Demo Import
 * Description: Nhập dữ liệu demo cho theme Edina Trâm V2 bằng 1 cú click — import nội dung (trang, testimonial, FAQ, settings, ảnh placeholder) và tự đổi link về domain hiện tại. KHÔNG đụng tới tài khoản người dùng hay URL của site.
 * Version: 1.0.0
 * Author: Edina Trâm
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Text Domain: edina-demo-import
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'EDI_DIR', plugin_dir_path( __FILE__ ) );
define( 'EDI_DATA', EDI_DIR . 'data/' );
// URL gốc đã "nướng" vào dump (môi trường dev). Import xong sẽ thay bằng home_url().
define( 'EDI_SOURCE_URL', 'http://localhost:8080' );
// Prefix bảng của dump nguồn (mysqldump luôn dùng wp_ trong môi trường dev).
define( 'EDI_SOURCE_PREFIX', 'wp_' );

/* ============================================================
   ADMIN MENU
   ============================================================ */
add_action( 'admin_menu', function () {
	add_management_page(
		'Edina Demo Import',
		'Edina Demo Import',
		'import', // cap: chỉ admin/editor có quyền import
		'edina-demo-import',
		'edi_render_page'
	);
} );

/* ============================================================
   RENDER + XỬ LÝ FORM
   ============================================================ */
function edi_render_page() {
	if ( ! current_user_can( 'import' ) ) {
		wp_die( 'Bạn không có quyền thực hiện thao tác này.' );
	}

	$result = null;
	if ( isset( $_POST['edi_run'] ) ) {
		check_admin_referer( 'edi_import' );
		if ( empty( $_POST['edi_confirm'] ) ) {
			$result = [ 'ok' => false, 'msg' => 'Bạn cần tick xác nhận trước khi import.' ];
		} else {
			$result = edi_run_import();
		}
	}

	$already = (bool) get_page_by_path( 'dich-vu-1' );
	?>
	<div class="wrap">
		<h1>🌱 Edina Demo Import</h1>

		<?php if ( $result ) : ?>
			<div class="notice notice-<?php echo $result['ok'] ? 'success' : 'error'; ?> is-dismissible">
				<p><strong><?php echo esc_html( $result['msg'] ); ?></strong></p>
				<?php if ( ! empty( $result['details'] ) ) : ?>
					<ul style="list-style:disc;margin-left:20px;">
						<?php foreach ( $result['details'] as $d ) : ?>
							<li><?php echo esc_html( $d ); ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<p>Nhập toàn bộ dữ liệu demo cho theme <strong>Edina Trâm V2</strong>: 5 trang (Trang chủ, 3 dịch vụ, Liên hệ) đã gán template, testimonial &amp; FAQ mẫu, danh mục chương trình, ảnh placeholder, và cấu hình <em>Cài đặt Website</em>. Link sẽ được tự động đổi về <code><?php echo esc_html( untrailingslashit( home_url() ) ); ?></code>.</p>

		<div class="notice notice-warning inline" style="margin:16px 0;">
			<p><strong>Lưu ý — thao tác này sẽ GHI ĐÈ:</strong></p>
			<ul style="list-style:disc;margin-left:20px;">
				<li>Toàn bộ <strong>Trang, Bài viết, Testimonial, FAQ</strong> và metadata của chúng (bảng posts/postmeta/terms bị tạo lại).</li>
				<li>Các tuỳ chọn <code>edt_*</code> trong <em>Cài đặt Website</em> + thiết lập trang chủ tĩnh + menu.</li>
			</ul>
			<p><strong>KHÔNG bị ảnh hưởng:</strong> tài khoản người dùng (admin giữ nguyên), URL của site (<code>siteurl</code>/<code>home</code>), theme đang kích hoạt, plugin khác.</p>
			<?php if ( $already ) : ?>
				<p>⚠️ Có vẻ dữ liệu demo đã tồn tại (trang <code>dich-vu-1</code> đang có). Chạy lại sẽ làm mới về trạng thái demo.</p>
			<?php endif; ?>
		</div>

		<form method="post">
			<?php wp_nonce_field( 'edi_import' ); ?>
			<p>
				<label>
					<input type="checkbox" name="edi_confirm" value="1">
					Tôi hiểu thao tác này ghi đè nội dung và muốn tiếp tục.
				</label>
			</p>
			<p>
				<button type="submit" name="edi_run" value="1" class="button button-primary button-hero">
					🚀 Import dữ liệu demo
				</button>
			</p>
		</form>
	</div>
	<?php
}

/* ============================================================
   IMPORT — gọi được cả từ admin lẫn WP-CLI (wp eval 'edi_run_import();')
   ============================================================ */
function edi_run_import() {
	@set_time_limit( 300 );
	$details = [];

	// 1) Copy ảnh placeholder vào thư mục uploads ──────────────
	$uploads = wp_upload_dir();
	$copied  = edi_copy_dir( EDI_DATA . 'uploads', $uploads['basedir'] );
	$details[] = "Đã copy {$copied} file ảnh vào uploads.";

	// 2) Import bảng nội dung (DROP + CREATE + INSERT) ─────────
	$c1 = edi_run_sql_file( EDI_DATA . 'content.sql' );
	if ( ! $c1['ok'] ) {
		return [ 'ok' => false, 'msg' => 'Lỗi khi import nội dung: ' . $c1['error'], 'details' => $details ];
	}
	$details[] = "Đã chạy {$c1['count']} câu lệnh SQL nội dung (posts/postmeta/terms…).";

	// 3) Import options đã chọn lọc (REPLACE INTO) ─────────────
	$c2 = edi_run_sql_file( EDI_DATA . 'options.sql' );
	if ( ! $c2['ok'] ) {
		return [ 'ok' => false, 'msg' => 'Lỗi khi import cấu hình: ' . $c2['error'], 'details' => $details ];
	}
	$details[] = "Đã nhập cấu hình edt_* + trang chủ + menu.";

	// 4) Đổi link demo → domain hiện tại (an toàn với dữ liệu serialize) ─
	$target = untrailingslashit( home_url() );
	$rep = 0;
	foreach ( [ EDI_SOURCE_URL, str_replace( 'http://', 'https://', EDI_SOURCE_URL ) ] as $from ) {
		if ( $from === $target ) {
			continue;
		}
		$rep += edi_replace_url( $from, $target );
	}
	$details[] = "Đã đổi {$rep} bản ghi chứa link cũ về {$target}.";

	// 5) Dọn cache + flush permalink ───────────────────────────
	wp_cache_flush();
	flush_rewrite_rules( false );
	$details[] = 'Đã flush cache + permalink.';

	return [ 'ok' => true, 'msg' => 'Import demo thành công! Mở trang chủ để kiểm tra.', 'details' => $details ];
}

/* ============================================================
   HELPERS
   ============================================================ */

/** Copy đệ quy thư mục nguồn vào thư mục đích (giữ cấu trúc con). */
function edi_copy_dir( $src, $dest ) {
	if ( ! is_dir( $src ) ) {
		return 0;
	}
	$count = 0;
	$items = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator( $src, FilesystemIterator::SKIP_DOTS ),
		RecursiveIteratorIterator::SELF_FIRST
	);
	foreach ( $items as $item ) {
		$rel = substr( $item->getPathname(), strlen( $src ) + 1 );
		$rel = str_replace( '\\', '/', $rel );
		$to  = trailingslashit( $dest ) . $rel;
		if ( $item->isDir() ) {
			wp_mkdir_p( $to );
		} else {
			wp_mkdir_p( dirname( $to ) );
			if ( @copy( $item->getPathname(), $to ) ) {
				$count++;
			}
		}
	}
	return $count;
}

/**
 * Chạy 1 file .sql (dạng mysqldump). Chỉ thực thi các câu DROP/CREATE/INSERT/REPLACE,
 * bỏ qua SET/LOCK/UNLOCK/conditional-comment. Tự remap prefix bảng wp_ → prefix thật.
 */
function edi_run_sql_file( $path ) {
	global $wpdb;
	if ( ! file_exists( $path ) ) {
		return [ 'ok' => false, 'error' => "Không tìm thấy file: {$path}", 'count' => 0 ];
	}

	$lines  = file( $path );
	$buffer = '';
	$count  = 0;

	foreach ( $lines as $line ) {
		$trim = trim( $line );
		if ( $trim === '' || substr( $trim, 0, 2 ) === '--' ) {
			continue;
		}
		// conditional-comment / lệnh phiên 1 dòng (/*!... */;) → bỏ qua
		if ( $buffer === '' && substr( $trim, 0, 2 ) === '/*' ) {
			continue;
		}

		$buffer .= $line;

		if ( substr( $trim, -1 ) === ';' ) {
			$stmt   = trim( $buffer );
			$buffer = '';

			if ( ! preg_match( '/^(DROP|CREATE|INSERT|REPLACE)\b/i', $stmt ) ) {
				continue; // SET / LOCK / UNLOCK …
			}

			$stmt = edi_remap_prefix( $stmt );

			// phải tắt báo lỗi PHP của wpdb để tự xử lý
			$prev = $wpdb->suppress_errors( true );
			$res  = $wpdb->query( $stmt );
			$wpdb->suppress_errors( $prev );

			if ( false === $res ) {
				return [ 'ok' => false, 'error' => $wpdb->last_error . ' | ' . substr( $stmt, 0, 120 ), 'count' => $count ];
			}
			$count++;
		}
	}

	return [ 'ok' => true, 'error' => '', 'count' => $count ];
}

/** Đổi prefix bảng wp_ (định danh trong backtick) sang prefix thật của site. */
function edi_remap_prefix( $stmt ) {
	global $wpdb;
	if ( $wpdb->prefix === EDI_SOURCE_PREFIX ) {
		return $stmt;
	}
	// chỉ thay định danh dạng `wp_xxx` (data dùng nháy đơn nên an toàn)
	return str_replace( '`' . EDI_SOURCE_PREFIX, '`' . $wpdb->prefix, $stmt );
}

/**
 * Thay URL cũ → URL mới trên posts/postmeta/options đã import.
 * Xử lý đúng dữ liệu serialize (unserialize → thay → serialize lại).
 */
function edi_replace_url( $from, $to ) {
	global $wpdb;
	$changed = 0;

	// posts: post_content, post_excerpt, guid (không serialize → str_replace)
	$rows = $wpdb->get_results( "SELECT ID, post_content, post_excerpt, guid FROM {$wpdb->posts}" );
	foreach ( $rows as $r ) {
		$pc = str_replace( $from, $to, $r->post_content );
		$pe = str_replace( $from, $to, $r->post_excerpt );
		$gu = str_replace( $from, $to, $r->guid );
		if ( $pc !== $r->post_content || $pe !== $r->post_excerpt || $gu !== $r->guid ) {
			$wpdb->update( $wpdb->posts, [ 'post_content' => $pc, 'post_excerpt' => $pe, 'guid' => $gu ], [ 'ID' => $r->ID ] );
			$changed++;
		}
	}

	// postmeta: meta_value (có thể serialize)
	$metas = $wpdb->get_results( "SELECT meta_id, meta_value FROM {$wpdb->postmeta} WHERE meta_value LIKE '%" . $wpdb->esc_like( $from ) . "%'" );
	foreach ( $metas as $m ) {
		$new = edi_deep_replace( $m->meta_value, $from, $to );
		if ( $new !== $m->meta_value ) {
			$wpdb->update( $wpdb->postmeta, [ 'meta_value' => $new ], [ 'meta_id' => $m->meta_id ] );
			$changed++;
		}
	}

	// options: chỉ những option đã import (edt_*, theme_mods, front-page)
	$opts = $wpdb->get_results( "SELECT option_id, option_value FROM {$wpdb->options} WHERE option_value LIKE '%" . $wpdb->esc_like( $from ) . "%'" );
	foreach ( $opts as $o ) {
		$new = edi_deep_replace( $o->option_value, $from, $to );
		if ( $new !== $o->option_value ) {
			$wpdb->update( $wpdb->options, [ 'option_value' => $new ], [ 'option_id' => $o->option_id ] );
			$changed++;
		}
	}

	return $changed;
}

/** Thay chuỗi an toàn với dữ liệu serialize (chuỗi raw lấy từ DB). */
function edi_deep_replace( $value, $from, $to ) {
	$un = @unserialize( $value );
	if ( false !== $un || $value === 'b:0;' ) {
		return serialize( edi_deep_replace_value( $un, $from, $to ) );
	}
	return str_replace( $from, $to, $value );
}

/** Thay đệ quy trên giá trị PHP đã unserialize. */
function edi_deep_replace_value( $value, $from, $to ) {
	if ( is_string( $value ) ) {
		return str_replace( $from, $to, $value );
	}
	if ( is_array( $value ) ) {
		$out = [];
		foreach ( $value as $k => $v ) {
			$out[ $k ] = edi_deep_replace_value( $v, $from, $to );
		}
		return $out;
	}
	if ( is_object( $value ) ) {
		$obj = clone $value;
		foreach ( get_object_vars( $obj ) as $k => $v ) {
			$obj->$k = edi_deep_replace_value( $v, $from, $to );
		}
		return $obj;
	}
	return $value;
}
