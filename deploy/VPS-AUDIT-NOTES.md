# VPS Audit Notes — March 12, 2026

## VPS Specs (Contabo)
- **Host**: vmi2903133 (root@62.84.185.148)
- **OS**: Ubuntu 24.04.3 LTS (GNU/Linux 6.8.0-101-generic x86_64)
- **CPUs**: 6
- **RAM**: 11GB total, 8.1GB used, 3.6GB available
- **Swap**: 0B (NO SWAP configured!)
- **Disk**: 193GB total, 21GB used (11%), 172GB free
- **Uptime**: 3 days, 4:36
- **Load average**: 4.51, 5.78, 18.33 (high! 15-min was 18.33 during health check loop)

## Issue Found & Fixed
- WordPress health check was hitting `http://127.0.0.1/` every 2 seconds
- Got 301 redirect each time (HTTPS forced), never returned 200
- Caused process buildup (157 processes in WP container), DB overload, 524 timeouts
- **Fix**: Changed compose healthcheck to `/wp-includes/images/blank.gif`, interval 30s

## WordPress Service (GlobalConnect)
- **Container**: wordpress-mww4ccwwo4sw480cocsoko4o
- **Status**: Running (healthy) after fix
- **Image**: wordpress:latest (WP 6.9.4)
- **PHP memory**: 128M (TOO LOW for Divi — needs 512M)
- **WP-Cron**: Still enabled (should disable, was hammering server)
- **Site URL**: https://globalcnx.net (confirmed correct in DB)
- **Home URL**: https://globalcnx.net (confirmed correct in DB)
- **wp-config HTTPS detection**: Uses HTTP_X_FORWARDED_PROTO (correct for reverse proxy)
- **.htaccess**: Standard WordPress rewrites only (clean)
- **WP-CLI**: NOT installed in container (should install)
- **mysql client**: NOT installed in container

## MariaDB Service
- **Container**: mariadb-mww4ccwwo4sw480cocsoko4o
- **Status**: Running (healthy)
- **Image**: mariadb:11 (11.8.6)
- **CPU**: 63.8% (HIGH — likely from health check storm, check again tomorrow)
- **DB User**: r3Ky7kgDUwbawp2P
- **DB Name**: wordpress
- **InnoDB buffer pool**: 128MB

## WordPress Stack 2 — "plugins" project (East Local / test.eastasiaexplorer.com)
- **Coolify project**: "plugins" (description: "developing plugin")
- **Container**: wordpress-mccwg8kco4woggg8gksg8cos
- **MariaDB**: mariadb-mccwg8kco4woggg8gksg8cos
- **MariaDB User**: EvGpBEqXYt5LpHK3
- **Domain**: https://test.eastasiaexplorer.com
- **Status**: STOPPED by user (March 13, 2026)
- **CPU**: 4.69% (WordPress) + unknown (MariaDB)
- **Memory**: 130.5MB (WordPress) + 157.1MB (MariaDB)
- **DECISION**: Not needed. Stopped. Can be deleted.

## All Running Containers (50+ total)

### Coolify Platform (6 containers)
| Container | CPU% | MEM | Notes |
|-----------|------|-----|-------|
| coolify | 0.48% | 339MB | Main platform |
| coolify-proxy | 1.17% | 63MB | Traefik reverse proxy |
| coolify-sentinel | 0.03% | 20MB | Monitoring |
| coolify-realtime | 1.11% | 73MB | WebSocket |
| coolify-redis | 0.91% | 24MB | Cache |
| coolify-db | 0.00% | 51MB | PostgreSQL |
| **Subtotal** | ~3.7% | ~570MB | |

### WordPress Stack 1 — GlobalConnect (2 containers)
| Container | CPU% | MEM | Notes |
|-----------|------|-----|-------|
| wordpress-mww4ccwwo4sw480cocsoko4o | 37.54% | 203MB | Main site |
| mariadb-mww4ccwwo4sw480cocsoko4o | 63.80% | 156MB | DB (CPU was high from storm) |
| **Subtotal** | ~101% | ~359MB | |

### WordPress Stack 2 — UNKNOWN (2 containers)
| Container | CPU% | MEM | Notes |
|-----------|------|-----|-------|
| wordpress-mccwg8kco4woggg8gksg8cos | 4.69% | 131MB | What project is this? |
| mariadb-mccwg8kco4woggg8gksg8cos | 0.02% | 157MB | |
| **Subtotal** | ~4.7% | ~288MB | AUDIT: needed? |

### Supabase Instance 1 (suffix: t4kc0so4ss444o8cco0ks04w) — GREEN DOT in Coolify — 13 containers
- **Coolify name**: supabase-t4kc0so4ss444o8cco0ks04w
- **Status in Coolify**: Running (healthy) — GREEN indicator
- **Dashboard User**: Yeq5v5dfFTWLgGPG
- **PostgreSQL DB**: postgres
- **MinIO Admin User**: EIUQkrbhg5qhwIGN
- **LINKED PROJECT**: **WonLink AI Automation Agency** (C:\Users\Lenovo\Desktop\web-app)
- **Description**: Multi-Agent AI Platform for Korean Business Automation — 10 AI agents across 4 sectors
- **Supabase URL**: http://supabasekong-t4kc0so4ss444o8cco0ks04w.62.84.185.148.sslip.io
- **Also had cloud Supabase**: https://ubtpfecsjecqtrtnyept.supabase.co (commented out in .env.local)
- **30 tables**: agent_definitions, organizations, orders, workflows, trade_audits, grant_applications, startup_programs, sourcing_tasks, etc.
- **NOTE**: Also running locally in Docker Desktop as "web-app" (234% CPU, 1.08GB RAM — unhealthy!)
| Container | CPU% | MEM | Notes |
|-----------|------|-----|-------|
| supabase-storage | 3.25% | 61MB | |
| supabase-edge-functions | 0.00% | 21MB | |
| supabase-meta | 1.32% | 75MB | |
| supabase-rest | 0.17% | 23MB | |
| supabase-auth | 0.00% | 9MB | |
| supabase-kong | 0.08% | 495MB | API gateway — HIGH MEM |
| supabase-supavisor | 3.95% | 178MB | |
| supabase-studio | 0.00% | 214MB | |
| supabase-analytics | 9.51% | 248MB | HIGH CPU |
| supabase-db | 0.79% | 279MB | |
| imgproxy | 13.29% | 32MB | HIGH CPU |
| supabase-minio | 6.29% | 108MB | |
| supabase-vector | 0.26% | 36MB | |
| realtime-dev | 0.87% | 173MB | |
| **Subtotal** | ~39.8% | ~1,952MB (~2GB) | AUDIT: what project? |

### Supabase Instance 2 (suffix: i4wg0o88k884s8o0ogoks84w) — YELLOW DOT in Coolify — 13 containers
- **Coolify name**: supabase-i4wg0o88k884s8o0ogoks84w
- **Status in Coolify**: Yellow indicator (degraded/idle?)
- **LINKED PROJECT**: **EMPTY — NO TABLES. Safe to stop/delete.**
| Container | CPU% | MEM | Notes |
|-----------|------|-----|-------|
| supabase-storage | 4.54% | 61MB | |
| supabase-auth | 0.00% | 11MB | |
| supabase-rest | 0.19% | 17MB | |
| supabase-supavisor | 0.90% | 184MB | |
| supabase-kong | 0.05% | 789MB | API gateway — VERY HIGH MEM |
| supabase-studio | 0.00% | 197MB | |
| realtime-dev | 0.57% | 198MB | |
| supabase-meta | 29.38% | 86MB | VERY HIGH CPU |
| supabase-edge-functions | 0.00% | 19MB | |
| supabase-db | 0.27% | 131MB | |
| imgproxy | 10.96% | 15MB | HIGH CPU |
| supabase-vector | 0.19% | 88MB | |
| supabase-minio | 0.05% | 90MB | |
| **Subtotal** | ~47.1% | ~1,886MB (~1.9GB) | AUDIT: what project? |

### Supabase Instance 3 (suffix: lgcc4kc44cs40gskws08wgo4) — YELLOW DOT in Coolify — 13 containers
- **Coolify name**: supabase-lgcc4kc44cs40gskws08wgo4
- **Status in Coolify**: Yellow indicator (degraded/idle?)
- **LINKED PROJECT**: **KmedTour** (C:\Users\Lenovo\Desktop\Workspce\KmedTour Now)
- **Description**: Medical tourism platform — clinics, patients, treatments, bookings for Africa
- **Supabase URL**: https://supabase.kmedtour.com (resolves to 62.84.185.148)
- **Live on Netlify**: Yes (user confirmed)
- **21 tables**: clinics, treatments, patient_intakes, bookings, africa_regions, articles, testimonials, etc.
- **DECISION**: KEEP — this is a live production project
| Container | CPU% | MEM | Notes |
|-----------|------|-----|-------|
| supabase-storage | 3.29% | 58MB | |
| supabase-kong | 0.06% | 775MB | API gateway — VERY HIGH MEM |
| supabase-supavisor | 1.14% | 202MB | |
| supabase-edge-functions | 0.00% | 19MB | |
| supabase-meta | 32.18% | 84MB | VERY HIGH CPU |
| supabase-auth | 2.59% | 9MB | |
| realtime-dev | 0.38% | 179MB | |
| supabase-rest | 0.13% | 19MB | |
| supabase-studio | 31.37% | 126MB | VERY HIGH CPU |
| supabase-db | 0.18% | 118MB | |
| supabase-vector | 0.17% | 88MB | |
| imgproxy | 0.83% | 44MB | |
| supabase-minio | 7.66% | 86MB | |
| **Subtotal** | ~79.98% | ~1,807MB (~1.8GB) | AUDIT: what project? |

### n8n + PostgreSQL — "Sam sites" project (2 containers)
| Container | CPU% | MEM | Notes |
|-----------|------|-----|-------|
| n8n-a8swssk4w800wskgo484g4w8 | 0.26% | 286MB | Workflow automation |
| postgresql-a8swssk4w800wskgo484g4w8 | 3.34% | 40MB | n8n database |
| **Subtotal** | ~3.6% | ~326MB | NEEDED — keep |

- **Coolify project**: "Sam sites" (n8n)
- **PostgreSQL User**: 4jeZxUjf4iMNjRPp
- **PostgreSQL DB Name**: n8n
- **DECISION**: Needed. Keep running.

## Resource Summary (BEFORE cleanup — March 12)

| Stack | CPU% | RAM | Containers |
|-------|------|-----|------------|
| Coolify platform | ~4% | ~570MB | 6 |
| WordPress (GlobalConnect) | ~101% | ~359MB | 2 |
| WordPress (plugins — DELETED) | ~5% | ~288MB | 2 |
| Supabase Instance 1 (WonLink) | ~40% | ~2.0GB | 13 |
| Supabase Instance 2 (EMPTY — STOPPED) | ~47% | ~1.9GB | 13 |
| Supabase Instance 3 (KmedTour) | ~80% | ~1.8GB | 13 |
| n8n + PostgreSQL | ~4% | ~326MB | 2 |
| **TOTAL** | ~281% | ~7.3GB | **51 containers** |

## Resource Summary (AFTER cleanup — March 13)

| Stack | CPU% | RAM | Containers |
|-------|------|-----|------------|
| Coolify platform | ~3% | ~566MB | 6 |
| WordPress (GlobalConnect) | ~0.03% | ~435MB | 2 |
| Supabase Instance 1 (WonLink) | ~11% | ~1.95GB | 13 |
| n8n + PostgreSQL | ~3.6% | ~330MB | 2 |
| **TOTAL** | **~17%** | **~3.3GB** | **23 containers** |
| **RAM Available** | | **7.6GB** | |
| **Disk** | | 18GB/193GB (10%) | |

## Critical Issues to Address

### 1. NO SWAP (Priority: HIGH)
- 0B swap on a server with 50+ containers
- If RAM spikes, OOM killer will terminate containers
- **Fix**: Add 4GB swap file

### 2. Three Supabase Instances (Priority: HIGH)
- Using ~5.7GB RAM and ~167% CPU combined
- Each has 13 containers (39 total for Supabase alone)
- **Audit**: Which projects use which instance? Can any be stopped?

### 3. WordPress Performance (Priority: MEDIUM)
- PHP memory limit: 128M (needs 512M for Divi)
- WP-Cron: enabled (should disable and use system cron)
- WP-CLI: not installed
- **Fix**: Increase memory, disable WP-Cron, install WP-CLI

### 4. Second WordPress Stack (Priority: MEDIUM)
- wordpress-mccwg8kco4woggg8gksg8cos — what is this?
- Using ~288MB RAM for unknown purpose
- **Audit**: Determine if needed, stop if not

### 5. MariaDB High CPU (Priority: LOW — recheck)
- Was 63.8% during/after health check storm
- Recheck tomorrow after system has stabilized
- May need InnoDB buffer pool tuning

## Remaining WordPress Issues (from previous sessions)
- Broken images on live site (vehicles, operations gallery)
- Header logo showing Divi "D" instead of GlobalConnect logo
- PHP memory too low (128M)
- WP-Cron needs disabling
- Need to install WP-CLI in container

## Coolify Dashboard — Projects Overview (as of March 13, 2026)

| Project | Description | Services | Status |
|---------|-------------|----------|--------|
| **GlobalConnect** | Global Connect | WordPress + MariaDB | Running (healthy) |
| **plugins** | developing plugin | WordPress (East Local / test.eastasiaexplorer.com) + MariaDB | **STOPPED** |
| **Sam sites** | n8n | n8n + PostgreSQL | Running |
| **Supabase** | Backend Supabase | 3 Supabase instances (39 containers total) | Mixed (1 green, 2 yellow) |

### Decisions Made (March 13, 2026)
- **GlobalConnect**: KEEP — primary WordPress site, health check fixed
- **plugins (East Local)**: STOPPED — not needed, candidate for deletion
- **Sam sites (n8n)**: KEEP — needed for workflow automation
- **Supabase**: AUDIT — user says only 1 real project; need to identify which instance, stop the other 2

## Completed Actions (March 13, 2026)

### Phase 1: Identify & Clean Up — DONE
1. ✅ Second WordPress (plugins/East Local) — STOPPED & deleted from Coolify
2. ✅ Supabase instances identified:
   - Instance #1 (t4kc...04w, GREEN): WonLink AI — 30 tables — KEEP (backend for local web-app)
   - Instance #2 (i4wg...84w, YELLOW): EMPTY — 0 tables — STOPPED/EXITED in Coolify
   - Instance #3 (lgcc...go4, YELLOW): Was KmedTour — removed from Coolify (now only 2 in Resources view)
3. ✅ Supabase Instance #2 stopped (saved ~2GB RAM)
4. ✅ Plugins WordPress stack deleted
5. ✅ Post-cleanup stats: 4.1GB used (was 8.1GB), 7.6GB available, ~17% CPU, 23 containers (was 51)

### Phase 1.5: WordPress Image Transfer — DONE (March 13, 2026)
6. ✅ Transferred uploads/2026/02/ (18.4MB) — vehicle images, site icons, logos
7. ✅ Transferred uploads/2026/03/ (3MB) — slider images (cargo-ship, trucks, tires, etc.)
8. ✅ Transferred docs/Images/ (5.88MB) — Facebook photos (operations gallery + founder MVK)
9. ✅ Cleaned up tmp files on VPS
10. ✅ Audited container for unnecessary files — CLEAN (no dev docs, no .env, no .sql, no .bak)
11. ✅ Deleted old backup theme (globalconnect-child.bak), twentytwentyfour, twentytwentythree (saved 14MB)
12. ✅ Vehicle/shop images now loading on live site
13. ⚠️ Operations gallery + founder photo — transferred but NOT YET VERIFIED on live
14. ❌ Logo still showing Divi "D" — divi_logo option is NOT SET

### Remaining — Next Session

#### Priority 1: Quick Fixes
- [ ] **Fix logo**: wp-admin → Divi → Theme Options → Logo → set to globalconnect-logo-header-2x.png (already in media library)
- [ ] **Verify images**: Hard refresh globalcnx.net — check operations gallery + founder photo load
- [ ] **Delete Supabase Instance #2 permanently**: Coolify → supabase-i4wg... → Danger Zone → Delete

#### Priority 2: WordPress Optimization
- [ ] **Add 4GB swap** to VPS:
  ```bash
  fallocate -l 4G /swapfile
  chmod 600 /swapfile
  mkswap /swapfile
  swapon /swapfile
  echo '/swapfile none swap sw 0 0' >> /etc/fstab
  ```
- [ ] **Increase PHP memory** to 512M in WordPress container
- [ ] **Disable WP-Cron**, set up system cron (every 15 min)
- [ ] **Install WP-CLI** in WordPress container
- [ ] **Diagnose slowness** — both local and live are slow, likely Divi/theme issue

#### Priority 3: Evaluate & Plan
- [ ] Re-run `docker stats --no-stream` to confirm stable resource usage
- [ ] Decide: stay on $7/mo or upgrade to $15/mo
- [ ] Plan shared MariaDB + Redis for future WordPress site migrations from Hostinger
- [ ] Consider merging KmedTour into Supabase Instance #1 (use schemas) to save ~2GB RAM

## Local Docker Desktop Audit (March 13, 2026)

**Total: 557% CPU, 3.38GB / 6.54GB RAM — LOCAL MACHINE IS ALSO OVERLOADED**

| Container | CPU | RAM | Status | Notes |
|-----------|-----|-----|--------|-------|
| openclaw-sbx-a | 0% | 0 | Stopped | Can delete |
| brave_pasteur | 0% | 0 | Stopped | hello-world test, can delete |
| video-automatio | 0.04% | 59MB | Running | Video automation |
| services | 0.28% | 257MB | Running | Unknown services stack |
| copiedfromothe | 0.23% | 344MB | Running | Unknown |
| **vo-onelink-goo** | **238%** | **1.16GB** | **Unhealthy** | vo-onelink-google project — KILLING LOCAL CPU |
| sk-autosphere-c | 0% | 0 | Stopped | sk-autosphere project |
| seo-agents | 2.05% | 201MB | Running | SEO agents |
| **socialmediaaut** | **81%** | 308MB | Running | Social media automation |
| **web-app** | **234%** | **1.08GB** | **Unhealthy** | WonLink AI (connects to VPS Supabase Instance #1) |

### Immediate Local Cleanup Recommendations
1. Stop **web-app** (234% CPU, unhealthy) — it connects to VPS Supabase, not needed locally
2. Stop **vo-onelink-goo** (238% CPU, unhealthy) — uses cloud Supabase anyway
3. Delete **openclaw-sbx-a** and **brave_pasteur** (stopped, unused)
4. Review **socialmediaaut** (81% CPU) — is it needed running constantly?
5. These 3 stops alone would save ~553% CPU and ~2.5GB RAM on your local machine

## Contabo Plan Comparison

| Spec | Current ($7/mo) | Upgrade ($15/mo) |
|------|-----------------|------------------|
| CPU | 6 cores | 8 cores |
| RAM | 12 GB | 24 GB |
| Disk | 200 GB SSD | 200 GB NVMe |
| Port | 300 Mbit/s | 600 Mbit/s |
| Snapshots | 2 | 3 |

### After Supabase cleanup, estimated resource usage on current plan:
| Service | RAM | CPU |
|---------|-----|-----|
| Coolify | ~570MB | ~4% |
| WordPress (GlobalConnect) | ~360MB | ~40% (after stabilization) |
| n8n + PostgreSQL | ~326MB | ~4% |
| 1 Supabase instance | ~2.0GB | ~40% |
| **TOTAL** | **~3.3GB** | **~88%** |
| **Available** | **~8.7GB free** | Comfortable |

Current plan should be sufficient after cleanup. Upgrade recommended only when adding multiple WordPress sites from Hostinger.
