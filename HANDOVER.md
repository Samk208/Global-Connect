# Global Connect — Handover & Task List

**Date:** February 15, 2026
**Site:** http://localhost:10016/
**Theme:** Divi (parent) + `globalconnect-child` (child theme)
**Repo:** https://github.com/Samk208/Global-Connect (private)

---

## Current State Summary

- **Header**: Default Divi header is active (custom `header.php` exists but is overridden by Divi Theme Builder)
- **Footer**: Imported a global footer from Divi Marketplace — it's live on the site but has placeholder content
- **Legal Pages**: 3 pages created (Privacy Policy, Terms & Conditions, Shipping & Export Policy) — not linked anywhere yet
- **Menu**: Home, Shop, Contact & Quote, About Us, How It Works, News
- **GitHub Actions**: Workflow exists but has missing config files
- **Commits**: Only 2 commits so far

---

## PRIORITY 1 — Imported Divi Footer Customization

The imported Divi Marketplace footer is active. The following modules need editing in **Divi Theme Builder > Global Footer** (or via the Visual Builder on any page, scroll to footer, click "Edit With Divi").

### 1.1 Social Follow Bar (Top colored bar)
- [ ] Verify Facebook link points to: `https://www.facebook.com/profile.php?id=100071518400878`
- [ ] Update Twitter/X link to your actual profile (or remove if you don't have one)
- [ ] Update YouTube link to your actual channel (or remove)
- [ ] Update Instagram link to your actual profile (or remove)
- [ ] Update LinkedIn link to your actual profile (or remove)
- [ ] Update Pinterest link to your actual profile (or remove)

### 1.2 "ABOUT US" Section (Left column — currently placeholder)
Replace the placeholder text:
> "Your content goes here. Edit this text inline or in the module Content settings..."

**Replace with:**
> Global Connect Shipping specializes in exporting quality vehicles, heavy trucks, tires, and machinery parts from the USA and Europe to Africa, Asia, and the Americas. Based in Philadelphia, PA, we are your trusted global wholesale partner.

### 1.3 "CONTACT US" Section (Middle column)
- [ ] Update "DIRECTIONS" button to link to Google Maps: `https://maps.google.com/?q=5909+Elmwood+Avenue+Philadelphia+PA+19143`
- [ ] Optionally add contact info text above the button:
  - Phone: +1 (267) 290-0254
  - Email: info@globalconnectshipping.com

### 1.4 "LINKS" Section (Right column — currently showing Archives/Categories)
The current "Links" section shows default WordPress widgets (Archives: January 2026, Categories: Uncategorized). This is not useful.

**Replace with a manual link list:**
- [ ] Home → `/`
- [ ] Shop → `/shop`
- [ ] About Us → `/about-us`
- [ ] Contact & Quote → `/contact`
- [ ] How It Works → `/how-it-works`
- [ ] Track Shipment → `/track`

*In Divi: Delete the Archives/Categories widgets and replace with a Text module containing manual links, or use a Divi Menu module pointing to your footer-menu.*

### 1.5 Contact Details Bar (Bottom dark bar — USA & UK)
Currently shows placeholder info for both USA and UK:
- `hello@example.com`
- `+000-000-0000`

**USA Contact Details — Update to:**
- Email: `info@globalconnectshipping.com`
- Phone: `+1 (267) 290-0254`

**UK Contact Details:**
- [ ] If you have a UK contact, add real details
- [ ] If no UK presence, change to **"West Africa Contact Details"** or **"WhatsApp"** and update accordingly
- [ ] Or remove the UK column entirely and make USA full-width

### 1.6 Add Legal Links to Footer
In the very bottom of the footer (copyright area), add links to your legal pages:
- [ ] Privacy Policy → `/privacy-policy` (verify the actual slug in Pages)
- [ ] Terms & Conditions → `/terms-and-conditions` (verify slug)
- [ ] Shipping & Export Policy → `/shipping-export-policy` (verify slug)

---

## PRIORITY 2 — Legal Pages Enhancement

### 2.1 Find Your Legal Page Slugs
Go to **WP Admin > Pages** and note the exact slugs for:
- Privacy Policy
- Terms and Conditions
- Shipping & Export Policy

### 2.2 Privacy Policy — Content Should Cover:
- [ ] Company name and contact info (data controller)
- [ ] What data you collect: name, email, phone, WhatsApp, destination port (from inquiry forms)
- [ ] User registration data (username, email, password)
- [ ] Shipment tracking data
- [ ] AI Chatbot: conversations are processed via OpenAI API — mention this
- [ ] Google Maps embed on contact page
- [ ] Cookies: WordPress login cookies, any analytics
- [ ] Third-party services: OpenAI, Google Fonts, WhatsApp API
- [ ] Data retention period
- [ ] User rights (access, deletion, correction)
- [ ] How to contact you about data concerns
- [ ] If serving EU customers: GDPR compliance statement

### 2.3 Terms and Conditions — Content Should Cover:
- [ ] Company identity and registration
- [ ] Vehicle/parts sold "as-is" or "as-described" disclaimer
- [ ] Quote validity period (e.g., "Quotes are valid for 7 days")
- [ ] Payment terms and accepted methods
- [ ] Shipping liability limitations
- [ ] Export compliance — buyer responsible for import duties/taxes
- [ ] Title transfer — when ownership passes to buyer
- [ ] Inspection period / dispute window
- [ ] Cancellation and refund policy
- [ ] Force majeure clause (shipping delays, port closures)
- [ ] Governing law and jurisdiction (Pennsylvania, USA)
- [ ] Limitation of liability
- [ ] User account responsibilities

### 2.4 Shipping & Export Policy — Content Should Cover:
- [ ] Shipping methods: RoRo (Roll-on/Roll-off) vs Container shipping
- [ ] Estimated transit times by destination (West Africa, Europe, Asia)
- [ ] Ports of loading (US East Coast ports)
- [ ] Destination ports served (Conakry, Monrovia, Abidjan, Lagos, etc.)
- [ ] Documentation required: clean title, bill of lading, commercial invoice
- [ ] Customs clearance: buyer's responsibility at destination
- [ ] Insurance options and coverage
- [ ] Prohibited/restricted items
- [ ] Container loading and consolidation details
- [ ] Tracking: how to track shipments on the site
- [ ] Delays and force majeure
- [ ] Damaged goods claim process

### 2.5 Page Design Recommendations
For each legal page, use a clean layout:
- [ ] Use Divi's "Blank Page" layout or minimal template
- [ ] Add a simple header with page title
- [ ] Use an accordion or tabbed layout for long content (makes it scannable)
- [ ] Add a "Last Updated: [date]" line at the top
- [ ] Add a "Questions? Contact us at info@globalconnectshipping.com" CTA at the bottom

---

## PRIORITY 3 — Link Legal Pages Everywhere

### 3.1 Divi Imported Footer
- [ ] Add links to all 3 legal pages in the footer copyright area (see 1.6 above)

### 3.2 Custom Footer (`footer-gc-custom.php`) — For when/if activated
The file at `globalconnect-child/footer-gc-custom.php` lines 74-77 has placeholder links:
```php
<a href="#">Privacy Policy</a>
<a href="#">Terms of Service</a>
```
**Update to actual page URLs** (once you know the slugs).

### 3.3 Login/Registration Page
The file at `globalconnect-child/page-login.php` line 168 has:
```html
<span>I agree to the Terms of Service and Privacy Policy</span>
```
**Change to clickable links:**
```html
<span>I agree to the <a href="/terms-and-conditions" target="_blank">Terms of Service</a> and <a href="/privacy-policy" target="_blank">Privacy Policy</a></span>
```

---

## PRIORITY 4 — Code Fixes

### 4.1 Duplicate Include (functions.php)
`class-gc-ai-chat.php` is included twice:
- Line 14: `require_once get_stylesheet_directory() . '/includes/class-gc-ai-chat.php';`
- Line 545: `require_once get_stylesheet_directory() . '/includes/class-gc-ai-chat.php';`

**Fix:** Remove line 14 (keep line 545 which is in the proper "Include AI Chatbot" section).

### 4.2 Use WordPress Date Function (functions.php)
Line 72 in `footer-gc-custom.php`:
```php
<?php echo date('Y'); ?>
```
**Change to:**
```php
<?php echo wp_date('Y'); ?>
```

### 4.3 Duplicate About Page Templates
Both `page-about.php` and `page-about-us.php` exist. Determine which one is in use and delete the other.

---

## PRIORITY 5 — GitHub Actions Fixes

### 5.1 Create Missing Lint Config Files
Create these files in the project root:

**`.stylelintrc.json`:**
```json
{
  "extends": "stylelint-config-standard",
  "rules": {
    "no-descending-specificity": null,
    "selector-class-pattern": null,
    "custom-property-pattern": null,
    "declaration-block-no-redundant-longhand-properties": null
  }
}
```

**`.eslintrc.json`:**
```json
{
  "env": {
    "browser": true,
    "jquery": true,
    "es6": true
  },
  "rules": {
    "no-unused-vars": "warn",
    "no-console": "warn"
  }
}
```

### 5.2 Refine Security Check
The `grep -r "debug"` check in `main.yml` will false-positive on CSS class names and comments. Consider changing to check for `WP_DEBUG` or `console.log` specifically.

### 5.3 Git Hygiene
The Divi parent theme has 100+ modified files showing in `git status`. Add to `.gitignore`:
```
app/public/wp-content/themes/Divi/
```
Then remove it from tracking:
```bash
git rm -r --cached app/public/wp-content/themes/Divi/
```

---

## PRIORITY 6 — Header (Future Task)

Your custom `header.php` and its CSS (style.css lines 3449-3599) are ready but not active because Divi Theme Builder overrides it. Options:

- **Option A:** Go to Divi > Theme Builder, remove the global header assignment, and let `header.php` take over
- **Option B:** Rebuild the header design in Divi Theme Builder to match what `header.php` does (logo, nav, Get a Quote CTA, Login/Dashboard conditional, mobile menu)
- **Option C:** Keep the Divi default header and customize it in Theme Builder

---

## Quick Reference — Real Business Info

| Field | Value |
|-------|-------|
| Company | Global Connect Shipping |
| Address | 5909 Elmwood Avenue, Philadelphia, PA 19143 |
| Phone/WhatsApp | +1 (267) 290-0254 |
| Email | info@globalconnectshipping.com |
| Facebook | https://www.facebook.com/profile.php?id=100071518400878 |
| Services | Vehicle export, heavy trucks, tires, machinery parts |
| Markets | USA, Europe, China → Africa, Asia, Americas |
| Shipping | RoRo and Container shipping |

---

*This handover was generated from a full code review on Feb 15, 2026. Resume with Cursor AI anytime to execute any of these tasks.*
