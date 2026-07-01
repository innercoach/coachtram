# Edina Trâm — Theme V3

Theme WordPress port trực tiếp từ bản HTML đã chốt (`static-site/`), theo hệ
**TINA: Awareness · Awakening · Alignment**, với kiến trúc **thư viện section
tái sử dụng**.

## Kiến trúc

| Vai trò | File |
|---------|------|
| Chrome dùng chung (head, nav, noscript, `<main>`, glow-blobs) | `header.php` |
| Footer + nút scroll-to-top | `footer.php` |
| Setup, enqueue CSS/JS, helper | `functions.php` |
| **Thư viện section** (nạp qua `get_template_part` + `$args`) | `template-parts/sections/*.php` |
| Trang | `front-page.php`, `page-*.php` |

Menu điều hướng là **một nguồn duy nhất** (mảng `$nav` trong `header.php`); active
tính theo `is_front_page()` / slug trang.

### Thư viện section

Tương đương `<site-section>` ở bản HTML tĩnh. Nạp bằng helper `edt_section()`:

```php
<?php edt_section('instructor', [
    'label' => 'Người đồng hành',
    'alt'   => 'Edina Trâm - chương trình TINA Awakening',
]); ?>
```

| Section | File | Args |
|---------|------|------|
| `instructor` | `template-parts/sections/instructor.php` | `label`, `alt`, `img` |
| `faq` | `template-parts/sections/faq.php` | `badge`, `heading`, `label`, `items[]` (mỗi item `q`,`a`) |
| `cta-final` | `template-parts/sections/cta-final.php` | `badge`, `title`, `text`, `btn_label`, `btn_url`, `bg` |

Thêm section mới: tạo `template-parts/sections/<tên>.php` (đọc `$args`), rồi gọi
`edt_section('<tên>', [...])`. Ảnh trong theme dùng `edt_asset('images/...')`.

## Cài đặt

1. Copy `edina-tram-v3/` vào `wp-content/themes/` và **Activate**.
2. Tạo các **Page** với slug đúng để template `page-{slug}.php` tự áp:
   `cau-chuyen-cua-toi`, `bai-viet-cua-tram`, `dich-vu-1`, `dich-vu-2`,
   `dich-vu-3`, `lien-he`.
3. Tạo một Page “Trang chủ” → **Settings → Reading → Your homepage displays →
   A static page** chọn trang đó (dùng `front-page.php`).
4. Upload ảnh testimonial vuông (~256px) vào `assets/images/testi/`:
   `hoang-huong.jpg`, `minh-huong.jpg`, `le-the-hao.jpg` (xem README trong thư mục).

> **Nội dung** hiện được port cứng trong template (bám sát bản HTML đã duyệt).
> Lớp chỉnh nội dung qua admin (metabox/ACF như V2) có thể bổ sung sau mà không
> đổi kiến trúc section.

## Nguồn & đồng bộ

CSS (`assets/css/*`) và `assets/js/main.js` copy nguyên từ `static-site/` — sửa
giao diện nên sửa ở bản HTML rồi đồng bộ sang để hai bản không lệch nhau.
