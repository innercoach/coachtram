# Edina Demo Import

Plugin nhỏ giúp nhập **dữ liệu demo** cho theme `edina-tram-v2` bằng 1 cú click, và tự đổi link về domain hiện tại — **không** đụng tới tài khoản người dùng hay URL của site.

## Cách dùng

1. Copy thư mục này vào `wp-content/plugins/edina-demo-import/`.
2. Vào **Plugins → Activated** kích hoạt *Edina Demo Import*.
3. Vào **Tools → Edina Demo Import**, tick xác nhận, bấm **🚀 Import dữ liệu demo**.
4. Mở trang chủ kiểm tra. Sau đó có thể tắt/xoá plugin.

> Yêu cầu: theme `edina-tram-v2` đã được kích hoạt, tài khoản admin đã có (tạo lúc cài WordPress).

## Plugin làm gì

| Bước | Hành động |
|---|---|
| 1 | Copy ảnh placeholder (`data/uploads/`) vào thư mục uploads |
| 2 | Import bảng nội dung từ `data/content.sql` — `posts`, `postmeta`, `terms`, `term_taxonomy`, `term_relationships`, `termmeta` (DROP + CREATE + INSERT) |
| 3 | Nhập cấu hình chọn lọc từ `data/options.sql` — chỉ các option `edt_*`, trang chủ tĩnh (`show_on_front`/`page_on_front`), vị trí menu (`theme_mods_edina-tram-v2`) bằng `REPLACE INTO` |
| 4 | Đổi link `http://localhost:8080` → `home_url()` hiện tại (an toàn với dữ liệu serialize) |
| 5 | Flush cache + permalink |

## Ghi đè & an toàn

- **GHI ĐÈ:** toàn bộ Trang/Bài viết/Testimonial/FAQ + metadata, các option `edt_*`, thiết lập trang chủ & menu.
- **KHÔNG đụng tới:** `wp_users`/`wp_usermeta` (tài khoản admin giữ nguyên), `siteurl`/`home`, theme đang kích hoạt, plugin khác.

Nên chạy trên site mới/sạch. Chạy lại sẽ làm mới về trạng thái demo (idempotent).

## Cập nhật dữ liệu demo

Khi nội dung mẫu thay đổi, tạo lại 2 file SQL + ảnh từ môi trường dev:

```bash
# content (bảng nội dung)
docker compose exec -T db mysqldump --no-tablespaces --default-character-set=utf8mb4 \
  --add-drop-table --skip-comments -uwp -pwp wordpress \
  wp_posts wp_postmeta wp_terms wp_term_taxonomy wp_term_relationships wp_termmeta \
  > wp-plugin/edina-demo-import/data/content.sql

# options (chỉ edt_* + trang chủ + menu, dạng REPLACE INTO)
docker compose exec -T db mysqldump --no-tablespaces --default-character-set=utf8mb4 \
  --no-create-info --skip-add-drop-table --skip-comments --replace -uwp -pwp wordpress wp_options \
  --where="option_name LIKE 'edt\_%' OR option_name IN ('show_on_front','page_on_front','theme_mods_edina-tram-v2','blogdescription')" \
  > wp-plugin/edina-demo-import/data/options.sql

# ảnh
docker compose cp wordpress:/var/www/html/wp-content/uploads \
  wp-plugin/edina-demo-import/data/uploads
```

Nếu môi trường nguồn dùng URL khác `http://localhost:8080`, sửa hằng `EDI_SOURCE_URL` trong `edina-demo-import.php`.
