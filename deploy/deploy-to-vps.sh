#!/bin/bash
# =============================================================================
# GlobalConnect — Coolify VPS Deployment Script
# Run this ON the VPS as root (SSH into the server first)
# =============================================================================
#
# Coolify runs WordPress + MariaDB in separate Docker containers.
# This script discovers the right containers and deploys into them.
#
# USAGE:
#   1. SSH into VPS:  ssh root@62.84.185.148
#   2. Clone repo:    git clone https://github.com/Samk208/Global-Connect.git /tmp/gc-deploy
#   3. Run:           bash /tmp/gc-deploy/deploy/deploy-to-vps.sh
#
# The script will auto-detect containers, or you can set them manually below.
# =============================================================================

set -euo pipefail

# ===================== CONFIGURE THESE =====================
SITE_URL=""                  # Leave empty to auto-detect from Coolify, or set manually (e.g. "https://globalconnectshipping.com")
REPO_PATH="/tmp/gc-deploy"   # Where you cloned this repo
# ===========================================================

echo ""
echo "============================================"
echo "  GlobalConnect — Coolify Deployment"
echo "============================================"
echo ""

# --- Step 0: Discover Coolify containers ---
echo "[0/6] Discovering Coolify containers..."
echo ""

# Find WordPress container (looks for containers with wordpress in the image name)
WP_CONTAINER=$(docker ps --format '{{.Names}}\t{{.Image}}' | grep -i 'wordpress' | head -1 | cut -f1)

if [ -z "$WP_CONTAINER" ]; then
    echo "  Could not auto-detect WordPress container."
    echo "  Available containers:"
    docker ps --format '  {{.Names}} ({{.Image}})' | head -20
    echo ""
    read -p "  Enter the WordPress container name: " WP_CONTAINER
fi
echo "  WordPress container: ${WP_CONTAINER}"

# Find MariaDB/MySQL container
DB_CONTAINER=$(docker ps --format '{{.Names}}\t{{.Image}}' | grep -iE 'mariadb|mysql' | head -1 | cut -f1)

if [ -z "$DB_CONTAINER" ]; then
    echo "  Could not auto-detect database container."
    echo "  Available containers:"
    docker ps --format '  {{.Names}} ({{.Image}})' | head -20
    echo ""
    read -p "  Enter the MariaDB/MySQL container name: " DB_CONTAINER
fi
echo "  Database container:  ${DB_CONTAINER}"

# --- Detect WordPress path inside container ---
WP_PATH=$(docker exec "$WP_CONTAINER" sh -c 'if [ -f /var/www/html/wp-config.php ]; then echo /var/www/html; elif [ -f /app/wp-config.php ]; then echo /app; elif [ -f /usr/src/wordpress/wp-config.php ]; then echo /usr/src/wordpress; else find / -name wp-config.php -maxdepth 4 2>/dev/null | head -1 | xargs dirname; fi')

if [ -z "$WP_PATH" ]; then
    echo "  Could not find WordPress installation inside container."
    read -p "  Enter the WordPress path inside the container: " WP_PATH
fi
echo "  WordPress path:     ${WP_PATH}"

# --- Detect DB credentials from wp-config.php inside the container ---
echo ""
echo "  Reading database credentials from wp-config.php..."
DB_NAME=$(docker exec "$WP_CONTAINER" sh -c "grep 'DB_NAME' ${WP_PATH}/wp-config.php" | sed "s/.*'\(.*\)'.*/\1/" | tail -1)
DB_USER=$(docker exec "$WP_CONTAINER" sh -c "grep 'DB_USER' ${WP_PATH}/wp-config.php" | sed "s/.*'\(.*\)'.*/\1/" | tail -1)
DB_PASS=$(docker exec "$WP_CONTAINER" sh -c "grep 'DB_PASSWORD' ${WP_PATH}/wp-config.php" | sed "s/.*'\(.*\)'.*/\1/" | tail -1)
DB_HOST=$(docker exec "$WP_CONTAINER" sh -c "grep 'DB_HOST' ${WP_PATH}/wp-config.php" | sed "s/.*'\(.*\)'.*/\1/" | tail -1)

echo "  DB Name: ${DB_NAME}"
echo "  DB User: ${DB_USER}"
echo "  DB Host: ${DB_HOST}"
echo "  DB Pass: ****"

# --- Detect site URL if not set ---
if [ -z "$SITE_URL" ]; then
    SITE_URL=$(docker exec "$WP_CONTAINER" sh -c "grep 'WP_HOME\|WP_SITEURL' ${WP_PATH}/wp-config.php 2>/dev/null | head -1" | sed "s/.*'\(http[^']*\)'.*/\1/" || echo "")
    if [ -z "$SITE_URL" ]; then
        echo ""
        read -p "  Enter your production site URL (e.g. https://globalconnectshipping.com): " SITE_URL
    fi
fi
echo "  Site URL: ${SITE_URL}"

echo ""
echo "  ----------------------------------------"
echo "  WordPress:  ${WP_CONTAINER} (${WP_PATH})"
echo "  Database:   ${DB_CONTAINER} (${DB_NAME})"
echo "  Site URL:   ${SITE_URL}"
echo "  ----------------------------------------"
echo ""
read -p "  Does this look correct? (y/n): " CONFIRM
if [ "$CONFIRM" != "y" ] && [ "$CONFIRM" != "Y" ]; then
    echo "  Aborted. Edit the script variables and try again."
    exit 1
fi

# --- Step 1: Copy child theme into WordPress container ---
echo ""
echo "[1/6] Installing child theme..."
THEME_SRC="${REPO_PATH}/app/public/wp-content/themes/globalconnect-child"
THEME_DEST="${WP_PATH}/wp-content/themes/globalconnect-child"

# Backup existing child theme if present
docker exec "$WP_CONTAINER" sh -c "[ -d '${THEME_DEST}' ] && mv '${THEME_DEST}' '${THEME_DEST}.bak.\$(date +%s)' || true"

# Copy child theme into container
docker cp "$THEME_SRC" "${WP_CONTAINER}:${WP_PATH}/wp-content/themes/"
echo "  Child theme copied to ${WP_CONTAINER}:${THEME_DEST}"

# --- Step 2: Set permissions ---
echo ""
echo "[2/6] Setting file permissions..."
docker exec "$WP_CONTAINER" sh -c "
    chown -R www-data:www-data '${THEME_DEST}' 2>/dev/null || chown -R 33:33 '${THEME_DEST}' 2>/dev/null || true
    find '${THEME_DEST}' -type d -exec chmod 755 {} \;
    find '${THEME_DEST}' -type f -exec chmod 644 {} \;
"
echo "  Permissions set (755 dirs, 644 files)"

# --- Step 3: Prepare and import database ---
echo ""
echo "[3/6] Importing database..."
SQL_FILE="${REPO_PATH}/deploy/globalconnect-production.sql"

if [ ! -f "$SQL_FILE" ]; then
    echo "  ERROR: SQL file not found at ${SQL_FILE}"
    exit 1
fi

# Create a working copy and replace placeholder with actual URL
cp "$SQL_FILE" /tmp/gc-import.sql
sed -i "s|{{SITE_URL}}|${SITE_URL}|g" /tmp/gc-import.sql
echo "  Replaced {{SITE_URL}} with ${SITE_URL} ($(grep -c "${SITE_URL}" /tmp/gc-import.sql) replacements)"

# Copy SQL into DB container and import
docker cp /tmp/gc-import.sql "${DB_CONTAINER}:/tmp/gc-import.sql"
docker exec "$DB_CONTAINER" sh -c "mysql -u '${DB_USER}' -p'${DB_PASS}' '${DB_NAME}' < /tmp/gc-import.sql"
docker exec "$DB_CONTAINER" rm /tmp/gc-import.sql
rm /tmp/gc-import.sql
echo "  Database imported successfully into ${DB_NAME}"

# --- Step 4: Update wp-config.php if needed ---
echo ""
echo "[4/6] Verifying wp-config.php..."
# Check if WP_HOME/WP_SITEURL are defined, update if they exist
docker exec "$WP_CONTAINER" sh -c "
    if grep -q 'WP_HOME' '${WP_PATH}/wp-config.php'; then
        echo '  WP_HOME found in wp-config.php — verify it matches ${SITE_URL}'
    else
        echo '  WP_HOME not in wp-config.php — site URL will come from database (siteurl option)'
    fi
"

# --- Step 5: Activate theme and flush ---
echo ""
echo "[5/6] Activating child theme..."

# Try WP-CLI first (might be available in container)
if docker exec "$WP_CONTAINER" which wp &>/dev/null; then
    echo "  WP-CLI found! Activating..."
    docker exec "$WP_CONTAINER" wp theme activate globalconnect-child --allow-root --path="${WP_PATH}" 2>/dev/null || true
    docker exec "$WP_CONTAINER" wp rewrite flush --allow-root --path="${WP_PATH}" 2>/dev/null || true
    docker exec "$WP_CONTAINER" wp transient delete --all --allow-root --path="${WP_PATH}" 2>/dev/null || true
    docker exec "$WP_CONTAINER" wp cache flush --allow-root --path="${WP_PATH}" 2>/dev/null || true
    echo "  Theme activated, rewrites flushed, cache cleared"
else
    echo "  WP-CLI not available in container. Activating via database..."
    docker exec "$DB_CONTAINER" sh -c "mysql -u '${DB_USER}' -p'${DB_PASS}' '${DB_NAME}' -e \"
        UPDATE wp_options SET option_value='globalconnect-child' WHERE option_name='stylesheet';
        UPDATE wp_options SET option_value='Divi' WHERE option_name='template';
        UPDATE wp_options SET option_value='page' WHERE option_name='show_on_front';
    \""
    echo "  Theme set via database. Visit Settings > Permalinks > Save to flush rewrites."
fi

# --- Step 6: Post-deployment checklist ---
echo ""
echo "[6/6] Deployment complete!"
echo ""
echo "============================================"
echo "  MANUAL STEPS REQUIRED"
echo "============================================"
echo ""
echo "  1. DIVI PARENT THEME:"
echo "     Upload Divi.zip via WP Admin > Appearance > Themes > Add New"
echo "     (The child theme needs Divi as parent to work)"
echo ""
echo "  2. PLUGINS (WP Admin > Plugins > Add New):"
echo "     - RankMath SEO"
echo "     - WPForms Lite"
echo ""
echo "  3. CONFIGURE (WP Admin > Global Connect):"
echo "     - OpenAI API key (for AI chat widget)"
echo "     - WhatsApp number (default: 12672900254)"
echo "     - WPForms contact form ID"
echo ""
echo "  4. PERMALINKS (CRITICAL):"
echo "     Settings > Permalinks > Save Changes"
echo "     (This flushes rewrite rules for vehicles/parts URLs)"
echo ""
echo "  5. SSL (if not already done in Coolify):"
echo "     Ensure domain has SSL cert in Coolify dashboard"
echo ""
echo "  6. LOGO:"
echo "     Upload logo via Media Library, set in Divi > Theme Options"
echo ""
echo "============================================"
echo "  Site should be live at: ${SITE_URL}"
echo "============================================"
