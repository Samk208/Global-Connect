#!/bin/bash
# =============================================================================
# GlobalConnect — Live Site Update Script
# Syncs child theme changes + new images to VPS (Coolify/Docker)
# =============================================================================
#
# USAGE (run ON the VPS as root):
#   1. SSH into VPS:  ssh root@YOUR_VPS_IP
#   2. Run this:
#      curl -sL https://raw.githubusercontent.com/Samk208/Global-Connect/main/deploy/update-live.sh | bash
#   OR:
#      cd /tmp/gc-deploy && git pull && bash deploy/update-live.sh
#
# For first time:
#      git clone https://github.com/Samk208/Global-Connect.git /tmp/gc-deploy
#      bash /tmp/gc-deploy/deploy/update-live.sh
# =============================================================================

set -euo pipefail

REPO_PATH="/tmp/gc-deploy"

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

# --- Discover WordPress container ---
echo "[1/5] Discovering containers..."
WP_CONTAINER=$(docker ps --format '{{.Names}}\t{{.Image}}' | grep -i 'wordpress' | head -1 | cut -f1)

if [ -z "$WP_CONTAINER" ]; then
    echo "  Could not auto-detect WordPress container."
    echo "  Available containers:"
    docker ps --format '  {{.Names}} ({{.Image}})' | head -20
    echo ""
    read -p "  Enter the WordPress container name: " WP_CONTAINER
fi

# Detect WordPress path
WP_PATH=$(docker exec "$WP_CONTAINER" sh -c 'if [ -f /var/www/html/wp-config.php ]; then echo /var/www/html; elif [ -f /app/wp-config.php ]; then echo /app; else find / -name wp-config.php -maxdepth 4 2>/dev/null | head -1 | xargs dirname; fi')

echo "  Container: ${WP_CONTAINER}"
echo "  WP Path:   ${WP_PATH}"

# --- Step 2: Backup current child theme ---
echo ""
echo "[2/5] Backing up current child theme..."
BACKUP_TAG=$(date +%Y%m%d_%H%M%S)
THEME_DEST="${WP_PATH}/wp-content/themes/globalconnect-child"
docker exec "$WP_CONTAINER" sh -c "
    if [ -d '${THEME_DEST}' ]; then
        cp -a '${THEME_DEST}' '${THEME_DEST}.bak.${BACKUP_TAG}'
        echo '  Backup: ${THEME_DEST}.bak.${BACKUP_TAG}'
    else
        echo '  No existing theme to backup'
    fi
"

# --- Step 3: Deploy child theme ---
echo ""
echo "[3/5] Deploying child theme..."
THEME_SRC="${REPO_PATH}/app/public/wp-content/themes/globalconnect-child"

# Remove old and copy new
docker exec "$WP_CONTAINER" sh -c "rm -rf '${THEME_DEST}'"
docker cp "$THEME_SRC" "${WP_CONTAINER}:${WP_PATH}/wp-content/themes/"

# Fix permissions
docker exec "$WP_CONTAINER" sh -c "
    chown -R www-data:www-data '${THEME_DEST}' 2>/dev/null || chown -R 33:33 '${THEME_DEST}' 2>/dev/null || true
    find '${THEME_DEST}' -type d -exec chmod 755 {} \;
    find '${THEME_DEST}' -type f -exec chmod 644 {} \;
"
echo "  Child theme deployed and permissions set"

# --- Step 4: Upload images ---
echo ""
echo "[4/5] Uploading generated images..."
IMAGES_SRC="${REPO_PATH}/deploy/images"
UPLOADS_DEST="${WP_PATH}/wp-content/uploads/2026/03"

if [ -d "$IMAGES_SRC" ] && [ "$(ls -A $IMAGES_SRC 2>/dev/null)" ]; then
    # Ensure uploads directory exists
    docker exec "$WP_CONTAINER" sh -c "mkdir -p '${UPLOADS_DEST}'"

    # Copy each image
    for img in "$IMAGES_SRC"/*.jpg; do
        [ -f "$img" ] || continue
        docker cp "$img" "${WP_CONTAINER}:${UPLOADS_DEST}/$(basename $img)"
        echo "  Uploaded: $(basename $img)"
    done

    # Fix permissions on uploads
    docker exec "$WP_CONTAINER" sh -c "
        chown -R www-data:www-data '${UPLOADS_DEST}' 2>/dev/null || chown -R 33:33 '${UPLOADS_DEST}' 2>/dev/null || true
        chmod 644 '${UPLOADS_DEST}'/*.jpg 2>/dev/null || true
    "
    echo "  All images uploaded with correct permissions"
else
    echo "  No images found in ${IMAGES_SRC} — skipping"
    echo "  (To include images, copy them to deploy/images/ before running)"
fi

# --- Step 5: Flush caches ---
echo ""
echo "[5/5] Flushing caches..."
if docker exec "$WP_CONTAINER" which wp &>/dev/null; then
    docker exec "$WP_CONTAINER" wp transient delete --all --allow-root --path="${WP_PATH}" 2>/dev/null || true
    docker exec "$WP_CONTAINER" wp cache flush --allow-root --path="${WP_PATH}" 2>/dev/null || true
    docker exec "$WP_CONTAINER" wp rewrite flush --allow-root --path="${WP_PATH}" 2>/dev/null || true
    echo "  WP-CLI: transients, cache, and rewrites flushed"
else
    echo "  WP-CLI not available — clear caches from WP Admin"
fi

echo ""
echo "============================================"
echo "  Update complete!"
echo "  Theme version: $(grep 'Version:' ${THEME_SRC}/style.css | head -1 | awk '{print $2}')"
echo "  Commit: $(cd $REPO_PATH && git log --oneline -1)"
echo "============================================"
echo ""
echo "  Next: Visit your site and verify the changes."
echo "  If something is wrong, restore the backup:"
echo "    docker exec $WP_CONTAINER sh -c \"rm -rf ${THEME_DEST} && mv ${THEME_DEST}.bak.${BACKUP_TAG} ${THEME_DEST}\""
echo ""
