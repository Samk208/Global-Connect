#!/bin/bash
# =============================================================================
# GlobalConnect — VPS Deployment Script
# Run this ON the VPS (SSH into the server first)
# =============================================================================
#
# PREREQUISITES:
#   1. WordPress + MariaDB already running on Coolify
#   2. Divi theme zip available (upload separately — licensed theme)
#   3. This repo cloned to the VPS
#
# USAGE:
#   1. SSH into VPS: ssh root@YOUR_VPS_IP
#   2. Clone repo:   git clone https://github.com/Samk208/Global-Connect.git /tmp/gc-deploy
#   3. Edit config below, then run: bash /tmp/gc-deploy/deploy/deploy-to-vps.sh
# =============================================================================

set -euo pipefail

# ===================== CONFIGURE THESE =====================
SITE_URL="https://globalconnectshipping.com"   # Your production domain (no trailing slash)
WP_PATH="/var/www/html"                         # WordPress root inside Coolify container
DB_HOST="localhost"                              # MariaDB host (usually localhost in same container)
DB_NAME="wordpress"                              # Database name on Coolify
DB_USER=""                                       # MariaDB user (from .env.local)
DB_PASS=""                                       # MariaDB password (from .env.local)
REPO_PATH="/tmp/gc-deploy"                       # Where you cloned this repo
# ===========================================================

echo "============================================"
echo "  GlobalConnect VPS Deployment"
echo "  Target: ${SITE_URL}"
echo "============================================"

# --- 1. Install child theme ---
echo ""
echo "[1/5] Installing child theme..."
THEME_SRC="${REPO_PATH}/app/public/wp-content/themes/globalconnect-child"
THEME_DEST="${WP_PATH}/wp-content/themes/globalconnect-child"

if [ -d "$THEME_DEST" ]; then
    echo "  Child theme already exists. Backing up..."
    mv "$THEME_DEST" "${THEME_DEST}.bak.$(date +%s)"
fi

cp -r "$THEME_SRC" "$THEME_DEST"
echo "  Child theme installed to ${THEME_DEST}"

# --- 2. Set proper permissions ---
echo ""
echo "[2/5] Setting file permissions..."
chown -R www-data:www-data "$THEME_DEST" 2>/dev/null || echo "  (chown skipped — adjust for your container user)"
find "$THEME_DEST" -type d -exec chmod 755 {} \;
find "$THEME_DEST" -type f -exec chmod 644 {} \;
echo "  Permissions set (755 dirs, 644 files)"

# --- 3. Import database ---
echo ""
echo "[3/5] Importing database..."
SQL_FILE="${REPO_PATH}/deploy/globalconnect-production.sql"

if [ ! -f "$SQL_FILE" ]; then
    echo "  ERROR: SQL file not found at ${SQL_FILE}"
    echo "  Copy it from deploy/globalconnect-production.sql"
    exit 1
fi

# Replace placeholder with actual site URL
echo "  Replacing {{SITE_URL}} with ${SITE_URL}..."
sed -i "s|{{SITE_URL}}|${SITE_URL}|g" "$SQL_FILE"

echo "  Importing into ${DB_NAME}..."
mysql -h "$DB_HOST" -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" < "$SQL_FILE"
echo "  Database imported successfully"

# --- 4. Activate child theme via WP-CLI (if available) ---
echo ""
echo "[4/5] Activating theme and configuring..."
if command -v wp &> /dev/null; then
    cd "$WP_PATH"
    wp theme activate globalconnect-child --allow-root 2>/dev/null || echo "  (theme activation — do manually if this fails)"

    # Set homepage
    wp option update show_on_front page --allow-root 2>/dev/null || true
    wp option update page_on_front "$(wp post list --post_type=page --name=home --field=ID --allow-root 2>/dev/null)" --allow-root 2>/dev/null || true

    # Clear transients
    wp transient delete --all --allow-root 2>/dev/null || true

    # Flush rewrite rules (critical for custom post types)
    wp rewrite flush --allow-root 2>/dev/null || true

    echo "  Theme activated, rewrites flushed"
else
    echo "  WP-CLI not found. Manual steps required:"
    echo "    - Go to WP Admin > Appearance > Themes > Activate globalconnect-child"
    echo "    - Go to Settings > Permalinks > Save (flushes rewrites)"
    echo "    - Go to Settings > Reading > Static page > Home"
fi

# --- 5. Post-deployment checklist ---
echo ""
echo "[5/5] Post-deployment checklist"
echo "============================================"
echo ""
echo "MANUAL STEPS REQUIRED:"
echo ""
echo "1. DIVI THEME:"
echo "   - Upload and activate Divi parent theme via WP Admin > Appearance > Themes"
echo "   - Or install via FTP/SFTP to ${WP_PATH}/wp-content/themes/Divi/"
echo ""
echo "2. PLUGINS (install via WP Admin > Plugins > Add New):"
echo "   - RankMath SEO (free or pro)"
echo "   - WPForms Lite (free) — then create a contact form, note its ID"
echo ""
echo "3. CONFIGURE (WP Admin > Global Connect):"
echo "   - Set OpenAI API key (for chat widget)"
echo "   - Set WhatsApp number (default: 12672900254)"
echo "   - Set WPForms contact form ID"
echo ""
echo "4. MENUS:"
echo "   - If menus didn't import correctly:"
echo "     WP Admin > Appearance > Menus > Create 'Main Menu' and 'Footer Menu'"
echo ""
echo "5. PERMALINKS:"
echo "   - Go to Settings > Permalinks > Save Changes (flushes rewrite rules)"
echo "   - This is CRITICAL for custom post types (vehicles, parts) to work"
echo ""
echo "6. SSL:"
echo "   - Ensure your domain has SSL configured in Coolify"
echo "   - Update Settings > General: WordPress Address + Site Address to https://"
echo ""
echo "7. LOGO:"
echo "   - Upload globalconnect-logo-header-2x.png via Media Library"
echo "   - Set in Divi > Theme Options > Logo"
echo ""
echo "============================================"
echo "  Deployment complete!"
echo "============================================"
