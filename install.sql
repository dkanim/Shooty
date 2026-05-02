<?php
// ============================================================
//  config.php  —  Configuration centrale PhotoBooth
// ============================================================

define('DB_HOST', 'localhost');
define('DB_NAME', 'photobooth');
define('DB_USER', 'root');          // ← changer
define('DB_PASS', '');              // ← changer
define('DB_CHARSET', 'utf8mb4');

define('UPLOAD_DIR', __DIR__ . '/uploads/');
define('UPLOAD_URL', '/photobooth/uploads/');
define('MAX_FILE_SIZE', 10 * 1024 * 1024); // 10 Mo
define('ALLOWED_TYPES', ['image/jpeg', 'image/png', 'image/webp', 'image/gif']);
define('THUMB_SIZE', 800); // px max largeur/hauteur

define('SITE_URL', 'http://localhost/photobooth');
define('SITE_NAME', 'PhotoBooth');
define('POLL_INTERVAL', 3000); // ms entre chaque refresh projecteur

define('ADMIN_SESSION_NAME', 'pb_admin');
define('CLIENT_SESSION_NAME', 'pb_client');

// ── Connexion PDO ─────────────────────────────────────────
function getDB(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', DB_HOST, DB_NAME, DB_CHARSET);
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
    }
    return $pdo;
}

// ── Helpers session ───────────────────────────────────────
function adminGuard(): void {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (empty($_SESSION[ADMIN_SESSION_NAME])) {
        header('Location: ' . SITE_URL . '/admin/index.php');
        exit;
    }
}

function clientGuard(): void {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (empty($_SESSION[CLIENT_SESSION_NAME])) {
        header('Location: ' . SITE_URL . '/client/login.php');
        exit;
    }
}

function jsonResponse(array $data, int $code = 200): void {
    http_response_code($code);
    header('Content-Type: application/json');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

function generateCode(int $length = 6): string {
    $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= $chars[random_int(0, strlen($chars) - 1)];
    }
    return $code;
}

function resizeImage(string $src, string $dest, int $maxSize = THUMB_SIZE): bool {
    [$w, $h, $type] = getimagesize($src);
    $ratio = min($maxSize / $w, $maxSize / $h, 1);
    $nw = (int)($w * $ratio);
    $nh = (int)($h * $ratio);

    $canvas = imagecreatetruecolor($nw, $nh);

    $img = match($type) {
        IMAGETYPE_JPEG => imagecreatefromjpeg($src),
        IMAGETYPE_PNG  => imagecreatefrompng($src),
        IMAGETYPE_WEBP => imagecreatefromwebp($src),
        IMAGETYPE_GIF  => imagecreatefromgif($src),
        default        => false,
    };
    if (!$img) return false;

    // Transparence PNG/WebP
    imagealphablending($canvas, false);
    imagesavealpha($canvas, true);

    imagecopyresampled($canvas, $img, 0, 0, 0, 0, $nw, $nh, $w, $h);

    $result = match($type) {
        IMAGETYPE_JPEG => imagejpeg($canvas, $dest, 88),
        IMAGETYPE_PNG  => imagepng($canvas, $dest, 6),
        IMAGETYPE_WEBP => imagewebp($canvas, $dest, 88),
        IMAGETYPE_GIF  => imagegif($canvas, $dest),
        default        => false,
    };
    imagedestroy($canvas);
    imagedestroy($img);
    return (bool)$result;
}
