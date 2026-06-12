# Design System: Edina Trâm V2

Tài liệu này là nguồn sự thật duy nhất (single source of truth) cho toàn bộ hệ thống thiết kế thương hiệu **Edina Trâm**, đồng bộ trực tiếp từ `wp-theme/edina-tram-v2`.

---

## 1. Brand Identity & Tone

- **Tên thương hiệu**: Edina Trâm (Professional Coach — F&B Startup)
- **Website**: coachtram.com
- **Theme version**: 2.0.0

### Giá trị cốt lõi
| Giá trị | Mô tả |
| :--- | :--- |
| **Elegance** | Sang trọng, chăm chút tỉ mỉ trong từng chi tiết |
| **Quality** | Độc bản, mang lại giá trị bền vững vượt trội |
| **Authenticity** | Trung thực, tin cậy và giữ vững bản sắc riêng |
| **Timeless** | Giá trị được bảo chứng lâu dài theo thời gian |

### Tone of Voice
- **Sophisticated** — ngôn từ trang nhã, lịch thiệp, tôn trọng
- **Confident** — uy tín và năng lực chuyên môn tự nhiên
- **Approachable** — gần gũi, đồng hành, kết nối sâu sắc
- **Inspiring** — khơi gợi năng lượng tích cực

### Visual Style
Luxury · Timeless · Refined · Natural · Sophisticated

---

## 2. Color Palette

### 2.1 Brand Color Tokens (Raw values)

| CSS Variable | Brand Hex | Web Hex | Vai trò |
| :--- | :--- | :--- | :--- |
| `--pearl-ivory` | `#FBF8F0` | `#FBF8F0` | Nền chính toàn trang |
| `--emerald-mist` | — | `#ECF5F0` | Nền phụ (web-optimized) |
| `--emerald-mist-brand` | `#EAF2EC` | — | Nền phụ (brand original) |
| `--royal-emerald` | `#005B45` | — | Màu thương hiệu chủ đạo (brand) |
| `--fresh-emerald` | — | `#0B8A66` | Màu thương hiệu chủ đạo (web) |
| `--emerald-depth` | — | `#014F3D` | Xanh đậm cho footer & high-contrast |
| `--emerald-noir` | `#012E24` | — | Xanh tối nhất, dark sections |
| `--royal-gold` | `#C8A244` | `#C8A244` | Màu nhấn trang trí, icon, CTA phụ |
| `--champagne-glow` | `#F1D89A` | `#F1D89A` | Highlight, hover state |
| `--deep-forest-ink` | — | `#0B1F19` | Màu chữ nội dung chính |
| `--pale-gold-sand` | `#DED3B8` | `#DED3B8` | Viền, đường phân chia section |

### 2.2 Semantic Aliases (Dùng trong component)

```css
--color-bg:           var(--pearl-ivory)      /* nền trang */
--color-bg-alt:       var(--emerald-mist)     /* nền section xen kẽ */
--color-surface:      #FFFFFF                 /* card, modal */
--color-primary:      var(--royal-emerald)    /* CTA chính, tiêu đề */
--color-primary-web:  var(--fresh-emerald)    /* primary web-optimized */
--color-primary-dark: var(--emerald-noir)     /* dark hover */
--color-accent:       var(--royal-gold)       /* accent/highlight */
--color-accent-hover: var(--champagne-glow)   /* hover state accent */
--color-fg:           var(--deep-forest-ink)  /* body text */
--color-fg-muted:     #4A5B54                 /* text phụ */
--color-fg-subtle:    #6B7F75                 /* placeholder, caption */
--color-border:       var(--pale-gold-sand)   /* viền thông thường */
--color-border-light: rgba(222,211,184,0.4)   /* viền mỏng glassmorphism */
```

---

## 3. Typography

### Fonts

| Vai trò | Font | Fallback |
| :--- | :--- | :--- |
| **Heading** | `Cormorant Garamond` | Georgia, Times New Roman, serif |
| **Body / UI** | `Be Vietnam Pro` | system-ui, -apple-system, sans-serif |

```css
--font-heading: 'Cormorant Garamond', Georgia, 'Times New Roman', serif;
--font-body:    'Be Vietnam Pro', system-ui, -apple-system, sans-serif;
```

**Google Fonts import:**
```
Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600
Be+Vietnam+Pro:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400
```

### Type Scale (Major Third — 1.25 ratio)

| Token | rem | px | Dùng cho |
| :--- | :--- | :--- | :--- |
| `--text-xs` | 0.75rem | 12px | Caption, label nhỏ |
| `--text-sm` | 0.875rem | 14px | Nav link, footer text |
| `--text-base` | 1rem | 16px | Body text |
| `--text-lg` | 1.125rem | 18px | Subheading |
| `--text-xl` | 1.25rem | 20px | H3 nhỏ, tên card |
| `--text-2xl` | 1.5rem | 24px | Logo, footer heading |
| `--text-3xl` | 1.75rem | 28px | H3 |
| `--text-4xl` | 2.5rem | 40px | H2, stat number |
| `--text-5xl` | 3rem | 48px | H2 lớn |
| `--text-6xl` | 4rem | 64px | H1 desktop |
| `--text-7xl` | 5rem | 80px | Hero display |

### Heading Defaults

| Tag | Font size | Weight | Note |
| :--- | :--- | :--- | :--- |
| `h1` | `clamp(text-4xl, 6vw, text-6xl)` | 400 | letter-spacing: -0.01em |
| `h2` | `clamp(text-3xl, 4vw, text-4xl)` | 500 | |
| `h3` | `clamp(text-xl, 2.5vw, text-3xl)` | 600 | |

---

## 4. Spacing System (4px base)

```css
--space-0:  0
--space-1:  0.25rem   /* 4px */
--space-2:  0.5rem    /* 8px */
--space-3:  0.75rem   /* 12px */
--space-4:  1rem      /* 16px */
--space-5:  1.25rem   /* 20px */
--space-6:  1.5rem    /* 24px */
--space-8:  2rem      /* 32px */
--space-10: 2.5rem    /* 40px */
--space-12: 3rem      /* 48px */
--space-16: 4rem      /* 64px */
--space-20: 5rem      /* 80px */
--space-24: 6rem      /* 96px */
--space-32: 8rem      /* 128px */
```

---

## 5. Border Radius

```css
--radius-sm:   0.375rem   /* 6px  — input, badge */
--radius-md:   0.75rem    /* 12px — card, modal */
--radius-lg:   1.25rem    /* 20px — section block */
--radius-xl:   2rem       /* 32px — hero block */
--radius-full: 9999px     /* pill — button, avatar */
```

---

## 6. Shadow System (Emerald-tinted)

```css
--shadow-xs:    0 1px 3px rgba(1, 79, 61, 0.04)
--shadow-sm:    0 2px 12px rgba(1, 79, 61, 0.05)
--shadow-md:    0 4px 24px rgba(1, 79, 61, 0.07)
--shadow-lg:    0 8px 40px rgba(1, 79, 61, 0.09)
--shadow-xl:    0 16px 60px rgba(1, 79, 61, 0.12)
--shadow-gold:  0 4px 20px rgba(200, 162, 68, 0.15)
--shadow-inner: inset 0 2px 8px rgba(1, 79, 61, 0.06)
```

---

## 7. Glassmorphism

```css
--glass-bg:           rgba(251, 248, 240, 0.60)
--glass-bg-strong:    rgba(251, 248, 240, 0.80)
--glass-blur:         blur(16px)
--glass-blur-lg:      blur(24px)
--glass-border:       1px solid rgba(222, 211, 184, 0.35)
--glass-border-accent:1px solid rgba(200, 162, 68, 0.2)
```

Dùng cho: header cố định, sticky CTA bar, card--glass overlay.

---

## 8. Transitions & Easing

```css
/* Easing */
--ease-out-expo:  cubic-bezier(0.16, 1, 0.3, 1)
--ease-out-quart: cubic-bezier(0.25, 1, 0.5, 1)
--ease-in-out:    cubic-bezier(0.4, 0, 0.2, 1)
--ease-spring:    cubic-bezier(0.34, 1.56, 0.64, 1)

/* Duration */
--duration-fast:   150ms
--duration-base:   300ms
--duration-medium: 500ms
--duration-slow:   800ms
--duration-reveal: 1000ms
```

---

## 9. Layout

```css
--max-width:        1200px
--max-width-narrow: 900px
--max-width-wide:   1400px
--header-height:    72px
```

### Layout Classes

| Class | Mô tả |
| :--- | :--- |
| `.container` | max-width 1200px, centered, padding-inline 24px |
| `.container--narrow` | max-width 900px |
| `.container--wide` | max-width 1400px |
| `.section` | padding-block 96px |
| `.section--alt` | nền `--color-bg-alt` |
| `.section--dark` | gradient emerald-noir → deep-forest-ink, text trắng |
| `.grid-2` | 2 cột, gap 32px |
| `.grid-3` | 3 cột, gap 32px |
| `.grid-4` | 4 cột, gap 24px |

**Breakpoints:**
- `≤1024px`: grid-3, grid-4 → 2 cột
- `≤768px`: tất cả grid → 1 cột; section padding giảm; container padding 20px
- `≤480px`: container padding 16px; section padding 48px

---

## 10. Components

### 10.1 Buttons

| Class | Style |
| :--- | :--- |
| `.btn--primary` | Nền `--royal-emerald`, chữ `--pearl-ivory`; hover: `--emerald-depth` |
| `.btn--accent` | Nền `--royal-gold`, chữ trắng; hover: `#b38e33` + gold shimmer sweep |
| `.btn--outline` | Viền `--royal-gold`, chữ vàng; hover: bg vàng 8% |
| `.btn--outline-light` | Viền trắng 30%, chữ trắng — dùng trong dark section |
| `.btn--lg` | `text-base`, padding 16px 40px |
| `.btn--sm` | `text-xs`, padding 8px 20px |

Base: `border-radius: radius-full`, transform lift `-2px` on hover.

### 10.2 Cards

| Class | Style |
| :--- | :--- |
| `.card` | Nền trắng, viền `--color-border`, radius-lg; hover lift -6px |
| `.card--glass` | Glassmorphism bg/blur/border |
| `.card--accent-top` | Border-top 3px `--royal-gold` |
| `.card--dark` | Nền `--emerald-noir`, text trắng |

### 10.3 Badges

| Class | Style |
| :--- | :--- |
| `.badge` | Pill xanh nhạt, chữ `--fresh-emerald` |
| `.badge--gold` | Pill vàng nhạt, chữ `--royal-gold` |
| `.badge--outline` | Viền `--color-border`, chữ `--color-fg-muted` |
| `.badge--dark` | Dùng trong dark section |

### 10.4 Decorative Elements

- `.divider` — đường vàng 60×2px, gradient từ transparent (scroll-driven draw animation)
- `.divider--left` — căn trái
- `.gold-line` — đường dọc 1px gradient vàng
- `.glow-blob` — orbs mờ chuyển động (background atmosphere)
- `.shimmer-text` — text gradient vàng chạy liên tục
- `.gradient-text` — text gradient emerald↔gold animated 8s

---

## 11. Animation System

### 11.1 Scroll Reveal (`data-reveal`)

Dùng CSS `animation-timeline: view()` (modern) với fallback IntersectionObserver (JS).

| Attribute | Effect |
| :--- | :--- |
| `data-reveal` | Fade up từ translateY(40px) |
| `data-reveal="fade"` | Fade chỉ opacity |
| `data-reveal="scale"` | Scale từ 0.92 |
| `data-reveal="left"` | Slide từ trái translateX(-40px) |
| `data-reveal="right"` | Slide từ phải translateX(40px) |
| `data-reveal-stagger` | Children reveal lần lượt (6 con, delay 3% mỗi bước) |

### 11.2 Parallax (`data-parallax`)

| Attribute | Effect |
| :--- | :--- |
| `data-parallax="slow"` | ±30px theo scroll |
| `data-parallax="fast"` | ±60px theo scroll |

### 11.3 Animations khác

| Keyframe / Class | Mô tả |
| :--- | :--- |
| `blob-drift-1/2` | Glow blob di chuyển tự nhiên (20s/25s) |
| `gold-shimmer` | Gradient sweep trên `.shimmer-text` (4s linear infinite) |
| `gradient-shift` | Hero gradient text (8s ease-in-out infinite) |
| `draw-divider` | Divider vẽ vào khi scroll (scroll-driven) |
| `pulse-dot` | Chấm online pulse trên sticky CTA |
| `scroll-bounce` | Scroll indicator bounce (2s infinite) |

### 11.4 Accessibility

```css
@media (prefers-reduced-motion: reduce) {
  /* tất cả animation/transition → 0.01ms, glow-blob ẩn */
}
```

---

## 12. Tailwind Config Reference

Nếu dùng Tailwind thay vì vanilla CSS:

```javascript
module.exports = {
  theme: {
    extend: {
      colors: {
        brand: {
          bg:      { primary: '#FBF8F0', secondary: '#ECF5F0' },
          emerald: { DEFAULT: '#005B45', web: '#0B8A66', depth: '#014F3D', noir: '#012E24' },
          gold:    { DEFAULT: '#C8A244', glow: '#F1D89A', sand: '#DED3B8' },
          ink:     { DEFAULT: '#0B1F19' },
        }
      },
      fontFamily: {
        heading: ['"Cormorant Garamond"', 'serif'],
        body:    ['"Be Vietnam Pro"', 'sans-serif'],
      },
      fontSize: {
        'h1': ['64px', { lineHeight: '1.2' }],
        'h2': ['40px', { lineHeight: '1.3' }],
        'h3': ['28px', { lineHeight: '1.4' }],
        'sub': ['18px', { lineHeight: '1.5' }],
        'body': ['16px', { lineHeight: '1.6' }],
        'caption': ['12px', { lineHeight: '1.4' }],
      }
    },
  },
}
```
