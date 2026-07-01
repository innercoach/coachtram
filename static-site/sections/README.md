# Thư viện Section — `static-site/`

Các khối giao diện dùng lại được, đã tách khỏi từng trang HTML. Xem bản trực quan
(có preview + mã copy-paste) tại **[`thu-vien-section.html`](../thu-vien-section.html)**.

## Hai cơ chế

| Loại | Định nghĩa ở | Dùng khi |
|------|--------------|----------|
| **Web Component** (render ngay, không cần fetch) | [`js/components.js`](../js/components.js) | Phần khung lặp lại y hệt mọi trang: `<site-header>`, `<glow-blobs>`, `<site-footer>` |
| **Section động** (tải HTML từ thư mục này) | [`js/sections.js`](../js/sections.js) + file `.html` trong `sections/` | Khối nội dung dài, tuỳ biến theo trang: `<site-section name="instructor">` |

Mỗi trang chỉ cần nạp 3 script trước `</body>` (đúng thứ tự):

```html
<script src="js/components.js" defer></script>
<script src="js/sections.js" defer></script>
<script src="js/main.js" defer></script>
```

`main.js` tự gắn lại tương tác (reveal, FAQ, counter, smooth-scroll) cho cả nội dung
được chèn qua `<site-section>`, thông qua sự kiện `sections:loaded`.

## Dùng section động

```html
<site-section name="instructor"
              label="Người đồng hành"
              alt="Edina Trâm - chương trình TINA Awakening"></site-section>
```

- `name` → nạp `sections/<name>.html`.
- Mọi thuộc tính khác (hoặc `data-*`) được thay vào token `{{key}}` trong file partial.
- Token hỗ trợ giá trị mặc định: `{{key|giá trị mặc định}}`.

### Section hiện có

| name | File | Token |
|------|------|-------|
| `instructor` | [`instructor.html`](instructor.html) | `label`, `alt`, `img` |

## Thêm section mới

1. Tạo `sections/<ten>.html` chứa markup, dùng `{{token|mặc định}}` cho phần thay đổi.
2. Dùng `<site-section name="<ten>" ...></site-section>` trên trang.
3. (Khuyến khích) Thêm một mục minh hoạ vào `thu-vien-section.html`.

> ⚠️ Section động dùng `fetch()` nên trang phải chạy qua http(s). GitHub Pages đã sẵn sàng.
> Xem thử ở máy: `python3 -m http.server` trong thư mục `static-site/` rồi mở
> `http://localhost:8000/` (mở bằng `file://` sẽ chặn fetch).
