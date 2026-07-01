/* ═══════════════════════════════════════════════════════════
   components.js — Edina Trâm V2
   Reusable "chrome" as Web Components (inline templates, no fetch).
   These render synchronously so they work over file:// and http://,
   and stay in the initial DOM for the interaction scripts in main.js.

     <site-header active="dich-vu-1.html"></site-header>
     <glow-blobs></glow-blobs>
     <site-footer></site-footer>

   Content sections (bio, testimonials …) live in /sections and are
   loaded through <site-section> — see sections.js.
   ═══════════════════════════════════════════════════════════ */

/* Single source of truth for the primary navigation. Update once here
   and every page picks it up. */
const NAV_ITEMS = [
  { href: 'index.html',              label: 'Trang chủ' },
  { href: 'cau-chuyen-cua-toi.html', label: 'Câu chuyện của tôi' },
  { href: 'bai-viet-cua-tram.html',  label: 'Bài viết của Trâm' },
  { href: 'dich-vu-1.html',          label: 'TINA Awareness' },
  { href: 'dich-vu-2.html',          label: 'TINA Awakening' },
  { href: 'dich-vu-3.html',          label: 'TINA Alignment' },
];

const FOOTER_SOCIAL = `
        <div class="footer-social">
          <a href="https://www.facebook.com/edina.quynhtram" target="_blank" rel="noopener" aria-label="Facebook"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path></svg></a>
          <a href="mailto:lequynhtram@gmail.com" aria-label="Email"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg></a>
          <a href="https://edinatram.vn" target="_blank" rel="noopener" aria-label="Website"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"></path></svg></a>
        </div>`;

// ── <site-header active="dich-vu-1.html"> ──────────────────────────
class SiteHeader extends HTMLElement {
  connectedCallback() {
    // active can be passed explicitly; otherwise infer from the URL.
    const active = this.getAttribute('active')
      || window.location.pathname.split('/').pop()
      || 'index.html';

    const links = NAV_ITEMS.map(item => {
      const cls = item.href === active ? ' class="active"' : '';
      return `        <a href="${item.href}"${cls}>${item.label}</a>`;
    }).join('\n');

    this.innerHTML = `
  <header class="site-header">
    <div class="container nav">
      <a href="index.html" class="nav-logo">Edina <span>Trâm</span></a>
      <button class="nav-toggle" aria-label="Toggle navigation" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>
      <nav class="nav-links">
${links}
      </nav>
    </div>
  </header>`;
  }
}
customElements.define('site-header', SiteHeader);

// ── <glow-blobs> — decorative background accents ───────────────────
class GlowBlobs extends HTMLElement {
  connectedCallback() {
    this.innerHTML = `
    <div class="glow-blob glow-blob--gold glow-blob--1" aria-hidden="true"></div>
    <div class="glow-blob glow-blob--emerald glow-blob--2" aria-hidden="true"></div>`;
  }
}
customElements.define('glow-blobs', GlowBlobs);

// ── <site-footer> — footer + scroll-to-top button ──────────────────
class SiteFooter extends HTMLElement {
  connectedCallback() {
    this.innerHTML = `
  <footer class="site-footer">
    <div class="container">
      <div class="footer-inner">
        <div>
          <div class="footer-logo">Edina <span>Trâm</span></div>
          <p class="footer-tagline">Dẫn lối bình an, khai mở nội lực. Đồng hành cùng bạn trên hành trình kiến tạo cuộc sống chất lượng.</p>
        </div>
        <div class="footer-col">
          <h4>Về Trâm</h4>
          <div class="footer-links">
            <a href="cau-chuyen-cua-toi.html">Câu chuyện của tôi</a>
            <a href="bai-viet-cua-tram.html">Bài viết của Trâm</a>
            <a href="lien-he.html">Kết nối 1:1</a>
          </div>
        </div>
        <div class="footer-col">
          <h4>Dịch vụ</h4>
          <div class="footer-links">
            <a href="dich-vu-1.html">TINA Awareness</a>
            <a href="dich-vu-2.html">TINA Awakening</a>
            <a href="dich-vu-3.html">TINA Alignment</a>
          </div>
        </div>
        <div class="footer-col">
          <h4>Kết nối</h4>
          <div class="footer-links">
            <a href="lien-he.html">Liên hệ</a>
            <a href="mailto:lequynhtram@gmail.com">lequynhtram@gmail.com</a>
            <a href="tel:+84889590888">(+84) 88-9590-888</a>
            <a href="https://edinatram.vn" target="_blank" rel="noopener">edinatram.vn</a>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <span>© 2026 Edina Trâm. All rights reserved.</span>${FOOTER_SOCIAL}
      </div>
    </div>
  </footer>

  <button class="scroll-top-btn" aria-label="Cuộn lên đầu trang">↑</button>`;
  }
}
customElements.define('site-footer', SiteFooter);
