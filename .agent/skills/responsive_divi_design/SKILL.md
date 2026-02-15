---
name: responsive-divi-design
description: Implement modern responsive layouts in Divi using container queries, fluid typography, CSS Grid, and mobile-first strategies.
---

# Responsive Design for Divi & WordPress

Master modern responsive design techniques to create interfaces that adapt seamlessly across all screen sizes within the Divi Builder ecosystem.

## When to Use This Skill

- Implementing custom CSS layouts in Divi (Child Theme or Theme Options)
- Creating fluid typography for headings and text modules
- Building complex grids using Divi's "Code" module or custom rows
- Designing robust breakpoint strategies for custom components

## Core Capabilities for Divi

### 1. Container Queries in Divi Modules

- Apply container queries to Divi Columns or Rows
- Create component-level responsiveness for Blurbs, Cards, or Custom Post Types
- Fallbacks for older browsers (though support is good now)

### 2. Fluid Typography & Spacing (Global)

- Use CSS clamp() in your Child Theme's `style.css`
- Set root variables for spacing to use in Divi's "Custom CSS" fields
- Override generic Divi font sizes with fluid scales

### 3. Grid & Flexbox Layouts

- Replace standard Divi rows with CSS Grid for complex 2D layouts
- Use Flexbox for aligning items within Blurb content or custom headers

## Quick Reference

### Modern Breakpoints (Divi Compatible)

Adding these to your Child Theme `style.css` allows you to target specific ranges beyond Divi's default Tablet/Phone tabs.

```css
/* Mobile-first breakpoints */
/* Default Divi Mobile is < 479px, Tablet < 980px */

:root {
  --screen-sm: 640px;
  --screen-md: 768px;
  --screen-lg: 1024px;
  --screen-xl: 1280px;
  --screen-2xl: 1536px;
}

/* Custom Media Queries */
@media (min-width: 640px) {
  /* sm: Landscape phones */
}
@media (min-width: 768px) {
  /* md: Tablets (iPad Portrait) */
}
@media (min-width: 1024px) {
  /* lg: Laptops (iPad Landscape) */
}
@media (min-width: 1280px) {
  /* xl: Desktops */
}
```

## Key Patterns for Divi

### Pattern 1: Container Queries for Cards (Blog/WooCommerce)

Instead of relying on screen width, style specific modules based on their container width.

**Step 1:** Add class `gc-container` to a Divi Row or Column.
**Step 2:** Add class `gc-card` to a Blurb or Text module inside it.

```css
/* In Child Theme style.css */

.gc-container {
  container-type: inline-size;
  container-name: card-wrapper;
}

@container card-wrapper (min-width: 400px) {
  .gc-card .et_pb_blurb_content {
    display: flex;
    gap: 1rem;
    align-items: center;
  }
  
  .gc-card .et_pb_main_blurb_image {
    width: 30%;
    margin-bottom: 0;
  }
}
```

### Pattern 2: Fluid Typography (Clamp)

Replace static px values with fluid typography in Divi settings or global CSS.

```css
/* In Child Theme style.css or Divi > Theme Options > Custom CSS */

:root {
  /* Fluid sizing: Min 16px, Max 20px */
  --text-base: clamp(1rem, 0.9rem + 0.5vw, 1.25rem);
  
  /* Fluid Headings */
  --h1-size: clamp(2rem, 1.5rem + 2.5vw, 3.5rem);
  --h2-size: clamp(1.5rem, 1.25rem + 1.5vw, 2.5rem);
}

/* Applying to Divi Elements */
h1, .et_pb_module_header {
  font-size: var(--h1-size) !important;
}

body, p {
  font-size: var(--text-base);
}
```

### Pattern 3: CSS Grid for Custom Layouts

When Divi's standard sections/rows limit you (e.g., uneven items), use CSS Grid.

**Usage:** Add a "Code" module or standard Text module with this HTML structure, or apply classes to existing rows.

```css
/* Custom Class on a Divi Row: .gc-grid-row */

.gc-grid-row {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(min(300px, 100%), 1fr));
  gap: 2rem;
}

/* Optional: Span columns on larger screens */
@media (min-width: 1024px) {
  .gc-grid-item-featured {
    grid-column: span 2;
  }
}
```

### Pattern 4: Responsive Images with `aspect-ratio`

Ensure images in your custom modules don't shift layout.

```css
.gc-responsive-img {
  width: 100%;
  height: auto;
  aspect-ratio: 16 / 9; /* Default landscape */
  object-fit: cover;
}

@media (min-width: 768px) {
  .gc-responsive-img {
    aspect-ratio: 4 / 3; /* More square on tablets if needed */
  }
}
```

## Viewport Units

Correct handling of viewport heights on mobile devices (addressing browser bar issues).

```css
.gc-full-height {
  min-height: 100vh; /* Fallback */
  min-height: 100dvh; /* Dynamic Viewport Height */
}
```

## Implementation Checklist

1.  **Define Variables**: Add root variables for fluid type and spacing in Child Theme `style.css`.
2.  **Container Classes**: Identify rows/columns that need container queries and assign classes.
3.  **Media Queries**: Review standard Divi breakpoints and add custom ones (e.g., `1440px` for large screens) if needed.
4.  **Testing**: Use browser dev tools to resize continuously, checking the "fluid" scaling between breakpoints.
