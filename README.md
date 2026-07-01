# Edina Trâm — Website & WordPress Theme

Website cá nhân của Coach Edina Trâm – F&B Startup Coach (ICF PCC).

## Giới thiệu

Hệ sinh thái dịch vụ hỗ trợ chủ quán F&B hướng tới kinh doanh bền vững thông qua 3 chương trình chính:

- **Passion to Profit** — Chuyển đổi đam mê thành lợi nhuận.
- **Business to Freedom** — Từ vận hành đến tự do.
- **Business Mastery** — Coaching 1:1 chiến lược dài hạn.

## Cấu trúc dự án

```
wp-theme/
  edina-tram-v2/        ← Theme hiện hành (v2.0.0)
    assets/css/
      design-system.css ← Design tokens, layout, typography
      components.css    ← Header, footer, button, card, FAQ…
      animations.css    ← Scroll reveal, parallax, keyframes
      pages/            ← Styles riêng từng trang
    assets/js/
      main.js           ← Nav, FAQ, countdown, scroll effects
    inc/
      metaboxes-*.php   ← Custom fields (admin)
  edina-tram/           ← V1 (legacy backup)
  coach-loan-vu/        ← V0 (legacy backup)

static-site/            ← Bản HTML/CSS/JS tĩnh để tham khảo/backup
  index.html
  dich-vu-*.html
  lien-he.html
  thu-vien-section.html ← Thư viện section/component (preview + mã copy-paste)
  css/
  js/
    components.js       ← Web Components: <site-header>, <glow-blobs>, <site-footer>
    sections.js         ← <site-section> nạp partial từ sections/
    main.js             ← Nav, reveal, FAQ, countdown, counter…
  sections/             ← Section động dùng lại (partial HTML) — xem sections/README.md
  assets/

content/                ← Tư liệu nội dung, kịch bản, slide nguồn
  tina-awakening/       ← Kịch bản DOCX/Markdown và media TINA Awakening
  legacy-services/      ← Tư liệu các gói dịch vụ cũ

feedback_1/             ← Feedback và kế hoạch triển khai đợt 1

tools/                  ← Script hỗ trợ/crop/sửa bản HTML tĩnh

docs/                   ← Tài liệu kỹ thuật phụ trợ

brand/
  design.md             ← Design system documentation
```

## Công nghệ

- **WordPress** 6.0+ với custom theme PHP
- **Vanilla CSS** (CSS custom properties, no framework)
- **JavaScript** (Vanilla, Web Animations API)
- **Google Fonts**: Cormorant Garamond + Be Vietnam Pro
- **ACF / Custom Metaboxes** cho quản lý nội dung qua admin

## Deploy

Xem [`DEPLOY.md`](DEPLOY.md) — hướng dẫn triển khai theme lên server thật (plugin demo import hoặc cài mới thủ công), checklist sau deploy, và tối ưu production.

> CSS production của theme là các file modular trong `wp-theme/edina-tram-v2/assets/css/`. Không cần chạy npm để deploy theme. Script Tailwind chỉ xuất file thử nghiệm `static-site/css/tailwind.css` và không ghi đè CSS production của theme.

## Design System

Xem [`brand/design.md`](brand/design.md) — tài liệu đầy đủ về màu sắc, typography, spacing, components và animation.

---

© 2026 Edina Trâm. All rights reserved.
