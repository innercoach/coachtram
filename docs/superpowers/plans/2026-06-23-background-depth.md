# Background Depth Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Replace flat dark emerald section backgrounds on `index.html` and `dich-vu-2.html` with a three-tier CSS-only background system (Emerald Veil, Sacred Paper, Silk Orbit) that adds visual depth without affecting content readability.

**Architecture:** Add four reusable utility classes (`bg-emerald-veil`, `bg-sacred-pattern`, `bg-silk-orbit`, `bg-soft-depth`) to a new imported CSS file `static-site/css/backgrounds.css`. Update existing shared selectors (`.section--dark`, `.srv-section--dark`, `.book-section`, `.cta-final`, `.srv-cta-final`) to use these utilities. Add section-specific classes to HTML only where the generic dark selector is insufficient to distinguish sections.

**Tech Stack:** Pure CSS (gradients, pseudo-elements, conic-gradient, radial-gradient). No external images, no JS, no new fonts.

## Global Constraints

- No external image assets — CSS only.
- No animation in this pass.
- Pattern opacity target 8–12%; must never obscure text.
- All `section.section--dark`, `section.srv-section--dark`, `.book-section`, `.cta-final`, `.srv-cta-final` must preserve white or near-white text and visible gold accents.
- Test scope limited to `static-site/index.html` and `static-site/dich-vu-2.html`.
- Do not touch footer, WordPress theme, or any page outside the two test files.
- No inline `style=` attributes added to HTML; use class additions only.
- Existing brand CSS variables only (`--emerald-noir`, `--deep-forest-ink`, `--emerald-depth`, `--fresh-emerald`, `--royal-gold`, `--champagne-glow`, `--pearl-ivory`, `--emerald-mist`).

---

## File Map

| File | Action | Purpose |
|---|---|---|
| `static-site/css/backgrounds.css` | **Create** | Four utility classes + light section depth selector |
| `static-site/css/style.css` | **Modify** | Add `@import url('backgrounds.css');` |
| `static-site/css/pages/home.css` | **Modify** | Remove hardcoded flat gradient from `.book-section` and `.cta-final` |
| `static-site/css/pages/service.css` | **Modify** | Remove hardcoded flat gradient from `.srv-section--dark`, `.srv-cta-final` |
| `static-site/css/design-system.css` | **Modify** | Remove hardcoded flat gradient from `.section--dark` |
| `static-site/index.html` | **Modify** | Add class `bg-sacred-pattern` to 3C section; add class `bg-silk-orbit` to `.cta-final` element |
| `static-site/dich-vu-2.html` | **Modify** | Add class `bg-sacred-pattern` to gốc-rễ section; add class `bg-silk-orbit` to `.srv-cta-final` element |
| `.gitignore` | **Modify** | Add `.superpowers/` line |

---

### Task 1: Add `.superpowers/` to `.gitignore`

**Files:**
- Modify: `.gitignore`

**Interfaces:**
- Produces: nothing consumed by other tasks; housekeeping step.

- [ ] **Step 1: Open `.gitignore` and append entry**

Add this block at the end of `.gitignore`:

```
# Visual brainstorming companion (local session files)
.superpowers/
```

- [ ] **Step 2: Verify the untracked directory is now ignored**

```bash
git status --short
```

Expected: `.superpowers/` no longer appears in the output.

- [ ] **Step 3: Commit**

```bash
git add .gitignore
git commit -m "chore: thêm .superpowers/ vào .gitignore"
```

---

### Task 2: Create `backgrounds.css` with four utility classes

**Files:**
- Create: `static-site/css/backgrounds.css`
- Modify: `static-site/css/style.css`

**Interfaces:**
- Produces:
  - `.bg-emerald-veil` — multi-layer deep emerald gradient with champagne glow
  - `.bg-sacred-pattern` — deep emerald + geometric pseudo-element pattern at 8–12% opacity
  - `.bg-silk-orbit` — conic/orbital conic gradient cinematic variant
  - `.bg-soft-depth` — light ivory base with very soft emerald + gold radial washes

- [ ] **Step 1: Create `static-site/css/backgrounds.css`**

```css
/* ═══════════════════════════════════════════════════════════
   BACKGROUNDS — Edina Trâm V2
   Reusable background depth utilities.
   All classes assume `position: relative; overflow: hidden;`
   already set on the target element.
   ═══════════════════════════════════════════════════════════ */

/* ── 1. Emerald Veil — default rich dark depth ─────────────
   Replaces the flat linear-gradient used on dark sections.
   Champagne glow top-left, emerald pulse bottom-right,
   diagonal light veil at low opacity.                        */
.bg-emerald-veil {
  background:
    radial-gradient(ellipse 800px 400px at 12% 15%, rgba(241, 216, 154, 0.20), transparent 60%),
    radial-gradient(ellipse 620px 380px at 88% 88%, rgba(11, 138, 102, 0.35), transparent 58%),
    linear-gradient(138deg, #012E24 0%, #014F3D 46%, #0B1F19 100%);
}

/* Subtle diagonal veil overlay via pseudo-element */
.bg-emerald-veil::after {
  content: "";
  position: absolute;
  inset: 0;
  pointer-events: none;
  background: linear-gradient(
    115deg,
    transparent 0% 41%,
    rgba(255, 255, 255, 0.04) 41% 44%,
    transparent 44% 100%
  );
}

/* ── 2. Sacred Paper — signature geometric pattern ──────────
   Deep emerald base + very low-opacity dot/grid pattern.
   Used on 1–2 conceptual sections (3C, gốc rễ chuyển hoá).
   Pattern lives in ::before; vignette in ::after.            */
.bg-sacred-pattern {
  background:
    radial-gradient(ellipse at 22% 12%, rgba(241, 216, 154, 0.16), transparent 28%),
    linear-gradient(160deg, #0B1F19 0%, #012E24 100%);
}

.bg-sacred-pattern::before {
  content: "";
  position: absolute;
  inset: -60px;
  pointer-events: none;
  opacity: 0.10;
  background-image:
    radial-gradient(circle at center, rgba(241, 216, 154, 0.70) 0px 1px, transparent 1.5px),
    repeating-linear-gradient(60deg,  transparent 0 18px, rgba(241, 216, 154, 0.22) 18px 19px),
    repeating-linear-gradient(120deg, transparent 0 22px, rgba(255, 255, 255, 0.12) 22px 23px);
  background-size: 20px 20px, 80px 80px, 96px 96px;
  transform: rotate(-6deg);
}

.bg-sacred-pattern::after {
  content: "";
  position: absolute;
  inset: 0;
  pointer-events: none;
  background: radial-gradient(ellipse at 50% 50%, transparent 38%, rgba(0, 0, 0, 0.16) 100%);
}

/* ── 3. Silk Orbit — cinematic CTA depth ───────────────────
   Conic orbital light field + double radial washes.
   Only for final CTA sections.                               */
.bg-silk-orbit {
  background:
    linear-gradient(rgba(1, 46, 36, 0.72), rgba(11, 31, 25, 0.92)),
    radial-gradient(ellipse at 18% 22%, rgba(241, 216, 154, 0.22), transparent 40%),
    radial-gradient(ellipse at 80% 76%, rgba(11, 138, 102, 0.30), transparent 42%),
    linear-gradient(130deg, #014F3D, #0B1F19);
}

.bg-silk-orbit::before {
  content: "";
  position: absolute;
  inset: -80px;
  pointer-events: none;
  background: conic-gradient(
    from 22deg at 50% 50%,
    transparent,
    rgba(241, 216, 154, 0.13),
    transparent,
    rgba(255, 255, 255, 0.045),
    transparent
  );
  opacity: 0.72;
}

/* Fine silk-line overlay */
.bg-silk-orbit::after {
  content: "";
  position: absolute;
  inset: 0;
  pointer-events: none;
  background-image: linear-gradient(115deg, rgba(255, 255, 255, 0.07) 0px 1px, transparent 1px 12px);
  background-size: 12px 12px;
  opacity: 0.22;
}

/* ── 4. Soft Depth — light section richness ─────────────────
   Used on `.section--alt` and hero to break ivory flatness.
   Very subtle; must not darken text or card contrast.        */
.bg-soft-depth {
  background:
    radial-gradient(ellipse 680px 320px at 8% 12%, rgba(11, 138, 102, 0.06), transparent 55%),
    radial-gradient(ellipse 560px 280px at 90% 88%, rgba(200, 162, 68, 0.07), transparent 55%),
    var(--color-bg-alt);
}

/* ── Reduced motion: collapse pseudo-element patterns ───── */
@media (prefers-reduced-motion: reduce) {
  .bg-sacred-pattern::before,
  .bg-silk-orbit::before,
  .bg-silk-orbit::after {
    opacity: 0;
  }
}
```

- [ ] **Step 2: Register the new file in `static-site/css/style.css`**

Current content of `static-site/css/style.css`:
```css
@import url('design-system.css');
@import url('components.css');
@import url('animations.css');
@import url('pages/home.css');
@import url('pages/service.css');
@import url('pages/contact.css');
```

Replace with:
```css
@import url('design-system.css');
@import url('components.css');
@import url('animations.css');
@import url('backgrounds.css');
@import url('pages/home.css');
@import url('pages/service.css');
@import url('pages/contact.css');
```

- [ ] **Step 3: Open a browser on `index.html` and confirm no CSS errors**

```bash
python3 -m http.server 8099 --directory static-site &
sleep 1
open "http://127.0.0.1:8099/index.html"
```

Expected: page loads, browser console shows no CSS parse errors.

- [ ] **Step 4: Kill the preview server**

```bash
pkill -f "http.server 8099" || true
```

- [ ] **Step 5: Commit**

```bash
git add static-site/css/backgrounds.css static-site/css/style.css
git commit -m "feat: thêm hệ thống background CSS (Emerald Veil, Sacred Paper, Silk Orbit)"
```

---

### Task 3: Apply Emerald Veil to shared dark section selectors

Remove the repeated flat gradient from the shared selectors and apply `.bg-emerald-veil` instead.

**Files:**
- Modify: `static-site/css/design-system.css` lines 253–254
- Modify: `static-site/css/pages/home.css` lines 299, 405
- Modify: `static-site/css/pages/service.css` lines 158, 499

**Interfaces:**
- Consumes: `.bg-emerald-veil` from Task 2
- Produces: updated selectors `.section--dark`, `.srv-section--dark`, `.book-section`, `.cta-final`, `.srv-cta-final` that inherit Emerald Veil depth

- [ ] **Step 1: Update `.section--dark` in `design-system.css`**

Find (lines ~252–256):
```css
.section--dark {
  background: linear-gradient(170deg, var(--emerald-noir) 0%, var(--deep-forest-ink) 100%);
  color: #fff;
}
```

Replace with:
```css
.section--dark {
  color: #fff;
}
```

Then append `.bg-emerald-veil` as the new default by adding it to the selector list. Find the rule for `.bg-emerald-veil` definition — it is in `backgrounds.css`. To make all `.section--dark` elements use it without adding HTML classes, add a bridging selector at the end of `design-system.css`:

```css
/* ── Bridge: apply Emerald Veil to all generic dark sections ── */
.section--dark:not(.bg-sacred-pattern):not(.bg-silk-orbit) {
  background:
    radial-gradient(ellipse 800px 400px at 12% 15%, rgba(241, 216, 154, 0.20), transparent 60%),
    radial-gradient(ellipse 620px 380px at 88% 88%, rgba(11, 138, 102, 0.35), transparent 58%),
    linear-gradient(138deg, #012E24 0%, #014F3D 46%, #0B1F19 100%);
}
.section--dark:not(.bg-sacred-pattern):not(.bg-silk-orbit)::after {
  content: "";
  position: absolute;
  inset: 0;
  pointer-events: none;
  background: linear-gradient(
    115deg,
    transparent 0% 41%,
    rgba(255, 255, 255, 0.04) 41% 44%,
    transparent 44% 100%
  );
}
```

- [ ] **Step 2: Update `.srv-section--dark` in `service.css`**

Find (lines ~157–160):
```css
.srv-section--dark {
  background: linear-gradient(170deg, var(--emerald-noir) 0%, var(--deep-forest-ink) 100%);
  color: #fff;
}
```

Replace with:
```css
.srv-section--dark {
  color: #fff;
}
```

Append a bridge selector at the bottom of `service.css`:
```css
/* ── Bridge: apply Emerald Veil to dark service sections ── */
.srv-section--dark:not(.bg-sacred-pattern):not(.bg-silk-orbit) {
  background:
    radial-gradient(ellipse 800px 400px at 12% 15%, rgba(241, 216, 154, 0.20), transparent 60%),
    radial-gradient(ellipse 620px 380px at 88% 88%, rgba(11, 138, 102, 0.35), transparent 58%),
    linear-gradient(138deg, #012E24 0%, #014F3D 46%, #0B1F19 100%);
}
.srv-section--dark:not(.bg-sacred-pattern):not(.bg-silk-orbit)::after {
  content: "";
  position: absolute;
  inset: 0;
  pointer-events: none;
  background: linear-gradient(
    115deg,
    transparent 0% 41%,
    rgba(255, 255, 255, 0.04) 41% 44%,
    transparent 44% 100%
  );
}
```

- [ ] **Step 3: Update `.book-section` in `home.css`**

Find (lines ~298–301):
```css
.book-section {
  background: linear-gradient(170deg, var(--emerald-noir) 0%, var(--deep-forest-ink) 100%);
  position: relative;
  overflow: hidden;
}
```

Replace `background` line only (keep `position` and `overflow`):
```css
.book-section {
  position: relative;
  overflow: hidden;
  background:
    radial-gradient(ellipse 800px 400px at 12% 15%, rgba(241, 216, 154, 0.20), transparent 60%),
    radial-gradient(ellipse 620px 380px at 88% 88%, rgba(11, 138, 102, 0.35), transparent 58%),
    linear-gradient(138deg, #012E24 0%, #014F3D 46%, #0B1F19 100%);
}
.book-section::after {
  content: "";
  position: absolute;
  inset: 0;
  pointer-events: none;
  background: linear-gradient(
    115deg,
    transparent 0% 41%,
    rgba(255, 255, 255, 0.04) 41% 44%,
    transparent 44% 100%
  );
}
```

- [ ] **Step 4: Update `.cta-final` in `home.css`**

Find (lines ~403–409):
```css
.cta-final {
  text-align: center;
  background: linear-gradient(170deg, var(--emerald-noir) 0%, var(--deep-forest-ink) 100%);
  padding-block: var(--space-32);
  position: relative;
  overflow: hidden;
}
```

Remove the flat `background` line only; the Silk Orbit class will be added to the HTML element in Task 4.

```css
.cta-final {
  text-align: center;
  padding-block: var(--space-32);
  position: relative;
  overflow: hidden;
}
```

- [ ] **Step 5: Update `.srv-cta-final` in `service.css`**

Find (lines ~497–503):
```css
.srv-cta-final {
  text-align: center;
  background: linear-gradient(170deg, var(--emerald-noir) 0%, var(--deep-forest-ink) 100%);
  padding-block: var(--space-24);
  position: relative;
  overflow: hidden;
}
```

Remove the flat `background` line; the Silk Orbit class will be added to HTML in Task 4.

```css
.srv-cta-final {
  text-align: center;
  padding-block: var(--space-24);
  position: relative;
  overflow: hidden;
}
```

- [ ] **Step 6: Quick visual check**

```bash
python3 -m http.server 8099 --directory static-site &
sleep 1
open "http://127.0.0.1:8099/index.html"
open "http://127.0.0.1:8099/dich-vu-2.html"
```

Confirm: dark sections (book, instructor, etc.) now show multi-layer gradient depth instead of flat gradient. Text remains white and legible. Kill server:

```bash
pkill -f "http.server 8099" || true
```

- [ ] **Step 7: Commit**

```bash
git add static-site/css/design-system.css static-site/css/pages/home.css static-site/css/pages/service.css
git commit -m "feat: áp Emerald Veil lên tất cả section dark"
```

---

### Task 4: Add Sacred Paper and Silk Orbit to target HTML sections

Add semantic classes to specific sections in `index.html` and `dich-vu-2.html`. No new inline styles.

**Files:**
- Modify: `static-site/index.html`
- Modify: `static-site/dich-vu-2.html`

**Interfaces:**
- Consumes: `.bg-sacred-pattern`, `.bg-silk-orbit` from Task 2

- [ ] **Step 1: Add `bg-sacred-pattern` to the 3C section in `index.html`**

Find this line in `index.html` (around line 271):
```html
<section class="section section--alt">
  <div class="container">
    <div class="section-header" data-reveal>
      <span class="badge badge--gold">Tam giác chuyển hoá 3C</span>
```

Change that opening tag to:
```html
<section class="section section--alt bg-sacred-pattern">
```

- [ ] **Step 2: Add `bg-silk-orbit` to the CTA final section in `index.html`**

Find (around line 461):
```html
<section class="cta-final section--dark">
```

Change to:
```html
<section class="cta-final section--dark bg-silk-orbit">
```

- [ ] **Step 3: Add `bg-sacred-pattern` to the crisis-return section in `dich-vu-2.html`**

Find the S4 section (around line 487):
```html
<section class="srv-section--alt" aria-label="Vì sao khủng hoảng cứ quay lại">
```

Change to:
```html
<section class="srv-section--alt bg-sacred-pattern" aria-label="Vì sao khủng hoảng cứ quay lại">
```

Note: `srv-section--alt` is a light section, but Sacred Paper includes its own dark base. We need the section to appear dark. Inspect the current HTML more carefully:

If the section uses `srv-section--alt` (light), the Sacred Paper dark base will clash. Check the actual class and change the selector accordingly:
- If the crisis section already has `srv-section` (no `--alt`), add `bg-sacred-pattern` directly.
- If it has `srv-section--alt`, we must either keep dark content colors via an extra class or switch to `srv-section bg-sacred-pattern`. Use: `srv-section bg-sacred-pattern` (plain, not `--alt`).

Run grep to confirm which class the section uses:
```bash
grep -n "Vì sao khủng hoảng" static-site/dich-vu-2.html
```

Apply the correct change based on the actual output.

- [ ] **Step 4: Add `bg-silk-orbit` to the CTA final section in `dich-vu-2.html`**

Find (around line 849):
```html
<section class="srv-cta-final" aria-label="Đặt lịch bắt đầu hành trình">
```

Change to:
```html
<section class="srv-cta-final bg-silk-orbit" aria-label="Đặt lịch bắt đầu hành trình">
```

- [ ] **Step 5: Add `bg-soft-depth` to light alternating sections in `index.html`**

Find the `.section--alt` sections that carry roots and 6-signs content (sections 3 and 7 in index). Those use `class="section section--alt"`. Add `bg-soft-depth`:

```html
<section class="section section--alt bg-soft-depth">
```

Do this for: the `Gốc rễ của sự chuyển hoá` section (section 3) and the `Testimonials` section (section 7). The 3C section gets `bg-sacred-pattern` so it does NOT get `bg-soft-depth`.

- [ ] **Step 6: Verify in browser**

```bash
python3 -m http.server 8099 --directory static-site &
sleep 1
open "http://127.0.0.1:8099/index.html"
open "http://127.0.0.1:8099/dich-vu-2.html"
```

Check visually:
- 3C section (Home): dark with geometric pattern faintly visible
- CTA final (Home): silk orbital depth visible
- Crisis section (DV2): dark with pattern
- CTA final (DV2): silk orbital depth
- eBook section (Home): Emerald Veil multi-layer gradient

Kill server:
```bash
pkill -f "http.server 8099" || true
```

- [ ] **Step 7: Commit**

```bash
git add static-site/index.html static-site/dich-vu-2.html
git commit -m "feat: áp Sacred Paper + Silk Orbit lên các section đặc trưng"
```

---

### Task 5: Verification and link check

**Files:**
- No modifications; read-only verification.

**Interfaces:**
- Consumes: all files modified in Tasks 1–4.

- [ ] **Step 1: Run static link checker**

```bash
python3 - <<'PY'
from pathlib import Path
import re, sys
root = Path('static-site')
missing = []
for f in root.glob('*.html'):
    s = f.read_text()
    for m in re.finditer(r'(?:href|src)="([^"]+)"', s):
        url = m.group(1)
        if url.startswith(('http', 'mailto:', 'tel:', '#')):
            continue
        path = url.split('#')[0].split('?')[0]
        if not path:
            continue
        if not (f.parent / path).exists():
            missing.append(f"{f}:{s[:m.start()].count(chr(10))+1}: {url}")
if missing:
    print('\n'.join(missing))
    sys.exit(1)
print('all local href/src targets exist')
PY
```

Expected: `all local href/src targets exist`

- [ ] **Step 2: Check git diff for whitespace errors**

```bash
git diff --check
```

Expected: no output (exit 0).

- [ ] **Step 3: Confirm all dark sections differ visually**

Open preview:
```bash
python3 -m http.server 8099 --directory static-site &
sleep 1
```

Navigate:
- `http://127.0.0.1:8099/index.html` — scroll through all dark sections
- `http://127.0.0.1:8099/dich-vu-2.html` — scroll through all dark sections

Visual checklist:
- [ ] eBook section (Home) — Emerald Veil depth, not flat
- [ ] 3C section (Home) — Sacred Paper geometric pattern faintly visible
- [ ] CTA final (Home) — Silk Orbit orbital glow visible
- [ ] Crisis/roots section (DV2) — Sacred Paper pattern faintly visible
- [ ] Instructor section (DV2) — Emerald Veil depth
- [ ] CTA final (DV2) — Silk Orbit orbital glow visible
- [ ] No dark section looks identical to another flat block
- [ ] All white text and gold accents remain legible

Kill server:
```bash
pkill -f "http.server 8099" || true
```

- [ ] **Step 4: Mobile check**

Open preview again with mobile viewport in browser dev tools. Confirm:
- No awkward hard background edges on mobile
- Pattern not visually overwhelming at small sizes
- All CTAs and text remain readable

- [ ] **Step 5: Commit verification note**

No code change needed. Record completion:
```bash
git log --oneline -5
```

Confirm all 4 prior commits are in the log.
