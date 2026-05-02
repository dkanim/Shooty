/* ============================================================
   style.css  —  Design système PhotoBooth
   Thème : sombre / élégant / événementiel
============================================================ */

@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap');

/* ── Variables ─────────────────────────────────────────── */
:root {
  --bg:        #0d0f14;
  --bg2:       #161920;
  --bg3:       #1e2130;
  --border:    #2a2f42;
  --border2:   #363d55;
  --accent:    #7c6aff;
  --accent2:   #a593ff;
  --green:     #34d399;
  --red:       #f87171;
  --amber:     #fbbf24;
  --text:      #e8eaf0;
  --text2:     #9ba3c0;
  --text3:     #5c6480;
  --radius:    10px;
  --radius-lg: 16px;
  --shadow:    0 4px 24px rgba(0,0,0,.4);
  --font:      'Outfit', sans-serif;
  --mono:      'DM Mono', monospace;
  --transition: .18s ease;
}

/* ── Reset ──────────────────────────────────────────────── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { font-size: 16px; -webkit-tap-highlight-color: transparent; }
body {
  font-family: var(--font);
  background: var(--bg);
  color: var(--text);
  min-height: 100vh;
  line-height: 1.6;
}
a { color: var(--accent2); text-decoration: none; }
a:hover { color: var(--text); }
img { max-width: 100%; display: block; }

/* ── Scrollbar ──────────────────────────────────────────── */
::-webkit-scrollbar { width: 6px; }
::-webkit-scrollbar-track { background: var(--bg); }
::-webkit-scrollbar-thumb { background: var(--border2); border-radius: 3px; }

/* ── Layout ─────────────────────────────────────────────── */
.container { max-width: 960px; margin: 0 auto; padding: 0 20px; }
.container-sm { max-width: 520px; margin: 0 auto; padding: 0 20px; }

/* ── Topbar ─────────────────────────────────────────────── */
.topbar {
  background: var(--bg2);
  border-bottom: 1px solid var(--border);
  padding: 0 28px;
  height: 60px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  position: sticky;
  top: 0;
  z-index: 100;
}
.topbar-brand {
  font-size: 18px;
  font-weight: 700;
  letter-spacing: -.5px;
  color: var(--text);
  display: flex;
  align-items: center;
  gap: 8px;
}
.topbar-brand span { color: var(--accent); }
.topbar-nav { display: flex; align-items: center; gap: 6px; }
.topbar-user { color: var(--text2); font-size: 14px; margin-right: 10px; }

/* ── Cards ──────────────────────────────────────────────── */
.card {
  background: var(--bg2);
  border: 1px solid var(--border);
  border-radius: var(--radius-lg);
  padding: 28px;
}
.card-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 24px;
  padding-bottom: 18px;
  border-bottom: 1px solid var(--border);
}
.card-title { font-size: 17px; font-weight: 600; }

/* ── Page hero (login) ──────────────────────────────────── */
.auth-page {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 24px;
  background: var(--bg);
}
.auth-box {
  width: 100%;
  max-width: 420px;
  background: var(--bg2);
  border: 1px solid var(--border);
  border-radius: var(--radius-lg);
  padding: 40px;
}
.auth-logo {
  text-align: center;
  margin-bottom: 32px;
}
.auth-logo h1 {
  font-size: 28px;
  font-weight: 700;
  letter-spacing: -1px;
}
.auth-logo h1 span { color: var(--accent); }
.auth-logo p { color: var(--text2); font-size: 14px; margin-top: 4px; }

/* ── Formulaires ────────────────────────────────────────── */
.form-group { margin-bottom: 18px; }
.form-label {
  display: block;
  font-size: 13px;
  font-weight: 500;
  color: var(--text2);
  margin-bottom: 6px;
  text-transform: uppercase;
  letter-spacing: .5px;
}
.form-control {
  width: 100%;
  padding: 11px 14px;
  background: var(--bg3);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  color: var(--text);
  font-family: var(--font);
  font-size: 15px;
  transition: border-color var(--transition), box-shadow var(--transition);
  outline: none;
}
.form-control:focus {
  border-color: var(--accent);
  box-shadow: 0 0 0 3px rgba(124,106,255,.15);
}
.form-control::placeholder { color: var(--text3); }
.form-hint { font-size: 12px; color: var(--text3); margin-top: 5px; }

select.form-control { cursor: pointer; }

/* ── Boutons ────────────────────────────────────────────── */
.btn {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 10px 20px;
  border-radius: var(--radius);
  font-family: var(--font);
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  border: none;
  transition: opacity var(--transition), transform var(--transition);
  white-space: nowrap;
}
.btn:hover { opacity: .85; }
.btn:active { transform: scale(.97); }
.btn-primary { background: var(--accent); color: #fff; }
.btn-success { background: var(--green); color: #0d0f14; }
.btn-danger  { background: var(--red);   color: #fff; }
.btn-ghost   { background: var(--bg3); color: var(--text); border: 1px solid var(--border); }
.btn-sm      { padding: 6px 12px; font-size: 13px; }
.btn-block   { width: 100%; justify-content: center; padding: 13px; font-size: 15px; }
.btn:disabled { opacity: .45; cursor: not-allowed; }

/* ── Badges ─────────────────────────────────────────────── */
.badge {
  display: inline-block;
  padding: 3px 10px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 500;
}
.badge-green  { background: rgba(52,211,153,.15); color: var(--green); }
.badge-red    { background: rgba(248,113,113,.15); color: var(--red); }
.badge-amber  { background: rgba(251,191,36,.15);  color: var(--amber); }
.badge-purple { background: rgba(124,106,255,.15); color: var(--accent2); }

/* ── Alertes ────────────────────────────────────────────── */
.alert {
  padding: 12px 16px;
  border-radius: var(--radius);
  font-size: 14px;
  margin-bottom: 18px;
}
.alert-error   { background: rgba(248,113,113,.12); border: 1px solid rgba(248,113,113,.3); color: var(--red); }
.alert-success { background: rgba(52,211,153,.12);  border: 1px solid rgba(52,211,153,.3);  color: var(--green); }
.alert-info    { background: rgba(124,106,255,.12); border: 1px solid rgba(124,106,255,.3); color: var(--accent2); }

/* ── Tables ─────────────────────────────────────────────── */
.table-wrap { overflow-x: auto; }
table { width: 100%; border-collapse: collapse; font-size: 14px; }
thead th {
  padding: 10px 14px;
  text-align: left;
  color: var(--text3);
  font-weight: 500;
  font-size: 12px;
  text-transform: uppercase;
  letter-spacing: .5px;
  border-bottom: 1px solid var(--border);
}
tbody tr { border-bottom: 1px solid var(--border); }
tbody tr:last-child { border: none; }
tbody tr:hover { background: rgba(255,255,255,.02); }
tbody td { padding: 13px 14px; color: var(--text); }

/* ── Code ───────────────────────────────────────────────── */
.code-block {
  background: var(--bg3);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  padding: 12px 16px;
  font-family: var(--mono);
  font-size: 20px;
  font-weight: 500;
  letter-spacing: 4px;
  color: var(--accent2);
  text-align: center;
  user-select: all;
}

/* ── Stats grid ─────────────────────────────────────────── */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
  gap: 16px;
  margin-bottom: 28px;
}
.stat-card {
  background: var(--bg3);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  padding: 20px;
}
.stat-card .stat-label { font-size: 12px; color: var(--text3); text-transform: uppercase; letter-spacing: .5px; }
.stat-card .stat-value { font-size: 30px; font-weight: 700; margin-top: 4px; }

/* ── Grid photos (modération) ───────────────────────────── */
.photos-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  gap: 16px;
}
.photo-card {
  background: var(--bg3);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  overflow: hidden;
  transition: border-color var(--transition);
}
.photo-card:hover { border-color: var(--border2); }
.photo-card img { width: 100%; height: 180px; object-fit: cover; display: block; }
.photo-card-actions {
  display: flex;
  gap: 8px;
  padding: 10px;
}
.photo-card-actions .btn { flex: 1; justify-content: center; }
.photo-card-meta { padding: 0 10px 4px; font-size: 11px; color: var(--text3); }

/* ── Page d'accueil invité ──────────────────────────────── */
.guest-page {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 24px;
  text-align: center;
  background: var(--bg);
}
.guest-logo { font-size: 52px; margin-bottom: 10px; }
.guest-title { font-size: 26px; font-weight: 700; margin-bottom: 6px; }
.guest-subtitle { color: var(--text2); margin-bottom: 32px; }

.code-input {
  font-family: var(--mono);
  font-size: 28px;
  letter-spacing: 8px;
  text-align: center;
  text-transform: uppercase;
  padding: 14px;
  width: 100%;
  max-width: 300px;
}

/* ── Upload zone ────────────────────────────────────────── */
.upload-zone {
  border: 2px dashed var(--border2);
  border-radius: var(--radius-lg);
  padding: 40px 20px;
  text-align: center;
  cursor: pointer;
  transition: border-color var(--transition), background var(--transition);
  position: relative;
}
.upload-zone:hover, .upload-zone.dragover {
  border-color: var(--accent);
  background: rgba(124,106,255,.05);
}
.upload-zone input[type=file] {
  position: absolute; inset: 0;
  opacity: 0; cursor: pointer; width: 100%; height: 100%;
}
.upload-icon { font-size: 40px; margin-bottom: 12px; }
.upload-text { color: var(--text2); font-size: 15px; }
.upload-hint { color: var(--text3); font-size: 13px; margin-top: 6px; }

.preview-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(90px, 1fr));
  gap: 8px;
  margin-top: 16px;
}
.preview-grid img {
  width: 100%; height: 90px;
  object-fit: cover;
  border-radius: 8px;
  border: 2px solid var(--border);
}

/* ── Projecteur (slideshow) ─────────────────────────────── */
.slideshow-page {
  background: #000;
  min-height: 100vh;
  overflow: hidden;
}
.slideshow-bg {
  position: fixed; inset: 0;
  background: #000;
}
.slide-img {
  position: fixed; inset: 0;
  display: flex; align-items: center; justify-content: center;
  opacity: 0;
  transition: opacity 1.2s ease;
}
.slide-img.active { opacity: 1; }
.slide-img img {
  max-width: 100vw; max-height: 100vh;
  object-fit: contain;
}
.slideshow-overlay {
  position: fixed;
  bottom: 0; left: 0; right: 0;
  padding: 20px 30px;
  background: linear-gradient(transparent, rgba(0,0,0,.7));
  display: flex;
  align-items: flex-end;
  justify-content: space-between;
  z-index: 10;
}
.slideshow-event-name {
  font-size: 18px;
  font-weight: 600;
  color: rgba(255,255,255,.9);
}
.slideshow-counter {
  font-family: var(--mono);
  font-size: 13px;
  color: rgba(255,255,255,.5);
}
.slideshow-new-badge {
  position: fixed;
  top: 20px; right: 20px;
  background: var(--accent);
  color: #fff;
  padding: 6px 14px;
  border-radius: 20px;
  font-size: 13px;
  font-weight: 600;
  opacity: 0;
  transition: opacity .4s;
  z-index: 20;
}
.slideshow-empty {
  position: fixed; inset: 0;
  display: flex; flex-direction: column;
  align-items: center; justify-content: center;
  color: rgba(255,255,255,.3);
  text-align: center;
}
.slideshow-empty .big { font-size: 64px; margin-bottom: 16px; opacity: .3; }
.slideshow-empty p { font-size: 18px; }

/* ── Page principale projecteur QR ─────────────────────── */
.qr-overlay {
  position: fixed;
  bottom: 24px; left: 24px;
  background: rgba(0,0,0,.7);
  border: 1px solid rgba(255,255,255,.1);
  border-radius: var(--radius-lg);
  padding: 16px;
  text-align: center;
  z-index: 10;
}
.qr-overlay img { width: 100px; height: 100px; border-radius: 8px; }
.qr-label { font-size: 11px; color: rgba(255,255,255,.5); margin-top: 6px; }
.qr-code-text {
  font-family: var(--mono);
  font-size: 18px;
  font-weight: 600;
  color: rgba(255,255,255,.9);
  letter-spacing: 3px;
  margin-top: 4px;
}

/* ── Responsive ─────────────────────────────────────────── */
@media (max-width: 600px) {
  .topbar { padding: 0 16px; }
  .card { padding: 20px; }
  .auth-box { padding: 28px 20px; }
  .photos-grid { grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); }
  .stats-grid { grid-template-columns: repeat(2, 1fr); }
  .code-input { font-size: 22px; letter-spacing: 6px; }
  .table-wrap thead { display: none; }
  .table-wrap td { display: block; padding: 6px 14px; }
  .table-wrap td::before {
    content: attr(data-label) ': ';
    color: var(--text3);
    font-size: 11px;
  }
}

/* ── Utilitaires ────────────────────────────────────────── */
.mt-1 { margin-top: 8px; }
.mt-2 { margin-top: 16px; }
.mt-3 { margin-top: 24px; }
.mb-1 { margin-bottom: 8px; }
.mb-2 { margin-bottom: 16px; }
.mb-3 { margin-bottom: 24px; }
.flex { display: flex; }
.flex-between { display: flex; justify-content: space-between; align-items: center; }
.flex-center  { display: flex; justify-content: center; align-items: center; }
.gap-2 { gap: 12px; }
.text-muted { color: var(--text2); }
.text-xs { font-size: 12px; }
.text-sm { font-size: 14px; }
.text-center { text-align: center; }
.w-full { width: 100%; }
.hidden { display: none; }
