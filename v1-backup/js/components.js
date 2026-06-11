class SiteHeader extends HTMLElement {
    connectedCallback() {
        const activePage = window.location.pathname.split("/").pop() || "index.html";
        
        this.innerHTML = `
        <header class="site-header">
            <div class="container nav">
                <a href="index.html" class="nav-logo">Edina <span>Trâm</span></a>
                <button class="nav-toggle" aria-label="Toggle navigation">
                    <span></span><span></span><span></span>
                </button>
                <nav class="nav-links">
                    <a href="index.html" class="${activePage === 'index.html' ? 'active' : ''}">Trang chủ</a>
                    <a href="index.html#services">Dịch vụ</a>
                    <a href="dich-vu-1.html" class="${activePage === 'dich-vu-1.html' ? 'active' : ''}">Passion to Profit</a>
                    <a href="dich-vu-2.html" class="${activePage === 'dich-vu-2.html' ? 'active' : ''}">Business to Freedom</a>
                    <a href="dich-vu-3.html" class="${activePage === 'dich-vu-3.html' ? 'active' : ''}">Business Mastery</a>
                    <a href="lien-he.html" class="btn btn-primary" style="background:var(--color-accent, #C8A244); color:#fff;">Thảo luận chiến lược</a>
                </nav>
            </div>
        </header>
        `;
    }
}
customElements.define('site-header', SiteHeader);

class SiteFooter extends HTMLElement {
    connectedCallback() {
        this.innerHTML = `
        <footer class="site-footer" style="margin-top:0;">
            <div class="container">
                <div class="footer-inner" style="border-top: 1px solid var(--home-border, rgba(255,255,255,0.08)); padding-top: var(--space-8);">
                    <div>
                        <div class="footer-logo">Edina <span>Trâm</span></div>
                        <p class="footer-tagline" style="max-width:320px; line-height:1.6; opacity:0.8;">Edina Trâm là Professional Coach chuyên nghiệp (ICF PCC). Đồng hành cùng chủ doanh nghiệp xây dựng kinh doanh bền vững và cân bằng cuộc sống tinh tế.</p>
                    </div>
                    <div>
                        <h4 class="footer-links-title">Dịch vụ</h4>
                        <ul class="footer-links">
                            <li><a href="dich-vu-1.html">Passion to Profit</a></li>
                            <li><a href="dich-vu-2.html">Business to Freedom</a></li>
                            <li><a href="dich-vu-3.html">Business Mastery</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="footer-links-title">Liên hệ</h4>
                        <ul class="footer-links">
                            <li><a href="mailto:coachtram@gmail.com">coachtram@gmail.com</a></li>
                            <li><a href="https://www.coachtram.com" target="_blank" rel="noopener">coachtram.com</a></li>
                            <li><a href="https://www.facebook.com/coachtram" target="_blank" rel="noopener">Facebook</a></li>
                            <li><a href="https://www.instagram.com/coachtram" target="_blank" rel="noopener">Instagram</a></li>
                        </ul>
                    </div>
                </div>
                <div class="footer-bottom">
                    &copy; 2026 Edina Tram. All rights reserved.
                </div>
            </div>
        </footer>
        `;
    }
}
customElements.define('site-footer', SiteFooter);
