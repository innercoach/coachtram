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

brand/
  design.md             ← Design system documentation

Dich vu */              ← Ảnh tham khảo & content từng dịch vụ
assets/                 ← Ảnh dùng chung (static site backup)
```

## Công nghệ

- **WordPress** 6.0+ với custom theme PHP
- **Vanilla CSS** (CSS custom properties, no framework)
- **JavaScript** (Vanilla, Web Animations API)
- **Google Fonts**: Cormorant Garamond + Be Vietnam Pro
- **ACF / Custom Metaboxes** cho quản lý nội dung qua admin

## Deploy

Xem [`DEPLOY.md`](DEPLOY.md) — hướng dẫn triển khai theme lên server thật (import SQL snapshot hoặc cài mới thủ công), checklist sau deploy, và tối ưu production.

## Design System

Xem [`brand/design.md`](brand/design.md) — tài liệu đầy đủ về màu sắc, typography, spacing, components và animation.

---

© 2026 Edina Trâm. All rights reserved.
