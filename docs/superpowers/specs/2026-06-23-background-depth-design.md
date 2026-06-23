# Background Depth Design — Home + TINA Awakening

Date: 2026-06-23

## Goal

Make section backgrounds richer and less flat on the static HTML preview, especially dark emerald sections that currently read as smooth blocks. Test the visual system on:

- `static-site/index.html`
- `static-site/dich-vu-2.html`

This is a design-only spec. Implementation happens after approval and planning.

## Approved Direction

Use a controlled hybrid:

1. **A — Emerald Veil** as the system-wide dark background language.
2. **B — Sacred Paper** as a very subtle signature pattern for 1–2 important sections.
3. **C — Silk Orbit** only for final CTA sections.

The visual tone should remain elegant, premium, calm, and readable. Backgrounds add depth, not noise.

## Design Tokens

Use existing brand colors as source:

- `--emerald-noir` `#012E24`
- `--deep-forest-ink` `#0B1F19`
- `--emerald-depth` `#014F3D`
- `--fresh-emerald` `#0B8A66`
- `--royal-gold` `#C8A244`
- `--champagne-glow` `#F1D89A`
- `--pearl-ivory` `#FBF8F0`
- `--emerald-mist` `#ECF5F0`

Add no new external assets for this first pass. Use CSS gradients and procedural patterns so the test stays light, reversible, and fast to port to WordPress later.

## Background System

### 1. Emerald Veil — default dark depth

Purpose: replace flat dark emerald sections and repeated `linear-gradient(170deg, var(--emerald-noir), var(--deep-forest-ink))`.

Visual recipe:

- base deep emerald diagonal gradient
- champagne radial glow near upper-left or upper center
- emerald radial glow near lower-right
- one very subtle diagonal light veil

Usage:

- Home eBook section
- DV2 instructor section
- any future dark content section that needs richness but not drama

Behavior:

- Text remains white or near-white.
- Gold accents remain visible.
- Background must not compete with portraits/cards.

### 2. Sacred Paper — signature pattern

Purpose: make one or two conceptual sections feel uniquely TINA, not generic wellness-site dark blocks.

Visual recipe:

- deep emerald base
- very low-opacity geometric dot/line pattern
- optional soft vignette
- pattern opacity target: 8–12% on desktop; lower if it competes with text

Usage:

- Home: `Tam giác chuyển hoá 3C` section
- DV2: `Gốc rễ chuyển hoá` / crisis-return section, where content talks about subconscious restructuring and root causes

Behavior:

- Pattern should be felt before seen.
- No mandala/boho/spa feeling. Keep geometric, restrained, editorial.
- Cards inside pattern sections can stay light/glass for contrast.

### 3. Silk Orbit — final CTA emphasis

Purpose: make final CTA sections feel like a closing invitation, not another flat block.

Visual recipe:

- dark emerald base
- soft gold/emerald radial glows
- conic/orbital light field at low opacity
- optional fine silk-line overlay

Usage:

- Home final CTA: `.cta-final`
- DV2 final CTA: `.srv-cta-final`

Behavior:

- Only use on final CTA sections in this test.
- More emotional/cinematic than Emerald Veil, but still quiet enough for headline and button clarity.
- Avoid animation for first pass; motion can be considered after visual acceptance.

### 4. Light section depth

Purpose: avoid flat alternation between `--color-bg` and `--color-bg-alt`.

Visual recipe:

- very soft radial emerald wash
- very soft champagne wash
- keep ivory/mist base visible

Usage:

- Home hero and `section--alt` backgrounds where appropriate
- DV2 hero/open letter/alt sections, but lightly

Behavior:

- Must still read as light sections.
- Cards should remain clearly separated.
- No heavy texture behind long paragraphs.

## CSS Architecture

Create reusable background utility classes in shared CSS, likely `static-site/css/design-system.css` or a new imported file if cleaner:

- `.bg-emerald-veil`
- `.bg-sacred-pattern`
- `.bg-silk-orbit`
- `.bg-soft-depth`

Also update shared dark section selectors where appropriate:

- `.section--dark`
- `.srv-section--dark`
- `.book-section`
- `.cta-final`
- `.srv-cta-final`
- `.site-footer` only if the test proves it helps; footer is not primary scope

Implementation should avoid scattering new inline styles through `index.html` and `dich-vu-2.html`. Page files may receive a small number of semantic classes for section-specific selection.

## Home Page Application

Target file: `static-site/index.html`

Planned application:

1. Hero and light/alt sections: optional `.bg-soft-depth` or shared selector enhancement.
2. `Tam giác chuyển hoá 3C`: apply Sacred Paper signature pattern.
3. `book-section`: apply Emerald Veil.
4. `cta-final`: apply Silk Orbit.

Success criteria:

- Page feels richer without becoming visually busy.
- 3C section becomes a memorable signature moment.
- eBook and CTA no longer share identical flat dark background.

## TINA Awakening Page Application

Target file: `static-site/dich-vu-2.html`

Planned application:

1. Hero/open letter/light sections: subtle soft depth only.
2. `Gốc rễ chuyển hoá` / crisis-return section: apply Sacred Paper signature pattern.
3. `Người đồng hành` dark section: apply Emerald Veil.
4. Final CTA: apply Silk Orbit.

Success criteria:

- DV2 dark sections gain hierarchy: conceptual depth section, instructor section, and final CTA feel related but distinct.
- Text contrast remains strong.
- Pattern supports the “tiềm thức / tái cấu trúc / gốc rễ” narrative.

## Accessibility and Performance

- Preserve contrast for all section text, links, and buttons.
- Do not use external images in first pass.
- Use CSS gradients/pseudo-elements only.
- Do not add animation unless a later review specifically asks for it.
- Respect existing responsive behavior; backgrounds must not create awkward hard edges on mobile.

## Verification Plan

After implementation:

1. Run static link checker.
2. Run `git diff --check`.
3. Open local preview for:
   - `index.html`
   - `dich-vu-2.html`
4. Capture/inspect desktop and mobile screenshots.
5. Check that final CTA, signature pattern, and dark sections remain readable.

## Out of Scope

- WordPress theme port.
- New image asset generation.
- Full redesign of cards, typography, layout, or copy.
- Applying the system to all remaining pages before the Home + DV2 test is accepted.
