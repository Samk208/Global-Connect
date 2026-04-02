#!/bin/bash
# =============================================================================
# GlobalConnect — Live Site Cleanup Script
# Removes dev-only files from the production server (CyberPanel + OLS)
# Safe to run multiple times — all operations are idempotent
# =============================================================================
#
# USAGE (run ON the VPS via SSH):
#   ssh root@194.163.187.54
#   bash /path/to/cleanup-live.sh
#
# Or one-liner:
#   curl -sL https://raw.githubusercontent.com/Samk208/Global-Connect/main/deploy/cleanup-live.sh | bash
# =============================================================================

set -euo pipefail

SITE_ROOT="/home/globalcnx.net/public_html"
THEME_DIR="${SITE_ROOT}/wp-content/themes/globalconnect-child"
SITE_OWNER="globa8362:globa8362"

echo ""
echo "============================================"
echo "  GlobalConnect — Live Site Cleanup"
echo "  $(date '+%Y-%m-%d %H:%M:%S')"
echo "============================================"
echo ""

# Track what we cleaned
CLEANED=0
FREED_BYTES=0

cleanup() {
    local path="$1"
    local desc="$2"
    if [ -e "$path" ]; then
        local size
        size=$(du -sh "$path" 2>/dev/null | cut -f1)
        rm -rf "$path"
        echo "  REMOVED: $path ($size) — $desc"
        CLEANED=$((CLEANED + 1))
    fi
}

# =============================================================================
# 1. Child theme — dev-only files
# =============================================================================
echo "[1/4] Cleaning child theme dev files..."

# AI/dev skills directory
cleanup "${THEME_DIR}/.qoder" "AI dev skills (not needed in production)"

# Original uncompressed images (backups of compressed versions)
cleanup "${THEME_DIR}/assets/images/generated/originals_backup" "Pre-compression image backups"

# Unused footer template (Divi Theme Builder overrides it)
cleanup "${THEME_DIR}/footer-gc-custom.php" "Unused footer — Divi Theme Builder active"

# Dev data seeder (loaded via require_once on every request)
if [ -f "${THEME_DIR}/includes/seeder.php" ]; then
    # Backup functions.php before patching
    cp "${THEME_DIR}/functions.php" "${THEME_DIR}/functions.php.bak"
    echo "  BACKUP: functions.php.bak created"

    # Remove the require_once line and its comment
    if grep -q "seeder.php" "${THEME_DIR}/functions.php" 2>/dev/null; then
        sed -i '/require_once.*seeder\.php/d' "${THEME_DIR}/functions.php"
        sed -i '/Seeder (Runs once to populate content)/d' "${THEME_DIR}/functions.php"
        echo "  PATCHED: functions.php — removed seeder.php require line"
    fi

    # Verify functions.php is still valid PHP
    if command -v php &>/dev/null; then
        if php -l "${THEME_DIR}/functions.php" &>/dev/null; then
            echo "  VERIFIED: functions.php passes PHP syntax check"
            cleanup "${THEME_DIR}/includes/seeder.php" "Demo data seeder — dev only"
        else
            echo "  ERROR: functions.php has syntax errors after patch — ROLLING BACK"
            cp "${THEME_DIR}/functions.php.bak" "${THEME_DIR}/functions.php"
            echo "  RESTORED: functions.php from backup"
        fi
    else
        # No PHP CLI available — check with lsphp
        if /usr/local/lsws/lsphp83/bin/php -l "${THEME_DIR}/functions.php" &>/dev/null; then
            echo "  VERIFIED: functions.php passes PHP syntax check (lsphp83)"
            cleanup "${THEME_DIR}/includes/seeder.php" "Demo data seeder — dev only"
        else
            echo "  ERROR: functions.php has syntax errors after patch — ROLLING BACK"
            cp "${THEME_DIR}/functions.php.bak" "${THEME_DIR}/functions.php"
            echo "  RESTORED: functions.php from backup"
        fi
    fi
fi

echo ""

# =============================================================================
# 2. wp-content — archives and dev docs
# =============================================================================
echo "[2/4] Cleaning wp-content bloat..."

# Large ZIP archives (backup files, not served)
cleanup "${SITE_ROOT}/wp-content/uploads.zip" "Uploads backup archive"
cleanup "${SITE_ROOT}/wp-content/docs.zip" "Docs backup archive"

# Dev documentation directory
cleanup "${SITE_ROOT}/wp-content/docs" "Development documentation and inspiration files"

# WordPress upgrade leftovers
cleanup "${SITE_ROOT}/wp-content/upgrade-temp-backup" "WP upgrade temp files"
cleanup "${SITE_ROOT}/wp-content/upgrade" "WP upgrade staging dir"

echo ""

# =============================================================================
# 3. WP root — dev/local artifacts
# =============================================================================
echo "[3/4] Cleaning WP root dev files..."

cleanup "${SITE_ROOT}/assign_vehicle_images.php" "One-time dev script"
cleanup "${SITE_ROOT}/local-xdebuginfo.php" "LocalWP debug file"
cleanup "${SITE_ROOT}/readme.html" "WP readme — security best practice to remove"
cleanup "${SITE_ROOT}/license.txt" "WP license file — not needed on live"
cleanup "${SITE_ROOT}/globalconnect-local.sql" "Local database dump"

echo ""

# =============================================================================
# 4. Fix permissions on anything we touched
# =============================================================================
echo "[4/4] Fixing permissions..."
if [ -d "${THEME_DIR}" ]; then
    chown -R ${SITE_OWNER} "${THEME_DIR}"
    find "${THEME_DIR}" -type d -exec chmod 755 {} \;
    find "${THEME_DIR}" -type f -exec chmod 644 {} \;
    echo "  Permissions fixed on child theme"
fi

echo ""
echo "============================================"
echo "  Cleanup complete!"
echo "  Items removed: ${CLEANED}"
echo "============================================"
echo ""

if [ "$CLEANED" -eq 0 ]; then
    echo "  Nothing to clean — site is already tidy."
else
    echo "  Restart LiteSpeed to clear any cached PHP:"
    echo "    systemctl restart lsws"
    echo ""
    echo "  Then verify the site loads correctly:"
    echo "    curl -sI https://globalcnx.net | head -5"
fi
echo ""
