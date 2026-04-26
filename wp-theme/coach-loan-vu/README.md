# Coach Loan Vu – WordPress Theme

## Yêu cầu

| Yêu cầu | Phiên bản tối thiểu |
|---------|-------------------|
| WordPress | 6.4+ |
| PHP | 8.0+ |
| ACF Pro | 6.x+ |
| Contact Form 7 (tùy chọn) | 5.x+ |

---

## Cài đặt nhanh

### 1. Upload theme
Copy thư mục `coach-loan-vu/` vào `/wp-content/themes/`

### 2. Kích hoạt theme
WP Admin → Appearance → Themes → Activate **Coach Loan Vu**

### 3. Cài plugins
- **ACF Pro** (bắt buộc) – cài và activate
- **Contact Form 7** (tùy chọn) – cho trang liên hệ

### 4. ACF sẽ tự load Field Groups
Các field groups định nghĩa sẵn trong `acf-json/` sẽ được sync tự động sau khi kích hoạt theme và ACF Pro.

---

## Tạo Pages trong WP Admin

Tạo 5 trang với slug và template tương ứng:

| Tên trang | Slug | Page Template |
|-----------|------|---------------|
| Trang chủ | (front page) | *Đặt làm trang chủ tĩnh* |
| Passion to Profit | `passion-to-profit` | Dich Vu 1 – Passion to Profit |
| Business to Freedom | `business-to-freedom` | Dich Vu 2 – Business to Freedom |
| Business Mastery | `business-mastery` | Dich Vu 3 – Business Mastery |
| Liên hệ | `lien-he` | Lien He – Contact |

**Để Trang chủ:**
Settings → Reading → "A static page" → chọn trang tương ứng.

---

## Cài đặt Global (Options Page)

WP Admin → **Cài đặt Website** → điền các thông tin:
- Logo text
- Nút CTA trên nav
- Footer tagline & copyright
- Facebook / Instagram / Email

---

## Cập nhật nội dung từng trang

Mở trang muốn edit → kéo xuống phần **ACF Fields** → sửa nội dung → Update.

### Thêm/xóa Testimonials (ví dụ):
1. Vào trang **Passion to Profit** → Edit
2. Tìm section **Học viên nói gì** → Repeater field
3. Bấm **Add Row** để thêm học viên mới
4. Upload ảnh, điền tên, địa điểm, câu quote → Update

### Thêm/xóa FAQ:
1. Tìm section **FAQ** → Repeater field
2. Add/Remove rows tùy ý

---

## Cấu trúc thư mục

```
coach-loan-vu/
├── style.css                     ← Theme registration + base CSS
├── functions.php                 ← Core logic, ACF setup, helpers
├── header.php                    ← Navigation
├── footer.php                    ← Footer
├── index.php                     ← Fallback
├── front-page.php                ← Trang chủ
├── page-passion-to-profit.php    ← Dịch vụ 1
├── page-business-to-freedom.php  ← Dịch vụ 2
├── page-business-mastery.php     ← Dịch vụ 3
├── page-lien-he.php              ← Liên hệ
├── assets/
│   ├── js/
│   │   └── main.js
│   └── images/
│       ├── home/             ← book-mockup.jpeg/.png
│       ├── dv1/              ← hero-coach, instructor, 12 testimonials
│       ├── dv2/              ← hero-coach, 6 testimonials
│       └── dv3/              ← hero-coach
└── acf-json/                     ← ACF field definitions (sync tự động)
    ├── group_global.json
    ├── group_dv1.json
    ├── group_dv2.json
    ├── group_dv3.json
    └── group_contact.json
```

---

## Upload ảnh vào WordPress

Tất cả ảnh đã được đóng gói sẵn trong thư mục `assets/images/`:

| Thư mục | Nội dung |
|---------|----------|
| `assets/images/home/` | Ảnh bìa sách |
| `assets/images/dv1/` | Hero coach, instructor, 12 testimonial photos |
| `assets/images/dv2/` | Hero coach, 6 testimonial photos |
| `assets/images/dv3/` | Hero coach |

**Hướng dẫn upload:**
1. WP Admin → **Media → Add New**
2. Upload tất cả ảnh theo từng thư mục
3. Vào từng trang → điền ACF field → chọn ảnh từ Media Library

> 💡 Không cần upload trùng nếu cùng ảnh xuất hiện ở nhiều trang.

---

## Liên hệ hỗ trợ kỹ thuật

Nếu cần hỗ trợ thêm, liên hệ dev team.
