# ============================================================
#  .htaccess  —  PhotoBooth
# ============================================================

Options -Indexes

# ── Bloquer l'accès direct aux uploads par type ────────────
<FilesMatch "\.(php|php3|php4|php5|phtml|pl|cgi|sh)$">
    Require all denied
</FilesMatch>

# ── Sécurité headers ───────────────────────────────────────
<IfModule mod_headers.c>
    Header always set X-Frame-Options "SAMEORIGIN"
    Header always set X-XSS-Protection "1; mode=block"
    Header always set X-Content-Type-Options "nosniff"
    Header always set Referrer-Policy "strict-origin-when-cross-origin"
</IfModule>

# ── Cache images ───────────────────────────────────────────
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType image/jpeg "access plus 1 hour"
    ExpiresByType image/png  "access plus 1 hour"
    ExpiresByType image/webp "access plus 1 hour"
</IfModule>

# ── Compression ────────────────────────────────────────────
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/html text/css application/javascript application/json
</IfModule>
