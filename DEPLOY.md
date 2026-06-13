# Hướng dẫn Deploy — Theme Edina Trâm V2

Tài liệu triển khai theme WordPress `edina-tram-v2` lên server thật, dùng được ngay.

> **Tóm tắt nhanh:** Có 2 cách deploy.
> - **Cách 1 — Import SQL snapshot** (nhanh nhất, có sẵn toàn bộ trang + nội dung mẫu + cấu hình). Dùng khi muốn lên sóng ngay.
> - **Cách 2 — Cài mới thủ công** (sạch, không kèm dữ liệu mẫu). Dùng khi bắt đầu từ đầu hoặc đã có WordPress sẵn.

---

## 1. Yêu cầu hệ thống

| Thành phần | Tối thiểu | Khuyến nghị |
|---|---|---|
| WordPress | 6.0 | 6.7+ |
| PHP | 7.4 | 8.2 (có `gd`, `mysqli`, `mbstring`) |
| MySQL / MariaDB | 5.7 / 10.3 | 8.0 / 10.6 |
| Bộ nhớ PHP | 128M | 256M |
| HTTPS | — | Bắt buộc cho production |

**Phụ thuộc:**
- **Google Fonts** (Cormorant Garamond + Be Vietnam Pro) tải từ CDN — server cần ra được internet, hoặc self-host font nếu chạy nội bộ.
- **Plugin Fluent Forms** (miễn phí) — cần cho form ở trang Liên hệ. Không có plugin thì trang vẫn chạy, chỉ hiện thông báo nhắc cài.

---

## 2. Kiến trúc theme cần biết trước khi deploy

Theme dùng **layout cố định, nội dung sửa qua admin** (không phải block theme). Có vài quy ước bắt buộc đúng thì site mới hiển thị đủ:

**Trang bắt buộc (đúng slug):**

| Trang | Slug (bắt buộc) | Template tự áp dụng |
|---|---|---|
| Trang chủ | `trang-chu` | `front-page.php` |
| Dịch vụ 1 — Passion to Profit | `dich-vu-1` | `page-dich-vu-1.php` |
| Dịch vụ 2 — Business to Freedom | `dich-vu-2` | `page-dich-vu-2.php` |
| Dịch vụ 3 — Business Mastery | `dich-vu-3` | `page-dich-vu-3.php` |
| Liên hệ | `lien-he` | `page-lien-he.php` |

> WordPress tự chọn template theo tên file `page-{slug}.php`, nên **chỉ cần tạo trang đúng slug** — không cần gán template thủ công. Trang chủ phải được set làm "trang tĩnh hiển thị đầu trang".
> Metabox nội dung của mỗi trang **chỉ hiện khi slug khớp** — đặt sai slug thì không thấy ô nhập liệu và trang dùng nội dung mặc định.

**Custom Post Type & Taxonomy (theme tự đăng ký):**
- `edina_testimonial` — Ý kiến khách hàng (có ảnh đại diện = featured image, trường "Vai trò/Vị trí").
- `edina_faq` — Câu hỏi thường gặp.
- `program_cat` — taxonomy gán testimonial/FAQ vào từng chương trình. **Slug term bắt buộc:** `home`, `dich-vu-1`, `dich-vu-2`, `dich-vu-3`. Trang chủ lấy testimonial gắn term `home`; mỗi trang dịch vụ lấy theo term tương ứng.

**Cấu hình toàn site:** `Settings → Cài đặt Website` (logo, header CTA, footer, liên hệ, social, coach bio). Lưu vào `wp_options` prefix `edt_`.

---

## 3. Cách 1 — Deploy bằng SQL snapshot (nhanh)

File `docker/export/edina-tram-snapshot.sql` (~151KB) chứa **toàn bộ**: 5 trang đã gán template, testimonial + FAQ mẫu, term `program_cat`, ảnh placeholder, và cấu hình `Cài đặt Website`. Import xong là có site hoàn chỉnh.

> ⚠️ Snapshot được tạo ở môi trường dev với URL `http://localhost:8080`. **Bắt buộc** đổi domain bằng `search-replace` sau khi import, nếu không link/ảnh sẽ trỏ về localhost.

### 3.1. Upload theme

Copy thư mục `wp-theme/edina-tram-v2/` vào `wp-content/themes/` trên server:

```bash
# Qua SSH/rsync
rsync -av wp-theme/edina-tram-v2/ user@server:/var/www/html/wp-content/themes/edina-tram-v2/
```

Hoặc nén thành zip rồi `Appearance → Themes → Add New → Upload Theme`.

### 3.2. Import database

```bash
# Tạo DB (nếu chưa có)
mysql -u root -p -e "CREATE DATABASE edina CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Import snapshot
mysql -u <db_user> -p edina < docker/export/edina-tram-snapshot.sql
```

Đảm bảo `wp-config.php` trỏ đúng `DB_NAME`, `DB_USER`, `DB_PASSWORD`, `DB_HOST` và prefix bảng là `wp_`.

### 3.3. Đổi domain (bắt buộc)

Dùng WP-CLI để thay an toàn (xử lý cả dữ liệu serialize):

```bash
wp option update siteurl  "https://coachtram.com"
wp option update home     "https://coachtram.com"
wp search-replace "http://localhost:8080" "https://coachtram.com" --all-tables --precise
wp cache flush
wp rewrite flush --hard
```

Không có WP-CLI thì cài plugin **Better Search Replace** và thay `http://localhost:8080` → `https://coachtram.com`.

### 3.4. Bảo mật sau import

Snapshot kèm tài khoản dev `admin / admin123`. **Đổi ngay:**

```bash
wp user update admin --user_pass="<mật-khẩu-mạnh>"
wp user update admin --user_email="email-that@cua-ban.com"
```

### 3.5. Hoàn tất → xem mục [5. Checklist sau deploy](#5-checklist-sau-deploy).

---

## 4. Cách 2 — Cài mới thủ công (không kèm dữ liệu mẫu)

Dùng khi muốn site sạch hoặc đã có WordPress đang chạy.

### 4.1. Cài WordPress + kích hoạt theme

```bash
# Nếu cài từ đầu bằng WP-CLI
wp core install --url="https://coachtram.com" --title="Edina Trâm — F&B Startup Coach" \
  --admin_user="admin" --admin_password="<mật-khẩu-mạnh>" --admin_email="email@coachtram.com"

# Upload theme (xem 3.1) rồi kích hoạt
wp theme activate edina-tram-v2
```

### 4.2. Cấu hình cơ bản

```bash
wp option update blogdescription "F&B Startup Coach · ICF PCC"
wp option update timezone_string "Asia/Ho_Chi_Minh"
wp option update date_format "d/m/Y"
wp option update permalink_structure "/%postname%/"
wp rewrite flush --hard
```

### 4.3. Cài plugin Fluent Forms

```bash
wp plugin install fluentform --activate
```

Tạo 1 form liên hệ trong Fluent Forms, copy shortcode (vd `[fluentform id="1"]`).

### 4.4. Tạo 5 trang đúng slug + đặt trang chủ

```bash
HOME=$(wp post create --post_type=page --post_status=publish --post_title="Trang chủ"            --post_name="trang-chu" --porcelain)
wp post create --post_type=page --post_status=publish --post_title="Passion to Profit"     --post_name="dich-vu-1"
wp post create --post_type=page --post_status=publish --post_title="Business to Freedom"   --post_name="dich-vu-2"
wp post create --post_type=page --post_status=publish --post_title="Business Mastery"      --post_name="dich-vu-3"
wp post create --post_type=page --post_status=publish --post_title="Liên hệ"               --post_name="lien-he"

# Đặt Trang chủ làm front page tĩnh
wp option update show_on_front page
wp option update page_on_front $HOME
```

### 4.5. Tạo term taxonomy `program_cat`

```bash
wp term create program_cat "Trang chủ"           --slug=home
wp term create program_cat "Passion to Profit"   --slug=dich-vu-1
wp term create program_cat "Business to Freedom" --slug=dich-vu-2
wp term create program_cat "Business Mastery"    --slug=dich-vu-3
```

### 4.6. Nhập nội dung (qua wp-admin)

- **Mỗi trang dịch vụ:** mở trang trong `Pages`, cuộn xuống metabox "⚙️ Nội dung" để nhập hero, mô tả, bảng giá, ảnh… (metabox chỉ hiện khi slug đúng).
- **Trang Liên hệ:** mở trang `lien-he`, dán shortcode Fluent Forms vào ô "Shortcode form".
- **Ý kiến khách hàng:** menu `Ý kiến Khách hàng → Thêm mới`, đặt ảnh đại diện (Featured image), điền "Vai trò/Vị trí", gán đúng `Chương trình` (term).
- **FAQ:** menu `FAQs → Thêm mới`, gán đúng `Chương trình`.
- **Cấu hình chung:** `Settings → Cài đặt Website` — logo, header CTA, footer, email/điện thoại, social, coach bio.

### 4.7. Tạo menu điều hướng

`Appearance → Menus` → tạo menu, thêm các trang, gán vào vị trí **"Menu chính" (primary)**.

```bash
# Hoặc bằng WP-CLI
wp menu create "Menu chính"
wp menu item add-post primary <id-trang> ...   # lặp cho từng trang
wp menu location assign "Menu chính" primary
```

---

## 5. Checklist sau deploy

- [ ] Trang chủ mở đúng (`https://coachtram.com/`), không phải danh sách bài viết.
- [ ] 4 trang `dich-vu-1/2/3`, `lien-he` mở được, hiện đúng layout.
- [ ] Đổi domain xong: không còn link/ảnh trỏ `localhost` (View source → tìm "localhost").
- [ ] Đã đổi mật khẩu + email admin.
- [ ] Permalink dạng `/%postname%/` (`Settings → Permalinks` bấm Save 1 lần).
- [ ] Fluent Forms đã cài, shortcode đã dán vào trang Liên hệ, gửi thử 1 form.
- [ ] Testimonial/FAQ hiện đúng theo từng chương trình (kiểm tra term `program_cat`).
- [ ] Font hiển thị đúng (Cormorant + Be Vietnam Pro) — nếu sai, kiểm tra server ra được Google Fonts.
- [ ] Ảnh hero/giảng viên: thay placeholder bằng ảnh thật qua ô ảnh trong metabox.
- [ ] HTTPS hoạt động, không có cảnh báo mixed-content (Console trình duyệt sạch).
- [ ] WP-Cron: xem mục 6.

---

## 6. Tối ưu cho production

### 6.1. WP-Cron (quan trọng)

File `docker-compose.yml` dev có `define('DISABLE_WP_CRON', true)` để trang chủ load nhanh. **Trên production:**
- Hoặc **bỏ** define này (để WP-Cron mặc định chạy theo lượt truy cập), hoặc
- Giữ define đó **và** thêm system cron thật:

```cron
*/5 * * * * curl -s https://coachtram.com/wp-cron.php?doing_wp_cron >/dev/null 2>&1
```

Không làm bước này thì các tác vụ nền (dọn transient, kiểm tra update, post hẹn giờ) sẽ không chạy.

### 6.2. Object cache (tuỳ chọn)

Theme đã tối ưu query (`no_found_rows`, ảnh `fetchpriority`, CSS tách rời, JS `defer`). Muốn nhanh hơn nữa: cài Redis/Memcached + drop-in `object-cache.php` (vd plugin **Redis Object Cache**). Không bắt buộc.

### 6.3. Bảo mật

- Đổi mật khẩu admin (bắt buộc nếu import từ snapshot).
- Tắt `WP_DEBUG` trên production (`define('WP_DEBUG', false)` trong `wp-config.php`).
- Đảm bảo MySQL không dùng cấu hình dev (file `docker/mysql-client.cnf` và `--require-secure-transport=OFF` chỉ dành cho dev).

---

## 7. Cập nhật theme về sau

Theme là code tĩnh, cập nhật = thay file:

```bash
rsync -av --delete wp-theme/edina-tram-v2/ user@server:/var/www/html/wp-content/themes/edina-tram-v2/
wp cache flush
```

Nội dung (trang, testimonial, settings) nằm trong DB nên không bị ảnh hưởng khi thay file theme. Sau khi đổi CSS/JS, bump `Version` trong `style.css` để phá cache trình duyệt (theme dùng version này làm query string cho asset).

---

## 8. Xử lý sự cố

| Triệu chứng | Nguyên nhân & cách xử lý |
|---|---|
| Trang dịch vụ hiện nội dung mặc định, không thấy metabox | Slug trang sai. Phải đúng `dich-vu-1/2/3`, `lien-he`. Sửa slug trong `Pages → Quick Edit`. |
| Trang chủ hiện danh sách bài viết | Chưa đặt front page tĩnh. `Settings → Reading → A static page → Trang chủ`. |
| Link/ảnh trỏ về localhost | Chưa chạy `search-replace`. Xem mục 3.3. |
| Testimonial/FAQ không hiện | Chưa gán term `program_cat` đúng slug, hoặc post chưa publish. |
| Form liên hệ không hiện | Chưa cài Fluent Forms hoặc chưa dán shortcode vào trang `lien-he`. |
| Font bị lỗi/khác | Server không ra được Google Fonts. Self-host font hoặc kiểm tra firewall. |
| CSS/layout vỡ sau update | Bump `Version` trong `style.css` + `wp cache flush` + xoá cache CDN/trình duyệt. |
| Trang trắng / lỗi 500 | PHP < 7.4 hoặc thiếu extension `gd`/`mysqli`. Kiểm tra `php -v` và error log. |

---

## Phụ lục — Môi trường dev bằng Docker

Chạy thử local (đã kèm sẵn trong repo):

```bash
docker compose up -d                          # khởi động MySQL + WordPress (cổng 8080)
docker compose run --rm cli sh /docker/setup.sh   # cài WP + seed toàn bộ dữ liệu mẫu
# → http://localhost:8080  |  admin: admin / admin123
```

Xuất lại snapshot sau khi sửa dữ liệu:

```bash
docker compose exec db mysqldump --no-tablespaces -uwp -pwp wordpress > docker/export/edina-tram-snapshot.sql
```

---

© 2026 Edina Trâm. Theme `edina-tram-v2` v2.0.0.
