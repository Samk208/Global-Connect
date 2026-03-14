# GlobalConnect VPS Debugging Notes
## Date: March 9, 2026
## Status: Site NOT live yet — one final fix remaining

---

## Current State
- **Site URL**: https://globalcnx.net
- **VPS**: Contabo, 62.84.185.148 (SSH: `ssh root@62.84.185.148`)
- **Coolify**: v4.0.0-beta.463 (http://62.84.185.148:8000)
- **Traefik**: Upgraded to v3.6 (was v3.1)
- **WordPress container**: `wordpress-mww4ccwwo4sw480cocsoko4o` — Running (unhealthy)
- **MariaDB container**: `mariadb-mww4ccwwo4sw480cocsoko4o` — Running (healthy)
- **Cloudflare**: DNS proxied (orange cloud), SSL set to "Full" (was "Full strict")
- **Child theme + images**: Successfully deployed to container

---

## Root Cause Found
WordPress returns **301 redirect** (http→https) on ALL requests and takes **49 seconds** to respond.
This causes:
1. Health checks fail (expect 200, get 301)
2. Apache workers pile up (health check every 12s, each hangs 49s)
3. Traefik can't route because requests time out

**Why**: WordPress `siteurl`/`home` = `https://globalcnx.net` in the database.
When Traefik sends HTTP requests to WordPress internally, WordPress sees HTTP and redirects to HTTPS.
WordPress doesn't know it's behind a reverse proxy (Cloudflare → Traefik → WordPress).

---

## THE FIX (Run Tomorrow)

### Step 1: Fix WordPress SSL detection
SSH into VPS and run:
```bash
ssh root@62.84.185.148
```

```bash
docker exec wordpress-mww4ccwwo4sw480cocsoko4o sh -c "cat >> /var/www/html/wp-config.php << 'WPEOF'

/* Reverse proxy SSL detection - added for Cloudflare/Traefik */
if (isset(\$_SERVER['HTTP_X_FORWARDED_PROTO']) && \$_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    \$_SERVER['HTTPS'] = 'on';
}
WPEOF"
```

### Step 2: Restart WordPress
```bash
docker restart wordpress-mww4ccwwo4sw480cocsoko4o
```

### Step 3: Verify WordPress responds fast
```bash
sleep 30 && docker exec coolify-proxy wget -qO- --timeout=10 http://10.0.1.7:80 2>&1 | head -5
```
Should return HTML, not 301 redirect. Should be fast (< 2 seconds).

### Step 4: Test the site
```bash
curl -H "Host: globalcnx.net" http://localhost -I
```
Should return 200 or 301→https (from Traefik middleware, not WordPress).

### Step 5: Visit https://globalcnx.net in browser

---

## If WordPress IP Changed After Restart
Check the new IP:
```bash
docker inspect wordpress-mww4ccwwo4sw480cocsoko4o --format '{{range $net,$v := .NetworkSettings.Networks}}{{$net}}:{{$v.IPAddress}} {{end}}'
```
If the coolify network IP changed from 10.0.1.7, update the manual Traefik config:
- Coolify dashboard → Servers → Proxy → Dynamic Configurations
- Edit `wordpress.yaml` → change the IP in `url: "http://NEW_IP:80"`

---

## If wp-config.php Gets Reset (After Coolify Redeploy)
The WordPress Docker image rebuilds wp-config.php on container recreation.
For a permanent fix, add this environment variable in Coolify:
- Go to WordPress service → Settings (or Environment Variables)
- Add: `WORDPRESS_CONFIG_EXTRA` with value:
  ```
  if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') { $_SERVER['HTTPS'] = 'on'; }
  ```

---

## What Was Already Fixed Tonight

### Cloudflare
- [x] SSL mode changed from "Full (strict)" to "Full"
- [x] DNS A record: globalcnx.net → 62.84.185.148 (proxied)
- [x] CNAME: www → globalcnx.net (proxied)

### Coolify/Traefik
- [x] "Connect To Predefined Network" checkbox enabled
- [x] Traefik upgraded from v3.1 to v3.6
- [x] Manual `wordpress.yaml` dynamic config added with:
  - Router for HTTP (with redirect middleware)
  - Router for HTTPS
  - Inline middleware definitions (redirect-to-https, gzip removed)
  - Service pointing to WordPress at 10.0.1.7:80
- [x] WordPress container connected to `coolify` network

### Security
- [x] VPS checked — no unauthorized access
- [x] SSH keys clean (only Coolify key)
- [x] All login IPs verified as user's own
- [x] Failed password attempts are normal bot noise

### Deployment (completed earlier)
- [x] Child theme deployed to container
- [x] 11 images uploaded to wp-content/uploads/2026/03/
- [x] Database URLs correct (https://globalcnx.net)

---

## Errors Encountered & Resolved

| Error | Cause | Fix |
|-------|-------|-----|
| "no available server" | Traefik has no route to WordPress | Added manual wordpress.yaml config |
| "Cannot retrieve ACME challenge" | Cloudflare intercepts Let's Encrypt validation | Changed SSL to "Full" (not strict) |
| middleware "redirect-to-https@file" does not exist | Referenced Docker-provider middleware from file config | Defined middlewares inline in yaml |
| middleware "gzip@file" does not exist | Same as above | Removed gzip, simplified config |
| wget download timed out (proxy→WordPress) | WordPress takes 49s to respond due to 301 redirect loop | **FIX PENDING**: wp-config.php SSL detection |
| WordPress "unhealthy" | Health check gets 301 instead of 200 | **FIX PENDING**: Same wp-config.php fix |
| Traefik v3.1 docker provider not discovering containers | Old Traefik version bug | Upgraded to v3.6 + added manual config |

---

## Architecture Diagram
```
User Browser
    ↓ HTTPS
Cloudflare (SSL termination, CDN, DDoS protection)
    ↓ HTTPS (Full mode)
VPS: 62.84.185.148
    ↓ ports 80/443
Traefik v3.6 (coolify-proxy container)
    ↓ HTTP to 10.0.1.7:80 (coolify Docker network)
WordPress container (Apache + PHP 8.3)
    ↓
MariaDB container
```

---

## Post-Site-Live Tasks
- [ ] Re-run deploy/update-live.sh to restore child theme (if Coolify redeploy reset it)
- [ ] Fix Divi footer placeholder contact info
- [ ] Fix Privacy/Terms placeholder email
- [ ] Create Blog template in Divi Theme Builder
- [ ] Submit sitemap to Google Search Console
- [ ] Test all pages and forms on live site
