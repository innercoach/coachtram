/* ═══════════════════════════════════════════════════════════
   sections.js — Edina Trâm V2
   <site-section> — reusable content sections loaded from /sections.

     <site-section name="instructor"
                   label="Đôi nét về Edina Trâm"
                   alt="Edina Trâm - chương trình TINA Awakening"></site-section>

   How it works:
     1. Fetches  sections/<name>.html
     2. Replaces {{key}} / {{key|fallback}} tokens with the element's
        attributes (or data-* attributes).
     3. Injects the result and fires `sections:loaded` so main.js can
        wire up interactions (reveal, FAQ, counters …) on the new nodes.

   NOTE: fetch() needs the page to be served over http(s) — GitHub Pages
   already is. For local preview run a static server from static-site/, e.g.
        python3 -m http.server 8080
   (opening the file directly via file:// will block the fetch).
   ═══════════════════════════════════════════════════════════ */

class SiteSection extends HTMLElement {
  async connectedCallback() {
    const name = this.getAttribute('name');
    if (!name) {
      console.warn('[site-section] missing "name" attribute', this);
      return;
    }
    const base = this.getAttribute('base') || 'sections/';
    // Any markup the author put inside the tag is kept as a fallback and only
    // replaced once the partial loads — so the section is never blank if the
    // fetch fails (offline, file:// preview, 404…).
    const fallback = this.innerHTML.trim();

    try {
      const res = await fetch(`${base}${name}.html`);
      if (!res.ok) throw new Error(`HTTP ${res.status}`);
      const raw = await res.text();
      this.innerHTML = this.interpolate(raw);
      document.dispatchEvent(new CustomEvent('sections:loaded', {
        detail: { element: this, name },
      }));
    } catch (err) {
      console.warn(`[site-section] could not load "${name}":`, err.message);
      if (!fallback) this.renderFallbackNotice();
    }
  }

  // Minimal, unobtrusive placeholder so a failed load degrades to *something*
  // (a link back home) instead of an empty gap.
  renderFallbackNotice() {
    this.innerHTML = `
    <section class="srv-section--alt" aria-label="Nội dung chưa tải được" style="text-align:center;">
      <div class="container">
        <p style="color:var(--color-fg-muted,#4A5B54);">Không tải được phần nội dung này.
          <a href="index.html" style="color:var(--color-primary,#005B45);text-decoration:underline;">Về trang chủ</a>.</p>
      </div>
    </section>`;
  }

  // {{key}} → attribute/data-* value; {{key|fallback}} → value or fallback.
  interpolate(html) {
    return html.replace(/\{\{\s*([\w-]+)\s*(?:\|([^}]*))?\}\}/g, (_, key, fallback) => {
      // Support both key and kebab-case (data-foo-bar → dataset.fooBar).
      const camel = key.replace(/-([a-z])/g, (_, c) => c.toUpperCase());
      const value = this.getAttribute(key) ?? this.dataset[key] ?? this.dataset[camel];
      return value != null ? value : (fallback != null ? fallback : '');
    });
  }
}
customElements.define('site-section', SiteSection);
