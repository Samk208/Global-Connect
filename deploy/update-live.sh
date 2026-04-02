#!/bin/bash
# =============================================================================
# GlobalConnect — Live Site Update Script
# Syncs child theme changes to VPS (CyberPanel + OpenLiteSpeed)
# =============================================================================
#
# USAGE (run ON the VPS as root):
#   ssh root@194.163.187.54
#   cd /tmp/gc-deploy && git pull && bash deploy/update-live.sh
#
# First time:
#   git clone https://github.com/Samk208/Global-Connect.git /tmp/gc-deploy
#   bash /tmp/gc-deploy/deploy/update-live.sh
# =============================================================================

set -euo pipefail

REPO_PATH="/tmp/gc-deploy"
SITE_ROOT="/home/globalcnx.net/public_html"
THEME_DEST="${SITE_ROOT}/wp-content/themes/globalconnect-child"
THEME_SRC="${REPO_PATH}/app/public/wp-content/themes/globalconnect-child"
SITE_OWNER="globa8362:globa8362"

echo ""
echo "============================================"
echo "  GlobalConnect — Live Update"
echo "  $(date '+%Y-%m-%d %H:%M:%S')"
echo "============================================"
echo ""

# --- Ensure repo is up to date ---
if [ -d "$REPO_PATH/.git" ]; then
    echo "[*] Pulling latest changes..."
    cd "$REPO_PATH"
    git fetch origin main
    git reset --hard origin/main
    echo "    Repo updated to latest commit: $(git log --oneline -1)"
else
    echo "[*] Cloning repository..."
    git clone https://github.com/Samk208/Global-Connect.git "$REPO_PATH"
    echo "    Cloned successfully"
fi

echo ""

# --- Step 1: Backup current child theme ---
echo "[1/5] Backing up current child theme..."
BACKUP_TAG=$(date +%Y%m%d_%H%M%S)
if [ -d "${THEME_DEST}" ]; then
    cp -a "${THEME_DEST}" "${THEME_DEST}.bak.${BACKUP_TAG}"
    echo "  Backup: ${THEME_DEST}.bak.${BACKUP_TAG}"
else
    echo "  No existing theme to backup"
fi

# --- Step 2: Deploy child theme ---
echo ""
echo "[2/5] Deploying child theme..."
rm -rf "${THEME_DEST}"
cp -a "${THEME_SRC}" "${THEME_DEST}"
echo "  Child theme copied"

# --- Step 3: Strip dev-only files from deployed theme ---
echo ""
echo "[3/5] Removing dev-only files from production..."

# Dev AI skills
rm -rf "${THEME_DEST}/.qoder"
echo "  Removed: .qoder/ (AI dev skills)"

# Original uncompressed backup images
rm -rf "${THEME_DEST}/assets/images/generated/originals_backup"
echo "  Removed: originals_backup/ (pre-compression backups)"

# Unused footer template (Divi Theme Builder overrides)
rm -f "${THEME_DEST}/footer-gc-custom.php"
echo "  Removed: footer-gc-custom.php (unused)"

# Dev data seeder + its require line in functions.php
if [ -f "${THEME_DEST}/includes/seeder.php" ]; then
    cp "${THEME_DEST}/functions.php" "${THEME_DEST}/functions.php.bak"
    sed -i '/require_once.*seeder\.php/d' "${THEME_DEST}/functions.php"
    sed -i '/Seeder (Runs once to populate content)/d' "${THEME_DEST}/functions.php"
    # Verify PHP syntax before removing seeder
    PHP_BIN=$(command -v php || echo "/usr/local/lsws/lsphp83/bin/php")
    if $PHP_BIN -l "${THEME_DEST}/functions.php" &>/dev/null; then
        rm -f "${THEME_DEST}/includes/seeder.php"
        echo "  Removed: seeder.php + require line (syntax verified)"
    else
        echo "  WARNING: PHP syntax error after patch — rolling back functions.php"
        cp "${THEME_DEST}/functions.php.bak" "${THEME_DEST}/functions.php"
    fi
fi

# --- Step 4: Fix permissions ---
echo ""
echo "[4/5] Fixing permissions..."
chown -R ${SITE_OWNER} "${THEME_DEST}"
find "${THEME_DEST}" -type d -exec chmod 755 {} \;
find "${THEME_DEST}" -type f -exec chmod 644 {} \;
echo "  Permissions set (${SITE_OWNER}, 755/644)"

# --- Step 5: Flush caches ---
echo ""
echo "[5/5] Flushing caches..."

# Purge LiteSpeed cache
if [ -d "${SITE_ROOT}/wp-content/cache/litespeed" ]; then
    rm -rf "${SITE_ROOT}/wp-content/cache/litespeed"/*
    echo "  LiteSpeed page cache purged"
fi

# Restart LiteSpeed to clear opcache
if command -v systemctl &>/dev/null; then
    killall -9 lsphp 2>/dev/null || true
    systemctl restart lsws 2>/dev/null || true
    echo "  LiteSpeed restarted (opcache cleared)"
fi

echo ""
echo "============================================"
echo "  Update complete!"
echo "  Theme version: $(grep 'Version:' ${THEME_SRC}/style.css 2>/dev/null | head -1 | awk '{print $2}')"
echo "  Commit: $(cd $REPO_PATH && git log --oneline -1)"
echo "============================================"
echo ""
echo "  Verify: curl -sI https://globalcnx.net | head -5"
echo ""
echo "  Rollback if needed:"
echo "    rm -rf ${THEME_DEST} && mv ${THEME_DEST}.bak.${BACKUP_TAG} ${THEME_DEST}"
echo "    killall -9 lsphp && systemctl restart lsws"
echo ""
