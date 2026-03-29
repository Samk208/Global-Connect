# Global Connect — Project Handover

**Last Updated:** March 26, 2026 (Session 2)
**Site (Local):** http://localhost:10016/
**Site (Production):** https://globalcnx.net *(slow/timeout — do not deploy yet)*
**Theme:** Divi (parent) + `globalconnect-child` (child theme)
**Repo:** https://github.com/Samk208/Global-Connect (private)

---

## 1. Business Context

**GlobalConnect** is a vehicle, machinery, and parts export business based in Philadelphia, PA, shipping from the USA, Europe, and China to West African markets.

| Field | Value |
|---|---|
| Business | Global Connect Shipping |
| Address | 5909 Elmwood Avenue, Philadelphia, PA 19143 |
| WhatsApp | +1 (267) 290-0254 |
| Email | info@globalconnectshipping.com |
| Founder | MVK / Mr. Konneh |
| Markets | Liberia (Monrovia), Guinea (Conakry), Ivory Coast (Abidjan) |

---

## 2. Technology Stack

| Layer | Technology |
|---|---|
| CMS | WordPress 6.x on Local by Flywheel (port 10016) |
| Theme | Divi (parent) + `globalconnect-child` (custom child) |
| PHP | 8.0+ |
| Database | MySQL via Local |
| SEO | RankMath Pro |
| E-commerce | WooCommerce (minimal — used for inventory/shop) |
| Version Control | GitHub — `Samk208/Global-Connect` |

### Child Theme Key Files

| File/Folder | Description |
|---|---|
| `style.css` | "Deep Tech" design system — CSS variables, all custom CSS (83KB) |
| `functions.php` | Core: enqueue, AJAX, CPTs, AI chatbot, shortcodes, security headers |
| `page-landing.php` | **Homepage template** — all homepage sections live here |
| `page-shop.php` | WooCommerce shop override |
| `page-how-it-works.php` | 3-step process + trust bar |
| `page-contact.php` | Contact & quote form |
| `page-about-us.php` | Full founder/about page (40KB) — **use this one** |
| `page-about.php` | Compact about page — renamed to "About Us (Compact)" to avoid duplicate |
| `page-legal.php` | Legal template — reads WP editor content + auto-generates TOC |
| `page-china-sourcing.php` | China Direct sourcing page |
| `footer-gc-custom.php` | **Custom footer — DO NOT EDIT without care** |
| `header.php` | Custom header — **DO NOT EDIT** |
| `includes/` | CPTs (vehicle, part, shipment), shortcodes, AI chat, RankMath SEO |

### Design System (CSS Variables in `style.css` `:root`)

| Token | Value | Usage |
|---|---|---|
| `--gc-blue-primary` | `#0F172A` | Dark backgrounds |
| `--gc-blue-accent` | `#3B82F6` | Interactive elements |
| `--gc-gold` | `#D97706` | CTA accents, highlights |
| `--gc-off-white` | `#F8FAFC` | Light section backgrounds |
| Font | Outfit (headings) + Inter (body) | Google Fonts |

---

## 3. Credentials

All credentials are in `app/.env.local` (not committed to git):

```
WP_USER=segebeh
WP_APP_PASSWORD=9xNN Bics Sf6a vUVu QtHR M4vJ   # Application password (REST API)
```

**AI APIs:** Gemini, OpenAI, Anthropic, Perplexity, OpenRouter — all in `.env.local`.

---

## 4. What Has Been Built — Complete Status

### ✅ Session 1 (March 25, 2026) — Blog Content

- **24 blog posts** generated (~48,000 words) using `generate_globalconnect_blogs.py`
  - Model: `moonshotai/kimi-k2` with Perplexity live data injection
  - 4 content silos: Shipping & Logistics, Sourcing & Buying, Destination Guides, Business Strategy
- **24 AI-generated featured images** (Gemini Imagen) uploaded and assigned
- **~60 tags** added across 20 posts
- **4 category SEO descriptions** written
- **28 duplicate posts removed**
- **Production credentials** configured

### ✅ Session 2 (March 26, 2026) — Homepage & Code Fixes

#### Homepage (`page-landing.php`) — Now Complete

The homepage is a fully-custom PHP template (NOT Divi Visual Builder). All sections:

| Section | Status | Notes |
|---|---|---|
| Hero (background image, animated headline) | ✅ | "USA \ Europe \ China Meet Global Markets" |
| Live operation ticker (marquee) | ✅ | Dynamic from `globalconnect_get_ticker_items()` |
| Product categories (4 cards) | ✅ | Cars, Machinery, Tires, Auto Parts |
| Global Sourcing Network (USA/Europe/China) | ✅ | 3-column with feature lists |
| China Heavy Machinery showcase (slideshow) | ✅ | Sinotruk, SANY, PCR Tires |
| Featured Inventory (tabbed: USA/Europe/China) | ✅ | Queries `vehicle` CPT |
| Shipping Calculators | ✅ | `[globalconnect_calculator]` shortcode |
| FAQ Accordion | ✅ | 3 questions (China-specific) |
| Photo Trust Gallery | ✅ | Facebook operation photos |
| Trust Stats Bar | ✅ | 500+ containers, 10+ years, 3 continents, 24/7 |
| Founder Section (MVK) | ✅ | Photo + social + CTAs |
| **West Africa Destinations** | ✅ NEW | Liberia, Guinea, Ivory Coast cards with flag stripes |
| **Shipping Process Timeline** | ✅ NEW | 6-step dark grid (Steps 01–06) |
| **Final Gold CTA** | ✅ NEW | "Ready to Ship?" + WhatsApp button |

#### RankMath SEO (Homepage — ID 6)
- Title: "Ship Vehicles from USA to West Africa | Global Connect Shipping"
- Focus keyword: "ship vehicles USA to West Africa"
- Meta description: 155 chars optimised

#### Internal Linking
- `add_internal_links.py` executed — 13 posts cross-linked with 2-3 contextual links each

#### Code Fixes Applied
| File | Fix |
|---|---|
| `footer-gc-custom.php:73` | `date('Y')` → `wp_date('Y')` |
| `footer-gc-custom.php:75-79` | Dead `#` legal links → real URLs (Privacy, T&C, Shipping Policy) |
| `page-about.php` | Template name renamed from "About Us" → "About Us (Compact)" |

---

## 5. WordPress Pages — ID Reference

| ID | Slug | Template | Notes |
|---|---|---|---|
| 6 | `home` | `page-landing.php` | **Static homepage** |
| 15 | `how-it-works` | `page-how-it-works.php` | 3-step visual guide |
| 17 | `about-us` | *(default)* | Older — consider switching to `page-about-us.php` |
| 19 | `contact-quote` | `page-contact.php` | Main quote form |
| 25 | `shop` | `page-shop.php` | Inventory browser |
| 28 | `dashboard` | `page-dashboard.php` | Customer dashboard |
| 341808 | `contact` | `page-contact.php` | Alias |
| 341807 | `about` | `page-about.php` | Uses compact template |
| 341809 | `china-sourcing` | `page-china-sourcing.php` | China Direct page |
| 341810 | `login` | `page-login.php` | Login/Register |
| 341853 | `privacy-policy-2` | `page-legal.php` | Privacy Policy |
| 341913 | `terms-and-conditions` | `page-legal.php` | Terms & Conditions |
| 341975 | `shipping-export-policy` | `page-legal.php` | Shipping & Export Policy |

---

## 6. Blog Post Slugs — All 28 Published

**Shipping & Logistics (10)**
- `roro-vs-container-shipping-africa`
- `roro-vs-container-shipping-africa-full` *(extended version)*
- `ship-car-savannah-monrovia-transit-time`
- `consolidate-cargo-vehicles-parts-container`
- `terminal-handling-charges-usa-ports`
- `demurrage-detention-fees-west-africa`
- `incoterms-cfr-cif-fob-west-africa`
- `roro-shipment-rejected-port-violations`
- `track-ocean-freight-global-connect-tracker`
- `process-itn-auto-export-usa`

**Sourcing & Buying (9)**
- `export-document-checklist-vehicles-africa`
- `buy-cars-copart-export-africa`
- `iaai-auctions-international-importers`
- `clean-vs-salvage-title-conakry-guinea`
- `reliable-used-suvs-west-africa`
- `estimate-preexport-repair-costs-auction-cars`
- `source-heavy-equipment-usa-export`
- `import-cars-usa-africa`
- `europe-car-exporter`

**Destination Guides (6)**
- `clear-customs-conakry-guinea-guide`
- `liberia-import-duties-2026-vehicles`
- `ivory-coast-car-import-age-limits`
- `trusted-clearing-agent-monrovia-liberia`
- `electric-vehicles-west-africa-import-laws`
- `buy-chinese-electric-cars-online`

**Business Strategy (3)**
- `start-car-export-business-usa-africa`
- `finance-car-exports-cash-flow-management`
- `west-africa-dealerships-usa-brokers`

---

## 7. Automation Scripts (`app/` directory)

| Script | Purpose |
|---|---|
| `generate_globalconnect_blogs.py` | Generate blog posts with AI + Perplexity live data |
| `add_internal_links.py` | Add 2-3 contextual internal links per post via REST API |
| `set_homepage_seo.py` | Set RankMath meta on homepage via REST API |
| `wp_publish_posts.py` | Publish posts to production (`--target prod --status draft`) |
| `dataforseo_logistics.py` | Keyword research via DataForSEO API |
| `check_pages.py` | List all WP pages with IDs and content lengths |
| `check_legal.py` | Preview legal page content |

---

## 8. Critical Rules — DO NOT BREAK

1. **Footer (`footer-gc-custom.php`):** Legal links now point to real pages. Do not revert to `#`.
2. **Header (`header.php`):** Custom header. Do not edit structure.
3. **Homepage:** Built in `page-landing.php` — NOT in Divi Visual Builder. Editing with the Divi front-end builder will overwrite it.
4. **`page-about-us.php`:** This is the full, 40KB About Us page. `page-about.php` is the compact legacy version — both can coexist.
5. **Production site (`globalcnx.net`):** Currently slow with timeout issues. **Keep all work on local** (http://localhost:10016) until production is confirmed stable.
6. **Git:** Divi parent theme should be in `.gitignore`. Run `git rm -r --cached app/public/wp-content/themes/Divi/` before next commit.

---

## 9. Next Session — Resumption Guide

Start by reading `TODO.md`. Priority queue at handover:

1. **Priority 4 — Legal Pages:** Add GDPR, AI chatbot disclosure, payment terms, force majeure, governing law clauses
2. **Priority 7 — Git Hygiene:** Add Divi to `.gitignore`, commit all session work, push to GitHub
3. **Priority 5 — Production Deployment:** Once live site is stable, use `wp_publish_posts.py`
4. **Content:** Review internal links manually, add CTAs to posts, check featured images
5. **Future:** Featured blog posts section on homepage (skipped this session per user)
