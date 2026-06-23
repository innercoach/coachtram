# Tasks — Chỉnh sửa website Edina Trâm (Feedback 1)

> Nguồn yêu cầu: [`feedback_1/feedback-1.md`](feedback_1/feedback-1.md) + file Docx gốc.
> Kịch bản nội dung: [`content/tina-awakening/90-ngay-chuyen-hoa-TINA_awakening_v3.md`](content/tina-awakening/90-ngay-chuyen-hoa-TINA_awakening_v3.md)
> Quy trình: **làm trên bản HTML (`static-site/`) để duyệt trước → sau khi chốt mới port sang WP theme** (`wp-theme/edina-tram-v2/`).
> Git: mỗi mục = 1 commit trên nhánh `feedback-1` để dễ roll-back.

## Quy ước tên dịch vụ (GIỮ NGUYÊN URL)
| URL | Tên cũ | Tên mới | Format / Mô tả |
|-----|--------|---------|----------------|
| `/dich-vu-1/` | Passion to Profit | **TINA Awareness** | Nhập môn · 3 buổi kết nối · 3 ngày · 3.000.000 VNĐ |
| `/dich-vu-2/` | TINA Awakening | **TINA Awakening** | Chuyên sâu 12 tuần / 90 ngày · 12 module |
| `/dich-vu-3/` | Business Mastery | **TINA Alignment** | Đồng hành 6 tháng – 1 năm |

Bộ 3 chương trình thành hệ TINA: **Awareness → Awakening → Alignment**.
Ẩn hoàn toàn: **Tina Anchoring**, **Business Mastery**, **Passion to Profit**, các gói tương lai.

---

## GIAI ĐOẠN A — Bản HTML preview (`static-site/`)

### ✅ A7. Menu & Footer (Mục 7) — DONE (`ff56ddf`)
- [x] Menu 6 mục trên 5 trang, bỏ mục "Dịch vụ" gộp
- [x] Footer hệ tên mới, xoá tên cũ
- [x] Dropdown liên hệ đổi 4 chương trình + program slug
- [x] Đổi nhãn DV1 → **TINA Awareness** (nav/footer/trang chủ/dropdown)

### ✅ A3. Trang TINA Awakening `dich-vu-2.html` (Mục 3) — DONE (`977cdc2`, `26bdef8`, `4112c3e`)
- [x] Câu chốt to/đậm + style callout sang trọng (.tina-callout, --emerald, --gold)
- [x] Callout "Tôi đã đi qua đúng con đường…" (S3)
- [x] Bỏ "Nỗi đau quay lại…"; thêm callout "tiềm thức chưa tái cấu trúc" dưới 2 cột
- [x] Bỏ "tự hỏi phải chăng"; thêm "Chuyển hoá chỉ bền vững khi ba tầng cùng thay đổi"
- [x] Callout mạnh "Tôi không chỉ giúp bạn ổn hơn…"
- [x] Gỡ section "6 dấu hiệu" (chuyển sang trang chủ)
- [x] Thêm section "Điều gì khiến 90 ngày… khác biệt?" (5 ý kịch bản)
- [x] Giữ testimonial theo kịch bản; nhịp nền + cân bằng màu

### ✅ A4. Trang chủ `index.html` (Mục 4) — DONE (`ec1d0b5`, `d4a7fe9`)
- [x] Banner "Cảm ơn bạn đã có mặt ở đây" + CTA
- [x] Vì sao hành trình ra đời + callout + link Câu chuyện
- [x] Gốc rễ chuyển hoá (3 tầng)
- [x] Chuyển hoá thực sự — 6 dấu hiệu (đúng kịch bản)
- [x] Ảnh tam giác 3C signature
- [x] Hệ sinh thái 3 dịch vụ đổi tên
- [x] 3 testimonial Awakening
- [x] Giữ Sách (→ eBook miễn phí) + Đa kênh

### ✅ A8. Hai trang dịch vụ (Mục 8) — DONE (local/static preview)
**A8.1 — `dich-vu-1.html` → TINA Awareness** (đã viết lại)
- [x] Đổi title/meta/hero: "TINA Awareness", bỏ countdown/giá workshop cũ
- [x] Định vị: chương trình **nhập môn**, mục tiêu giúp khách bắt đầu kết nối & tìm hiểu bản thân
- [x] Thời lượng: **3 ngày · 3 phiên kết nối**
- [x] Giá: **3.000.000 VNĐ**
- [x] Phần "Dành cho bạn nếu…" (nhập môn)
- [x] CTA → `lien-he.html` (chương trình awareness)
- [x] Xoá toàn bộ nội dung F&B/workshop/học bổng/Zalo cũ
- [x] Cập nhật nav active = TINA Awareness; nhịp nền + mobile

**A8.2 — `dich-vu-3.html` → TINA Alignment** (đã viết lại)
- [x] Đổi title/meta/hero: "TINA Alignment"
- [x] Thời lượng: **6 tháng – 1 năm**
- [x] Trọng tâm: đồng hành hiện thực hoá mục tiêu hành động; bám tầm nhìn 5–10 năm & mục tiêu từ **Module 10 của TINA Awakening**
- [x] Phần "Dành cho bạn nếu…" / "Không dành cho bạn nếu…"
- [x] Xoá toàn bộ nội dung Business Mastery / F&B / Mastermind / bảng so sánh cũ
- [x] CTA → `lien-he.html` (chương trình alignment)
- [x] Cập nhật nav active = TINA Alignment; nhịp nền + mobile

### ✅ A5. Trang "Câu chuyện của tôi" (Mục 5) — DONE (local/static preview)
- [x] Trang độc lập, ngang hàng trang chủ (đã có link trong menu)
- [x] Cấu trúc 3S: **Story** (câu chuyện cá nhân) → **Solution** (Trâm đã chuyển hoá & tìm hướng đi) → **Success** (đồng hành & tạo giá trị)
- [x] Gộp nội dung "Người đồng hành" + "Đôi nét về Edina Trâm" (lấy từ phần đã gỡ ở trang chủ + DV2)
- [x] Dòng "Chân thực - Thấu hiểu - Truyền cảm hứng" + dòng EN in nghiêng "Authenticity - Compassionate - Inspiration"
- [x] Câu "Điều thú vị ở Edina Trâm…" → trình bày testimonial in nghiêng + attribution **"chị Mai Hương - Giám đốc Chiến lược khách hàng, cty TNT"**
- [x] Cập nhật 4 chỉ số: **20+ năm kinh nghiệm · 30+ đất nước · 7,500+ giờ học tập · 1000+ giờ huấn luyện, đào tạo**
- [x] Nav/footer + nhịp nền + mobile

### ✅ A6. Trang "Bài viết của Trâm" (Mục 6) — DONE (local/static preview)
- [x] Layout thư viện bài viết dạng **card** (mô phỏng cho WP blog gốc)
- [x] Phân nhóm chủ đề (vd: Chữa lành · Thấu hiểu bản thân · Chuyển hoá tâm thức) — dạng filter/section
- [x] Mỗi card: Chủ đề · Tiêu đề · Mô tả ngắn · link Substack (mở tab mới)
- [x] Không import nội dung Substack; chỉ link ra ngoài
- [x] Nav/footer + mobile
- [x] (Ghi chú: WP sẽ dùng **blog gốc** — xem B6)

---

## GIAI ĐOẠN B — Port sang WordPress theme (`wp-theme/edina-tram-v2/`)
> Thực hiện SAU khi toàn bộ HTML được duyệt.

### ⬜ B7. Menu & Footer
- [ ] `header.php`: menu hardcode → 6 mục mới (TINA Awareness/Awakening/Alignment + 2 trang mới)
- [ ] `footer.php`: cột "Về Trâm" + "Dịch vụ" theo tên mới
- [ ] `inc/demo-import.php`: đổi tên dịch vụ, **xoá** Passion to Profit / Business Mastery / Tina Anchoring

### ⬜ B2 + B3. Trang TINA Awakening + FIX BUG LỆCH FIELD (Mục 2 + 3)
- [ ] **Fix lệch field** giữa `page-dich-vu-2.php` (frontend) và `inc/metaboxes-dv2.php` (admin):
  - `dv2_what_*` (FE) ↔ `dv2_why_*` (admin)
  - `dv2_letter_content` (FE) ↔ `dv2_letter_p1..p4` + `dv2_letter_quote` (admin)
  - `dv2_target_caveat` (FE) ↔ `dv2_target_quote` (admin)
  - `dv2_inst_intro` (FE) ↔ `dv2_inst_bio` (admin)
  - `dv2_inst_heading` (FE) ↔ `dv2_inst_title` (admin)
  - → Hướng: sửa frontend đọc đúng key admin (không mất nội dung đã nhập); thư ngỏ render 5 field rời
- [ ] Port các thay đổi nội dung/callout từ `dich-vu-2.html` sang `page-dich-vu-2.php`
- [ ] Bổ sung field metabox cho section "khác biệt" + callout mới
- [ ] Test: nhập admin → hiển thị đúng frontend

### ⬜ B4. Trang chủ
- [ ] Port `index.html` → `front-page.php`
- [ ] Cập nhật `inc/metaboxes-home.php` cho các section mới (banner/gốc rễ/6 dấu hiệu/tam giác/eBook/đa kênh)

### ⬜ B8. Hai trang dịch vụ
- [ ] `page-dich-vu-1.php` + `inc/metaboxes-dv1.php` → TINA Awareness
- [ ] `page-dich-vu-3.php` + `inc/metaboxes-dv3.php` → TINA Alignment
- [ ] Đổi taxonomy testimonial/FAQ slug nếu cần (giữ `dich-vu-1/2/3`)

### ⬜ B5. Trang "Câu chuyện của tôi"
- [ ] Tạo template `page-cau-chuyen-cua-toi.php` + metabox riêng (3S, chỉ số, testimonial Mai Hương)
- [ ] Tạo Page trong WP gán slug `cau-chuyen-cua-toi`

### ⬜ B6. Trang "Bài viết của Trâm" (blog WP gốc)
- [ ] Dùng **Posts gốc**: tạo category chủ đề (Chữa lành / Thấu hiểu bản thân / Chuyển hoá tâm thức)
- [ ] Thêm field meta "Link Substack" cho post (redirect khi click)
- [ ] Template `archive`/`page` hiển thị card theo nhóm chủ đề
- [ ] Gán trang vào slug `bai-viet-cua-tram`

### ⬜ B-test. Kiểm thử WP (Mục 12)
- [ ] `php -l` toàn bộ `*.php` + `inc/*.php`
- [ ] Test admin metabox DV2 (nhập → frontend đúng)
- [ ] Desktop + mobile cho tất cả trang
- [ ] Rà tên cấm: Business Mastery / Tina Anchoring / Passion to Profit
- [ ] CTA đi đúng form theo `?program=`

---

## GIAI ĐOẠN C — Ngoài phạm vi "Mục 1–8" (làm sau khi có yêu cầu)
- [ ] **Mục 9** — Form riêng từng chương trình (Fluent Forms): `first_connection`, `connect_3`/`awareness`, `awakening`, `alignment` + điều hướng `?program=` + luồng qualify
- [ ] **Mục 10** — Phễu eBook quản trị được (title/mô tả/ảnh/CTA/PDF) — hiện trang chủ đã có khối eBook placeholder
- [ ] **Mục 11** — Polish UI/UX (gradient, glass, pattern chìm, bóng mềm) toàn site
- [ ] **Mục 13** — Rà soát giả định triển khai (Substack chỉ link ra ngoài, v.v.)

---

## FEEDBACK 2 — Nhận diện High-end + Biểu đồ + Phễu Awakening (HTML preview)

### ✅ F2.2. Hệ màu metallic gold (high-end) — DONE (`98f3e78`)
- [x] Token nhũ vàng kim loại bắt sáng (--gold-metallic/-line/-soft/-sheen/-ink)
- [x] Bỏ tông sand xỉn ở viền (--color-border → gold-tint)
- [x] btn--accent gradient kim loại; badge--gold gradient; divider champagne
- [x] Emerald giữ vai trò chính + nhũ vàng nâng cấp (theo chốt)
- [ ] *(tiếp)* Lan toả hiệu ứng metallic/light-catching sâu hơn nếu cần

### ✅ F2.1. Biểu đồ tam giác SVG — DONE (`b3bd15a`)
- [x] Dựng lại bằng SVG (thay PNG) — metallic gold, nền emerald mystical
- [x] ™ (Trademark) + T.I.N.A (có dấu chấm) + slogan "Transformation Into New Awareness"
- [x] 3 ô giải thích ở 3 đỉnh: Clarity / Confidence / Connection (giữ 3C theo chốt)

### ✅ F2.3. Trang Awakening (dv2) dạng phễu — DONE (`4a5f580`)
- [x] Giá 29.000.000 VNĐ (số lẻ — neo giá tâm lý)
- [x] 1 CTA duy nhất "Đặt lịch phiên khám phá" → Calendly (placeholder)
- [x] Bỏ mọi lựa chọn mua/gói nhỏ
- [x] Neo giá phiên khám phá 1.000.000đ → MIỄN PHÍ
- [x] FAQ: signature đầu, "trị liệu tâm lý" cuối

> Ghi chú khi port WP (Giai đoạn B): áp lại token metallic gold, biểu đồ SVG
> (làm partial dùng chung), giá 29tr + Calendly cho `page-dich-vu-2.php`,
> và bổ sung field admin cho biểu đồ/Calendly nếu cần.
