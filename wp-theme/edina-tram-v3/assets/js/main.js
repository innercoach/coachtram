/* ═══════════════════════════════════════════════════════════
   main.js — Edina Trâm V2
   Core interactions: nav, scroll reveal, FAQ, countdown, etc.

   Interactions that can apply to dynamically injected content
   (<site-section>) are written as init(root) helpers and re-run on the
   `sections:loaded` event. Each helper is idempotent (guarded by a
   data-flag) so running it twice on the same node is a no-op.
   ═══════════════════════════════════════════════════════════ */

const supportsScrollTimeline =
  window.CSS?.supports?.('animation-timeline', 'view()') || false;

// ── Scroll reveal (IntersectionObserver fallback) ──────────────────
let revealObserver = null;
function initReveal(root = document) {
  if (supportsScrollTimeline || !('IntersectionObserver' in window)) return;

  if (!revealObserver) {
    revealObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('revealed');
          revealObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
  }

  root.querySelectorAll('[data-reveal], [data-reveal-stagger]').forEach(el => {
    if (el.dataset.revealBound) return;
    el.dataset.revealBound = '1';
    revealObserver.observe(el);
  });
}

// ── FAQ accordion ──────────────────────────────────────────────────
function initFaq(root = document) {
  const faqItems = root.querySelectorAll('.faq-item');
  if (!faqItems.length) return;

  faqItems.forEach(item => {
    const q = item.querySelector('.faq-q');
    if (!q || item.dataset.faqBound) return;
    item.dataset.faqBound = '1';

    q.addEventListener('click', () => {
      const isActive = item.classList.contains('active');
      // Close siblings within the same page, then toggle current.
      document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('active'));
      if (!isActive) item.classList.add('active');
    });
  });
}

// ── Animated counters (stat numbers) ───────────────────────────────
let counterObserver = null;
function initCounters(root = document) {
  if (!('IntersectionObserver' in window)) return;

  if (!counterObserver) {
    counterObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        const el = entry.target;
        const target = parseInt(el.dataset.count, 10);
        const suffix = el.dataset.suffix || '';
        const prefix = el.dataset.prefix || '';
        const duration = 1500;
        const start = performance.now();

        (function animate(now) {
          const progress = Math.min((now - start) / duration, 1);
          const eased = 1 - Math.pow(1 - progress, 3); // ease-out cubic
          el.textContent = prefix + Math.round(eased * target) + suffix;
          if (progress < 1) requestAnimationFrame(animate);
        })(start);

        counterObserver.unobserve(el);
      });
    }, { threshold: 0.3 });
  }

  root.querySelectorAll('[data-count]').forEach(el => {
    if (el.dataset.countBound) return;
    el.dataset.countBound = '1';
    counterObserver.observe(el);
  });
}

// ── Smooth scroll for in-page anchor links ─────────────────────────
function initSmoothScroll(root = document) {
  root.querySelectorAll('a[href^="#"]').forEach(anchor => {
    if (anchor.dataset.smoothBound) return;
    anchor.dataset.smoothBound = '1';

    anchor.addEventListener('click', function (e) {
      const href = this.getAttribute('href');
      if (!href || href === '#') return;
      const target = document.querySelector(href);
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });
}

// Re-wire interactions when a <site-section> injects new markup.
document.addEventListener('sections:loaded', (e) => {
  const root = e.detail?.element || document;
  initReveal(root);
  initFaq(root);
  initCounters(root);
  initSmoothScroll(root);
});


document.addEventListener('DOMContentLoaded', () => {

  // ── Mobile nav toggle ────────────────────────────────────────────
  const toggle = document.querySelector('.nav-toggle');
  const navLinks = document.querySelector('.nav-links');

  if (toggle && navLinks) {
    toggle.addEventListener('click', () => {
      const isOpen = navLinks.classList.toggle('open');
      toggle.classList.toggle('open', isOpen);
      toggle.setAttribute('aria-expanded', isOpen);
    });

    navLinks.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        navLinks.classList.remove('open');
        toggle.classList.remove('open');
        toggle.setAttribute('aria-expanded', false);
      });
    });
  }

  // ── Header hide on scroll down / show on scroll up ───────────────
  const header = document.querySelector('.site-header');
  if (header) {
    let lastScrollY = window.scrollY;
    let ticking = false;

    window.addEventListener('scroll', () => {
      if (ticking) return;
      window.requestAnimationFrame(() => {
        const currentScrollY = window.scrollY;
        if (currentScrollY > 100) {
          if (currentScrollY > lastScrollY && currentScrollY > 200) {
            header.classList.add('site-header--hidden');
          } else {
            header.classList.remove('site-header--hidden');
          }
        } else {
          header.classList.remove('site-header--hidden');
        }
        lastScrollY = currentScrollY;
        ticking = false;
      });
      ticking = true;
    }, { passive: true });
  }

  // ── Re-runnable interactions (initial pass over the whole page) ───
  initReveal();
  initFaq();
  initCounters();
  initSmoothScroll();

  // ── Contact program prefill ──────────────────────────────────────
  const serviceSelect = document.querySelector('#service');
  if (serviceSelect) {
    const params = new URLSearchParams(window.location.search);
    const program = params.get('program');
    const aliases = { first_connection: 'first-connection', firstconnection: 'first-connection' };
    const value = aliases[program] || program;

    if (value && Array.from(serviceSelect.options).some(option => option.value === value)) {
      serviceSelect.value = value;
    }
  }

  // ── Countdown timer ──────────────────────────────────────────────
  document.querySelectorAll('.countdown[data-target]').forEach(el => {
    const target = new Date(el.dataset.target).getTime();
    const daysEl = el.querySelector('.countdown-num--days');
    const hoursEl = el.querySelector('.countdown-num--hours');
    const minsEl = el.querySelector('.countdown-num--mins');
    const secsEl = el.querySelector('.countdown-num--secs');
    if (!daysEl || !hoursEl || !minsEl || !secsEl || !target) return;

    (function update() {
      const diff = Math.max(0, target - Date.now());
      const days = Math.floor(diff / (1000 * 60 * 60 * 24));
      const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const mins = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
      const secs = Math.floor((diff % (1000 * 60)) / 1000);
      daysEl.textContent = String(days).padStart(2, '0');
      hoursEl.textContent = String(hours).padStart(2, '0');
      minsEl.textContent = String(mins).padStart(2, '0');
      secsEl.textContent = String(secs).padStart(2, '0');
      if (diff > 0) requestAnimationFrame(() => setTimeout(update, 1000));
    })();
  });

  // ── Scroll-to-top button ─────────────────────────────────────────
  const scrollBtn = document.querySelector('.scroll-top-btn');
  if (scrollBtn) {
    window.addEventListener('scroll', () => {
      scrollBtn.classList.toggle('visible', window.scrollY > 400);
    }, { passive: true });

    scrollBtn.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

});
