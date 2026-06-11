/* ═══════════════════════════════════════════════════════════
   main.js — Edina Trâm V2
   Core interactions: nav, scroll reveal, FAQ, countdown, etc.
   ═══════════════════════════════════════════════════════════ */

document.addEventListener('DOMContentLoaded', () => {

  // ══════════════════════════════════════════════════════════
  // 1. MOBILE NAV TOGGLE
  // ══════════════════════════════════════════════════════════
  const toggle = document.querySelector('.nav-toggle');
  const navLinks = document.querySelector('.nav-links');

  if (toggle && navLinks) {
    toggle.addEventListener('click', () => {
      const isOpen = navLinks.classList.toggle('open');
      toggle.classList.toggle('open', isOpen);
      toggle.setAttribute('aria-expanded', isOpen);
    });

    // Close on link click
    navLinks.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        navLinks.classList.remove('open');
        toggle.classList.remove('open');
        toggle.setAttribute('aria-expanded', false);
      });
    });
  }


  // ══════════════════════════════════════════════════════════
  // 2. HEADER HIDE ON SCROLL DOWN / SHOW ON SCROLL UP
  // ══════════════════════════════════════════════════════════
  const header = document.querySelector('.site-header');
  if (header) {
    let lastScrollY = window.scrollY;
    let ticking = false;

    window.addEventListener('scroll', () => {
      if (!ticking) {
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
      }
    }, { passive: true });
  }


  // ══════════════════════════════════════════════════════════
  // 3. SCROLL REVEAL (IntersectionObserver fallback)
  //    Only runs if browser doesn't support animation-timeline
  // ══════════════════════════════════════════════════════════
  const supportsScrollTimeline = window.CSS?.supports?.('animation-timeline', 'view()') || false;

  if (!supportsScrollTimeline) {
    const revealEls = document.querySelectorAll('[data-reveal], [data-reveal-stagger]');

    if (revealEls.length && 'IntersectionObserver' in window) {
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('revealed');
            observer.unobserve(entry.target);
          }
        });
      }, {
        threshold: 0.1,
        rootMargin: '0px 0px -40px 0px'
      });

      revealEls.forEach(el => observer.observe(el));
    }
  }


  // ══════════════════════════════════════════════════════════
  // 4. FAQ ACCORDION
  // ══════════════════════════════════════════════════════════
  const faqItems = document.querySelectorAll('.faq-item');
  if (faqItems.length) {
    faqItems.forEach(item => {
      const q = item.querySelector('.faq-q');
      if (!q) return;

      q.addEventListener('click', () => {
        const isActive = item.classList.contains('active');

        // Close all other items
        faqItems.forEach(i => i.classList.remove('active'));

        // Toggle current
        if (!isActive) {
          item.classList.add('active');
        }
      });
    });
  }


  // ══════════════════════════════════════════════════════════
  // 5. COUNTDOWN TIMER
  // ══════════════════════════════════════════════════════════
  const countdowns = document.querySelectorAll('.countdown[data-target]');
  countdowns.forEach(el => {
    const target = new Date(el.dataset.target).getTime();
    const daysEl = el.querySelector('.countdown-num--days');
    const hoursEl = el.querySelector('.countdown-num--hours');
    const minsEl = el.querySelector('.countdown-num--mins');
    const secsEl = el.querySelector('.countdown-num--secs');

    if (!daysEl || !hoursEl || !minsEl || !secsEl || !target) return;

    function update() {
      const now = Date.now();
      const diff = Math.max(0, target - now);

      const days = Math.floor(diff / (1000 * 60 * 60 * 24));
      const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const mins = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
      const secs = Math.floor((diff % (1000 * 60)) / 1000);

      daysEl.textContent = String(days).padStart(2, '0');
      hoursEl.textContent = String(hours).padStart(2, '0');
      minsEl.textContent = String(mins).padStart(2, '0');
      secsEl.textContent = String(secs).padStart(2, '0');

      if (diff > 0) requestAnimationFrame(() => setTimeout(update, 1000));
    }

    update();
  });


  // ══════════════════════════════════════════════════════════
  // 6. ANIMATED COUNTERS (stat numbers)
  // ══════════════════════════════════════════════════════════
  const counters = document.querySelectorAll('[data-count]');
  if (counters.length && 'IntersectionObserver' in window) {
    const counterObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const el = entry.target;
          const target = parseInt(el.dataset.count, 10);
          const suffix = el.dataset.suffix || '';
          const prefix = el.dataset.prefix || '';
          const duration = 1500;
          const start = performance.now();

          function animate(now) {
            const elapsed = now - start;
            const progress = Math.min(elapsed / duration, 1);
            // Ease-out cubic
            const eased = 1 - Math.pow(1 - progress, 3);
            const current = Math.round(eased * target);
            el.textContent = prefix + current + suffix;

            if (progress < 1) {
              requestAnimationFrame(animate);
            }
          }

          requestAnimationFrame(animate);
          counterObserver.unobserve(el);
        }
      });
    }, { threshold: 0.3 });

    counters.forEach(el => counterObserver.observe(el));
  }


  // ══════════════════════════════════════════════════════════
  // 7. SMOOTH SCROLL for anchor links
  // ══════════════════════════════════════════════════════════
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      const href = this.getAttribute('href');
      if (!href || href === '#') return;

      const target = document.querySelector(href);
      if (target) {
        e.preventDefault();
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });
  });


  // ══════════════════════════════════════════════════════════
  // 8. SCROLL-TO-TOP BUTTON
  // ══════════════════════════════════════════════════════════
  const scrollBtn = document.querySelector('.scroll-top-btn');
  if (scrollBtn) {
    window.addEventListener('scroll', () => {
      if (window.scrollY > 400) {
        scrollBtn.classList.add('visible');
      } else {
        scrollBtn.classList.remove('visible');
      }
    }, { passive: true });

    scrollBtn.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

});
