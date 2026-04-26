# Hướng Dẫn Nhập Dữ Liệu ACF – Coach Loan Vũ

> **Mục đích:** Nhập đúng data vào ACF để website WordPress hiển thị giống hoàn toàn với bản HTML mẫu đã thiết kế.

---

## Cách truy cập

1. Đăng nhập WordPress Admin: `https://loanvu.coachingbusiness.vn/wp-admin`
2. Vào **Pages** → chọn trang cần nhập → **Edit**
3. Cuộn xuống phần **ACF fields** phía dưới trình soạn thảo

> ⚠️ **Lưu ý:** Nếu bạn KHÔNG nhập data vào field nào, hệ thống sẽ tự động dùng **nội dung mặc định giống bản HTML** đã hardcode sẵn. Chỉ nhập khi bạn muốn thay đổi nội dung.

---

## I. TRANG CHỦ (Front Page)

**Trang:** Pages → Trang Chủ → Edit

### S1: Hero Section

| Field | Nhãn hiển thị | Nội dung cần nhập |
|---|---|---|
| `hero_eyebrow` | Eyebrow text | `F&B Startup Coach, ICF PCC` |
| `hero_title` | Tiêu đề chính | `Từ Đam mê đến Lợi nhuận,<br>Và Làm Chủ Nền Móng Tự Do.` |
| `hero_tagline` | Tagline | `Hơn 15 năm kinh nghiệm. Đồng hành cùng chủ quán F&B trên mọi chặng đường phát triển.` |
| `hero_cta_primary_label` | Nút chính | `Khám phá dịch vụ` |
| `hero_cta_primary_url` | Link nút chính | `#services` |
| `hero_cta_secondary_label` | Nút phụ | `Tư vấn 1:1 miễn phí` |
| `hero_cta_secondary_url` | Link nút phụ | URL trang liên hệ |
| `hero_image` | **Ảnh hero** | Upload ảnh coach (đã có sẵn trong theme: `dv3/hero-coach.png`) |

### S2: Services Ecosystem

> ℹ️ Nếu không nhập, 3 service cards mặc định sẽ hiển thị đúng.

Repeater `services` – thêm 3 rows:

| # | `service_number` | `service_name` | `service_description` | `service_color_class` | `service_url` |
|---|---|---|---|---|---|
| 1 | `01` | `Passion to Profit` | `Dành cho người chuẩn bị khởi nghiệp hoặc mới mở quán. Khoá học tập trung cấp tốc 2 ngày.` | `c-p2p` | `/passion-to-profit/` |
| 2 | `02` | `Business to Freedom` | `Dành cho chủ quán muốn thoát khỏi vận hành 24/7. Chương trình nhóm thực chiến kéo dài 10 tuần với quy trình SOP, kế toán và nhân sự rõ ràng.` | `c-b2f` | `/business-to-freedom/` |
| 3 | `03` | `Business Mastery` | `Coaching 1:1 cao cấp, giải quyết trực tiếp bài toán chiến lược mở rộng. Đồng hành từ 6-12 tháng, riêng biệt hoá theo mô hình của bạn.` | `c-bm` | `/business-mastery/` |

### S3: About Coach

| Field | Nội dung |
|---|---|
| `about_image` | Upload ảnh coach (mặc định: `dv1/hero-coach.png`) |
| `about_badge_image` | `ICF PCC Coach` |
| `about_name` | `Vũ Kiều Loan` |
| `about_title` | `Người đồng hành chiến lược cho chủ quán F&B Việt` |
| `about_bio` | `Hơn 16 năm trong ngành F&B & Hospitality tại Mỹ và Việt Nam. 10 năm khởi nghiệp, đồng sáng lập & điều hành <strong>S&L's Diner</strong> – chuỗi nhà hàng Mỹ tại Hà Nội. ICF PCC Coach quốc tế, Top 80 người Việt đạt chứng nhận cao nhất của ICF (2025). Tác giả cuốn sách truyền cảm hứng <em>Ánh Sáng Của Ước Mơ</em>.` |

Repeater `about_badges` – 4 rows:

| `badge_text` |
|---|
| `F&B Coach` |
| `ICF PCC` |
| `Tác giả sách` |
| `Chủ nhà hàng` |

Repeater `about_stats` – 4 rows:

| `stat_number` | `stat_label` |
|---|---|
| `16+` | `Năm kinh nghiệm F&B` |
| `50+` | `Chủ quán đồng hành` |
| `1.000` | `Cuốn sách đã bán` |
| `3` | `Chương trình Coaching` |

### S4: Book Section

| Field | Nội dung |
|---|---|
| `book_image` | Upload ảnh bìa sách (mặc định: `home/book-mockup.png`) |
| `book_eyebrow` | `Sách của Coach Loan Vũ` |
| `book_title` | `Ánh Sáng Của Ước Mơ` |
| `book_description` | `Cuốn sách truyền cảm hứng về hành trình chuyển hoá từ người đi làm thuê đến người làm chủ nhà hàng – ghi lại những vấp ngã, bài học và sức mạnh nội tâm giúp người trẻ bước vào con đường khởi nghiệp tự tin hơn.` |
| `book_highlight` | `Đã truyền cảm hứng cho hơn <strong>1.000 người trẻ</strong> trong hành trình khởi nghiệp F&B.` |
| `book_cta_buy_label` | `Mua Sách Ngay` |
| `book_cta_buy_url` | _(link mua sách)_ |

### S5: Testimonials

> ℹ️ Nếu không nhập, 3 testimonials mặc định (Cao Lan, Thanh Nga, Phạm Hiếu) sẽ tự hiển thị.

Repeater `testimonials` – thêm 3 rows:

| `testi_quote` | `testi_name` | `testi_role` | `testi_avatar` |
|---|---|---|---|
| `Mọi thứ không còn mơ hồ. Mình biết cái gì đang thiếu và cần thay đổi. Thay đổi đầu tiên là áp dụng các quy trình chuẩn cho quán.` | `Cao Lan` | `Chủ nhà hàng Việt ở Paris` | Upload ảnh |
| `Bước tiến của em là vận hành được quán và để dành được lợi nhuận. Mọi thứ đang vận hành đúng như mong muốn và em rất tự hào.` | `Thanh Nga` | `Chủ quán trà tại Bảo Lộc` | Upload ảnh |
| `Khoá học là bản đồ để dù mình đang làm gì cũng có thể đối chiếu. Dù kinh doanh bao lâu, mình vẫn cần soi lại để tìm hướng đi đúng.` | `Phạm Hiếu` | `Chủ cafe Việt ở Virginia, Mỹ` | Upload ảnh |

### S6: Social Channels

> ℹ️ Nếu không nhập, 4 kênh mặc định sẽ hiển thị.

Repeater `channels` – thêm 4 rows:

| `channel_icon` | `channel_name` | `channel_url` | `channel_description` |
|---|---|---|---|
| `📘` | `Facebook` | `https://www.facebook.com/loanvuk` | `Cộng đồng hỗ trợ & chia sẻ` |
| `📺` | `YouTube` | `https://www.youtube.com/@loanvuk` | `Nhận định & hướng dẫn thực chiến` |
| `📧` | `Newsletter` | _(link Substack)_ | `Insight kinh doanh qua Substack` |
| `🍽️` | `S&L's Diner` | _(link quán)_ | `Cửa hàng thực chiến của Loan's team` |

---

## II. PASSION TO PROFIT (Dịch vụ 1)

**Trang:** Pages → Passion to Profit → Edit  
**Template:** `page-passion-to-profit.php`

### S2: Credibility Section _(MỚI – bổ sung phiên 25/04)_

> ℹ️ Section ảnh giảng viên lớn + 4 stat cards ngay sau Hero.

| Field | Nội dung |
|---|---|
| `dv1_cred_title` | `Từ Đam mê đến Lợi nhuận bền vững` |
| `dv1_cred_image` | Upload ảnh giảng viên đang dạy học (mặc định: `dv1/instructor_1.png`) |

Repeater `dv1_stats` – 4 rows:

| `stat_num` | `stat_label` |
|---|---|
| `15+` | `Năm kinh nghiệm Nhà hàng, Khách sạn cao cấp ở Mỹ và Việt Nam` |
| `9+` | `Năm khởi nghiệp kinh doanh thực chiến ở thị trường Hà Nội` |
| `1000+` | `Cuốn sách được bán ra, truyền cảm hứng cho người trẻ khởi nghiệp` |
| `30+` | `Chủ quán đồng hành, đi từ con số 0 đến lợi nhuận bền vững` |

### Hero

| Field | Nội dung |
|---|---|
| `dv1_badge` | `Workshop F&B Online · 2 ngày` |
| `dv1_hero_image` | Upload ảnh hero (mặc định đã có) |
| `dv1_coach_label` | `Vũ Kiều Loan – F&B Coach` |
| `dv1_title_line1` | `PASSION <span>TO</span>` |
| `dv1_title_line2` | `PROFIT` |
| `dv1_tagline` | `"Bạn có phù hợp để kinh doanh nhà hàng không?"` |
| `dv1_description` | `Workshop 2 ngày online cực kỳ thực chiến – nơi bạn hiểu ngành F&B từ A–Z, tự đánh giá tiềm năng bản thân và phác thảo kế hoạch kinh doanh đầu tiên.` |
| `dv1_time` | `9:00–11:00 AM` |
| `dv1_date` | `14–15/03/2026` |
| `dv1_price` | `499.000 VNĐ` |
| `dv1_slots` | `30` |
| `dv1_countdown_target` | `March 14, 2026 09:00:00` |
| `dv1_cta_label` | `Đăng Ký Ngay – Chỉ 30 chỗ` |
| `dv1_scholarship_note` | `* Có học bổng 50% cho học viên đặc biệt, liên hệ để biết thêm.` |

### Target Audience – Repeater `dv1_targets`

| `target_number` | `target_text` |
|---|---|
| `01` | Bạn <strong>đang mơ mở quán</strong> nhưng chưa biết bắt đầu từ đâu |
| `02` | Bạn <strong>vừa mở quán</strong> và đang bị cuốn vào vận hành 24/7 |
| `03` | Bạn đang <strong>thua lỗ hoặc không có lãi</strong> dù quán đông khách |
| `04` | Bạn muốn <strong>thoát khỏi công việc văn phòng</strong> và tự kinh doanh |
| `05` | Bạn có vốn nhưng <strong>chưa có kế hoạch rõ ràng</strong> |
| `06` | Bạn <strong>đã từng thất bại</strong> và muốn làm lại đúng cách |

### Benefits – Repeater `dv1_benefits`

| `benefit_icon` | `benefit_title` | `benefit_description` |
|---|---|---|
| `🗺️` | `Bản đồ ngành F&B` | `Hiểu ngành từ A–Z: cấu trúc chi phí, mô hình doanh thu, điểm hoà vốn` |
| `🧭` | `Tự đánh giá tiềm năng` | `Bài kiểm tra thực tế để biết bạn đang ở đâu và cần gì để thành công` |
| `📋` | `Kế hoạch kinh doanh mẫu` | `Phác thảo được Business Plan cơ bản ngay trong buổi học` |
| `💰` | `Nền tảng tài chính` | `Hiểu P&L, cash flow và các con số cốt lõi một chủ quán phải biết` |
| `🤝` | `Cộng đồng F&B` | `Kết nối với 30+ học viên cùng chí hướng, có mentor theo dõi sau khoá` |
| `🎓` | `Certificate & Tài liệu` | `Trọn bộ tài liệu PDF, templates và chứng nhận hoàn thành` |

### Modules – Repeater `dv1_modules`

| `module_label` | `module_title` | `module_description` |
|---|---|---|
| `MODULE 1` | `Ngày 1: Biết Mình – Biết Ngành` | `Tự đánh giá năng lực, tìm hiểu cấu trúc ngành F&B, phân tích mô hình thành công và thất bại, xác định concept phù hợp với vốn và kỹ năng bản thân.` |
| `MODULE 2` | `Ngày 2: Lập Bản Đồ Hành Động` | `Xây dựng Business Plan cơ bản, tính toán chi phí đầu tư, dự báo doanh thu, thiết kế menu sơ bộ và lộ trình 90 ngày đầu tiên để mở quán.` |

### Testimonials – Repeater `dv1_testimonials`

> ℹ️ Để trống = hệ thống tự dùng 12 testimonial bundled sẵn.  
> Nếu nhập ít nhất 1 row → hệ thống dùng data ACF, cần nhập **đủ tất cả** học viên muốn hiển thị.

Thêm 12 rows theo thứ tự:

| `testi_name` | `testi_location` | `testi_quote` |
|---|---|---|
| `Lyly` | `Hà Nội` | `Workshop của chị Loan không chỉ truyền cảm hứng mà còn cho em công cụ thực tế để hành động. Giờ thì em biết mô hình nào phù hợp với vốn và năng lực của bản thân. Không còn mơ hồ như trước nữa.` |
| `Thu Hà` | `Hà Nội` | `Trước giờ em cứ nghĩ phải hoàn hảo rồi mới bắt đầu. Nhưng workshop này cho em thấy bắt đầu từ niềm tin và kế hoạch rõ ràng là đủ. Em muốn mở một quán cafe và bánh ngọt nhỏ nhỏ xinh xinh.` |
| `Hảo Hảo` | `Hà Nội` | `Em cảm ơn chị Loan rất nhiều khi buổi workshop hôm nay thực sự truyền động lực cho em gia nhập vào ngành F&B. Rất mong được tham dự thêm các buổi workshop của chị để làm rõ các chữ P.` |
| `Thuý Nga` | `Hà Nội` | `Tham gia workshop của Loan mà thấy giá trị quá. Chị ao ước mở một quán cafe nhỏ nhưng luôn sợ hãi sẽ thất bại. Nhờ Loan chia sẻ bí kíp, kiến thức, trải nghiệm mà chị có thêm dũng khí để quyết tâm xây dựng lại kế hoạch một cách rõ ràng.` |
| `Chu Phi Nga` | `Hà Nội` | `Sau khoá học, mình nhận ra rằng: đừng chỉ bắt đầu với đam mê. Đam mê phải đi liền với thực tế, kiểm soát những con số ngay từ khi bắt đầu.` |
| `Hoàng Lâm` | `TP HCM` | `Cảm ơn những kiến thức của chị Loan, giúp em hình dung được các thách thức của một người mới bắt đầu nếu mong muốn bước vào lĩnh vực của ngành F&B và tránh những quyết định dại dột dẫn đến mất tiền.` |
| `Liah Vu` | `Hà Nội` | `Tôi thấy tự tin hơn với con đường sắp tới, hiểu rõ hơn các chỉ số quan trọng về tài chính trong việc vận hành một mô hình kinh doanh và sẽ tiếp tục học tập, chia sẻ để biến ước mơ thành hiện thực.` |
| `Ly Khánh Lê` | `Hà Nội` | `Em từng đóng cửa một quán cà phê vì không biết kiểm soát chi phí. Hôm nay ngồi trong lớp học, em như được chữa lành. Không ai phán xét, không ai dạy đời, chỉ có sự thẳng thắn, rõ ràng, và những hướng dẫn cụ thể.` |
| `Diễm Trương` | `TP HCM` | `Toàn những kiến thức chuyên sâu, thực chiến một người đã trải qua bao nhiêu bài học. Thật quá giá trị.` |
| `Trần Vũ Kim Ngân` | `Biên Hoà` | `Sau chỉ 2 buổi workshop, em đã phác thảo được một bản kế hoạch kinh doanh rõ ràng. Bắt đầu từ chân dung khách hàng, tới việc giải quyết các vấn đề, nỗi đau của họ, biết cách làm mình khác biệt hơn với các đối thủ trên thị trường.` |
| `Dương Hằng` | `Hà Nội` | `Em tham gia chương trình và học được cách xây dựng kế hoạch và những thứ quan trọng cốt lõi trong việc xây dựng nhà hàng/quán cafe, dự toán doanh thu và chi phí để vận hành quán. Mọi thứ sắp không chỉ còn là giấc mơ.` |
| `Nguyễn Quốc Minh` | `Hà Nội` | `Qua 2 buổi workshop em hiểu được việc học hỏi từ những người đi trước là rất quan trọng. Đặc biệt với những ai mới bắt đầu khởi nghiệp sẽ tiết kiệm được rất nhiều thời gian, công sức và tiền bạc.` |

_(Ảnh: upload từ thư mục `assets/images/dv1/` theo tên tương ứng)_

### Instructor – Credentials – Repeater `dv1_credentials`

| `cred_number` | `cred_text` |
|---|---|
| `01` | `16 năm trong ngành F&B & Hospitality tại Mỹ và Việt Nam` |
| `02` | `10 năm khởi nghiệp: Đồng sáng lập & điều hành S&L's Diner – chuỗi nhà hàng Mỹ tại Hà Nội` |
| `03` | `ICF PCC Coach: Top 80 người Việt đạt chứng nhận quốc tế Coach chuyên nghiệp (2025)` |
| `04` | `Tác giả sách Ánh sáng của ước mơ, đã bán được hơn 1000 bản, chạm đến hơn 1000 người trẻ khởi nghiệp` |
| `05` | `Đồng hành cùng 50+ chủ quán từ con số 0 đến lợi nhuận bền vững` |

### FAQ – Repeater `dv1_faqs`

| `faq_question` | `faq_answer` |
|---|---|
| `Workshop này dành cho ai?` | `Dành cho người đang muốn mở quán F&B nhưng chưa biết bắt đầu từ đâu, hoặc đã mở quán nhưng đang gặp khó khăn về tài chính và vận hành.` |
| `Học online có hiệu quả không?` | `Hoàn toàn có. Workshop được thiết kế tương tác cao với bài tập thực hành trực tiếp, không phải chỉ nghe giảng. Bạn sẽ ra về với bản kế hoạch cụ thể.` |
| `499.000 có quá rẻ không?` | `Đây là chương trình nhập môn được thiết kế để nhiều người tiếp cận được. Business to Freedom và Business Mastery là các chương trình chuyên sâu hơn với mức đầu tư phù hợp.` |
| `Sau workshop tôi có thể làm gì?` | `Bạn sẽ có: bản đánh giá tiềm năng bản thân, Business Plan sơ bộ, hiểu rõ ngành F&B và kết nối cộng đồng 30+ học viên cùng chí hướng.` |
| `Có học lại được không?` | `Có. Bạn có thể tham gia lại khoá tiếp theo miễn phí nếu cảm thấy cần ôn lại kiến thức.` |

### CTA Final

| Field | Nội dung |
|---|---|
| `dv1_cta_quote` | `"Mỗi ngày bạn trì hoãn là mỗi ngày đối thủ tiến về phía trước."` |
| `dv1_cta_final_label` | `Đăng ký ngay hôm nay – Chỉ 30 chỗ cho Passion to Profit` |

---

## III. BUSINESS TO FREEDOM (Dịch vụ 2)

**Trang:** Pages → Business to Freedom → Edit  
**Template:** `page-business-to-freedom.php`

### Hero

| Field | Nội dung |
|---|---|
| `dv2_badge` | `Khoá học Chuyên sâu 10 tuần` |
| `dv2_hero_image` | Upload ảnh hero |
| `dv2_title` | `BUSINESS\nto FREEDOM` _(hai dòng, xuống dòng bằng Enter)_ |
| `dv2_tagline` | `Tự do khi quán vận hành không cần bạn 24/7` |
| `dv2_description` | `10 tuần thực chiến: Từ vận hành bằng cảm tính đến hệ thống SOP, quản lý tài chính và nhân sự bài bản. Bạn học cách để quán tự chạy.` |
| `dv2_schedule` | `10:00–12:00 Thứ 6` |
| `dv2_cohort_label` | `Khai giảng (K3)` |
| `dv2_start_date` | `27/03/2026` |
| `dv2_price` | `15.000.000 VNĐ` |
| `dv2_slots_note` | `* Khoá học chỉ nhận tối đa 10 học viên để đảm bảo chất lượng` |
| `dv2_countdown_target` | `March 27, 2026 10:00:00` |
| `dv2_cta_label` | `ĐĂNG KÍ NGAY` |

### Pain Points – Repeater `dv2_pains`

| `pain_icon` | `pain_title` | `pain_description` |
|---|---|---|
| `01` | `Quán đông nhưng không có lãi` | `Bạn bán cả ngày nhưng cuối tháng nhìn tài khoản vẫn trống. Không biết tiền đi đâu.` |
| `02` | `Không có quy trình – không thể đi vắng` | `Nhân viên làm việc theo cảm tính. Vắng mặt 1 ngày là quán loạn. Bạn mắc kẹt.` |
| `03` | `Nhân sự không ổn định` | `Tuyển mãi vẫn không giữ được người. Huấn luyện xong lại nghỉ. Bắt đầu lại từ đầu.` |
| `04` | `Không biết mở rộng hay dừng lại` | `Không có số liệu rõ ràng để đưa ra quyết định. Cảm giác vừa làm vừa đoán.` |

### So sánh – Quote cuối bảng _(MỚI – bổ sung phiên 25/04)_

| Field | Nội dung |
|---|---|
| `dv2_compare_quote` | `Nếu coi Passion to Profit là tấm bản đồ giúp bạn nhìn rõ địa hình, thì Business to Freedom là hành trình thực sự – nơi bạn đi từng bước, được trang bị đủ công cụ và có người đồng hành bên cạnh.` |

### Outcomes – Repeater `dv2_outcomes` _(MỚI – bổ sung phiên 25/04)_

> Section "Bạn nhận được gì sau 10 tuần học tập?" – hiển thị trước phần Curriculum.

| `outcome_number` | `outcome_title` | `outcome_description` |
|---|---|---|
| `01` | `Hệ thống SOP hoàn chỉnh` | `Quy trình vận hành chuẩn cho từng bộ phận: bếp, phục vụ, thu ngân – nhân viên tự làm đúng không cần nhắc.` |
| `02` | `Kiểm soát tài chính` | `Hiểu và tự lập báo cáo P&L hàng tháng, biết điểm hoà vốn và lợi nhuận thực sự của quán.` |
| `03` | `Menu Engineering` | `Phân tích hiệu suất từng món, tối ưu giá và cơ cấu menu để tăng biên lợi nhuận.` |
| `04` | `Đội ngũ tự vận hành` | `Xây hệ thống phân quyền, KPI rõ ràng để nhân sự chủ động – bạn không còn là người giải quyết mọi việc.` |
| `05` | `Kế hoạch tăng trưởng` | `Lộ trình 6–12 tháng tiếp theo với mục tiêu doanh thu, lợi nhuận và mở rộng cụ thể.` |
| `06` | `Cộng đồng & Network` | `Kết nối với 10 chủ quán cùng khoá và alumni network của các khoá trước.` |

### Instructor – Người đồng hành _(MỚI – bổ sung phiên 25/04)_

> Section "Ai là người đồng hành cùng bạn?" – hiển thị trước phần Học phí.

| Field | Nội dung |
|---|---|
| `dv2_instructor_image` | Upload ảnh Coach Vũ Kiều Loan (mặc định: `dv2/instructor.jpg`) |

Repeater `dv2_instructor_points` – 3 rows:

| `point_text` |
|---|
| `16 năm trong ngành F&B & Hospitality tại Mỹ và Việt Nam` |
| `Đồng sáng lập & điều hành S&L's Diner – chuỗi nhà hàng Mỹ tại Hà Nội` |
| `ICF PCC Coach – Top 80 người Việt đạt chứng nhận quốc tế cao nhất (2025)` |

### Testimonials – Repeater `dv2_testimonials`

> ℹ️ Để trống = hệ thống tự dùng 6 testimonial bundled sẵn.

Thêm 6 rows:

| `testi_name` | `testi_location` | `testi_result` | `testi_quote` |
|---|---|---|---|
| `Cao Lan` | `Chủ nhà hàng Việt ở Paris, Pháp` | `Chuẩn hoá quy trình đầu tiên trong mô hình` | `Dù khoá học bắt đầu lúc 2h sáng theo giờ Pháp, chị vẫn thấy rất hào hứng. Giá trị nhất là mọi thứ không còn mơ hồ. Mình biết cái gì đang thiếu và cần thay đổi. Thay đổi đầu tiên chính là áp dụng các quy trình chuẩn cho quán.` |
| `Phạm Hiếu` | `Chủ tiệm cafe Việt ở Virginia, Mỹ` | `5P trở thành bản đồ đối chiếu hàng ngày` | `Khoá học chính là công cụ, là bản đồ để dù mình đang làm gì thì cũng có thể quay lại đối chiếu xem mình đã làm đúng hay chưa. Dù kinh doanh bao lâu, mình vẫn cần soi chiếu lại để tìm hướng đi đúng.` |
| `Thanh Nga` | `Chủ quán trà trái cây Bảo Lộc` | `Lưu được lợi nhuận đợt đầu tiên` | `Bước tiến của em là vận hành được quán và để dành được lợi nhuận. Dù quán nhỏ, em đã bắt đầu bằng một kế hoạch kinh doanh hoàn chỉnh. Mọi thứ đang vận hành đúng như mong muốn và tự hào về bản thân.` |
| `Lân Anh` | `Chủ quán cà phê TP HCM` | `Hiểu rõ cần chuẩn bị gì từ ngày đầu` | `Đây là khóa học hiếm hoi giúp mình hiểu rõ từ ngày đầu cần chuẩn bị những gì. Loan không chỉ dạy kiến thức mà còn đồng hành như một người thầy thực sự.` |
| `Lê Quyền` | `Chủ cưới tiệc Hà Nội` | `Biết tại sao quán lời mà túi tiền vẫn cạn` | `Sự thay đổi lớn nhất sau khóa học là mình biết tại sao quán lời mà túi tiền vẫn cạn. Từ đó tôi kiểm soát được doanh thu và có kế hoạch mở rộng.` |
| `Phương Nabi` | `Chủ nhà hàng Fusion TP HCM` | `Phân tích rõ mô hình, tìm ra điểm đang tổn thất` | `Loan giúp tôi thấy rõ mô hình thực sự đang hoạt động như thế nào, cà phê hoá nào đang một mình gánh tổn thất. Chưa được phân tích như vậy hết.` |

### FAQ – Repeater `dv2_faqs`

| `faq_question` | `faq_answer` |
|---|---|
| `Chưa từng kinh doanh F&B có học được không?` | `Có. Bạn sẽ đi qua lộ trình 5P hệ thống để hiểu ngành, lập kế hoạch bài bản từ số 0, tránh các sai lầm đắt giá ngay từ đầu.` |
| `Đã mở quán nhưng gặp khó khăn, tôi có cần học?` | `Có. Bạn sẽ học cách rà soát lại toàn bộ, phân tích tài chính, tối ưu menu, quản lý nhân sự và xây dựng lại quy trình để quán tự vận hành được.` |
| `Tôi bận, không theo kịp hết thì sao?` | `Tất cả buổi học đều có tài liệu chi tiết, record và có thể xếp lịch coaching 1:1 với Loan để đảm bảo bạn không bị tụt lại.` |
| `Khác gì khoá Passion to Profit?` | `P2P là bước nền tảng (tổng quan định hướng). B2F là bước nâng cấp đi kèm thực hành làm bài tập, template, SOP chi tiết và coaching theo từng tuần để thực sự mở quán.` |
| `Không giỏi "số má" có theo được không?` | `Được. Các công cụ tài chính được thiết kế đơn giản, trực quan, phục vụ đúng góc nhìn của "người chủ quán" thay vì kế toán.` |
| `Số lượng học viên thế nào?` | `Chỉ tối đa 10 học viên mỗi khoá để đảm bảo chất lượng và Loan có thể theo sát từng mô hình kinh doanh.` |
| `Học xong có thể mở quán ngay không?` | `Có. Sân chơi B2F sẽ cung cấp cho bạn một bản thiết kế chi tiết: Kế hoạch kinh doanh, bản dự toán tài chính, menu định giá, sơ đồ nhân sự để bạn tự tin xúc tiến.` |
| `Có cung cấp tài liệu, template không?` | `Có. Trọn bộ template chuẩn bao gồm: Bảng báo cáo P&L, Menu Engineering, SOP, Checklist mở quán, Lean Canvas đã được Việt hoá và tuỳ chỉnh cho F&B.` |

### CTA Final _(Đã cập nhật phiên 25/04)_

> ⚠️ Các field cũ `dv2_cta_quote` đã được thay thế bằng cấu trúc mới gồm tiêu đề + dòng phụ.

| Field | Nội dung |
|---|---|
| `dv2_cta_heading` | `Bắt đầu hành trình từ Đam mê đến Tự do` |
| `dv2_cta_subtext` | `Khai giảng 27/03/2026 – Chỉ 10 chỗ/khoá` |
| `dv2_cta_final_label` | `ĐĂNG KÝ GIỮ CHỖ` |

---

## IV. BUSINESS MASTERY (Dịch vụ 3)

**Trang:** Pages → Business Mastery → Edit  
**Template:** `page-business-mastery.php`

### Hero

| Field | Nội dung |
|---|---|
| `dv3_badge` | `COACHING 1:1 CHIẾN LƯỢC DÀI HẠN` |
| `dv3_hero_image` | Upload ảnh hero |
| `dv3_title` | `BUSINESS MASTERY` |
| `dv3_tagline` | `Làm chủ mô hình của bạn ở cấp độ chiến lược` |
| `dv3_description` | `Chương trình Coaching 1:1 dài hạn 6–12 tháng, được thiết kế riêng cho từng doanh nghiệp F&B. Không template. Không giáo trình cứng. Chỉ có chiến lược phù hợp với MÔ HÌNH CỦA BẠN.` |
| `dv3_gift_text` | `Ưu đãi: Buổi tư vấn 1:1 cùng Loan miễn phí trị giá $200` |
| `dv3_cta_label` | `ĐĂNG KÍ NGAY` |

### Target Audience – Repeater `dv3_targets`

| `target_icon` | `target_title` | `target_description` |
|---|---|---|
| `🏆` | `Chủ quán có doanh thu nhưng chưa có lợi nhuận` | `Bạn đang bán được nhưng cuối tháng vẫn không có tiền để dành. Cần ai đó nhìn vào số liệu và tìm ra vấn đề cốt lõi.` |
| `📈` | `Đang muốn nhân rộng mô hình` | `Bạn có 1 quán ổn định và muốn mở thêm chi nhánh hoặc nhượng quyền, nhưng chưa biết xây hệ thống.` |
| `🔄` | `Đang tái cơ cấu hoặc pivot` | `Mô hình cũ không còn phù hợp. Bạn cần chiến lược để thay đổi mà không mất đi những gì đã xây dựng.` |
| `💼` | `Chủ quán từ 2 năm trở lên` | `Bạn đã có kinh nghiệm nhưng cảm thấy đang làm việc trong vòng lặp. Cần góc nhìn từ ngoài để bứt phá.` |

### Pricing Plans – Repeater `dv3_plans`

| `plan_duration` | `plan_subtitle` | `plan_price` | `plan_featured` |
|---|---|---|---|
| `6 tháng` | `Khởi động & định hướng chiến lược` | `35,000,000 VNĐ` | `No` |
| `9 tháng` | `Xây hệ thống & vận hành tự động` | `50,000,000 VNĐ` | `Yes (✓)` |
| `12 tháng` | `Mở rộng & nhân rộng mô hình` | `65,000,000 VNĐ` | `No` |

---

## V. CÀI ĐẶT TOÀN SITE (Global Settings)

**Vị trí:** WP Admin → **Site Settings** (menu phụ, cần ACF Options Page)

| Field | Nội dung |
|---|---|
| `global_logo_text` | `Coach <span>Loan Vu</span>` |
| `global_nav_cta_label` | `Thảo luận chiến lược` |
| `global_nav_cta_url` | URL trang liên hệ |
| `global_footer_tagline` | `Vũ Kiều Loan là F&B Startup Coach chuyên nghiệp (ICF PCC) với 16 năm kinh nghiệm tại Mỹ và Việt Nam.` |
| `global_footer_copyright` | `© 2026 Coach Loan Vu. All rights reserved.` |
| `global_social_facebook` | `https://www.facebook.com/loanvuk` |
| `global_social_instagram` | `https://www.instagram.com/loanvuk` |
| `global_social_email` | `loanvuk@gmail.com` |

---

## Thứ tự ưu tiên nhập data

```
1. Global Settings    → Ảnh hưởng toàn site (logo, nav CTA, footer)
2. Trang Chủ         → Hero, About, Book, Testimonials
3. Passion to Profit → Hero info, Modules, FAQ, CTA
4. Business to Freedom → Hero info, Curriculum, FAQ
5. Business Mastery  → Hero info, Pricing plans, Target
```

> 💡 **Mẹo:** Các field có `default_value` trong hệ thống sẽ tự hiển thị đúng ngay cả khi để trống. Chỉ cần nhập khi bạn muốn **cập nhật thông tin mới** (ngày khai giảng, học phí, v.v.)
