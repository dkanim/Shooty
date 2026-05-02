<?php
require_once __DIR__ . '/../config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(['success' => false, 'message' => 'Méthode non autorisée.'], 405);
}

$eventId = (int)($_POST['event_id'] ?? 0);
if (!$eventId) jsonResponse(['success' => false, 'message' => 'Événement manquant.'], 400);

$db = getDB();

// Vérifier que l'événement existe et est actif
$event = $db->prepare('SELECT id, moderation FROM events WHERE id = ? AND actif = 1');
$event->execute([$eventId]);
$event = $event->fetch();
if (!$event) jsonResponse(['success' => false, 'message' => 'Événement introuvable ou inactif.'], 404);

// Vérifier le fichier
$file = $_FILES['photo'] ?? null;
if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
    jsonResponse(['success' => false, 'message' => 'Aucun fichier reçu.'], 400);
}

if ($file['size'] > MAX_FILE_SIZE) {
    jsonResponse(['success' => false, 'message' => 'Fichier trop lourd (max 10 Mo).'], 400);
}

// Vérifier le type MIME réel
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime  = $finfo->file($file['tmp_name']);
if (!in_array($mime, ALLOWED_TYPES, true)) {
    jsonResponse(['success' => false, 'message' => 'Format non autorisé (JPEG, PNG, WebP, GIF uniquement).'], 400);
}

// Dossier de destination
$dir = UPLOAD_DIR . $eventId . '/';
if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
}

// Nom de fichier unique
$ext      = pathinfo($file['name'], PATHINFO_EXTENSION) ?: 'jpg';
$ext      = strtolower($ext);
$basename = $eventId . '_' . uniqid('', true) . '.' . $ext;
$dest     = $dir . $basename;
$relative = $eventId . '/' . $basename;

// Déplacer et redimensionner
if (!move_uploaded_file($file['tmp_name'], $dest)) {
    jsonResponse(['success' => false, 'message' => 'Erreur lors de la sauvegarde.'], 500);
}

// Redimensionner (écrase le fichier original)
if (function_exists('imagecreatefromjpeg')) {
    resizeImage($dest, $dest);
}

// Statut selon modération
$statut = $event['moderation'] ? 'en_attente' : 'approuvee';

// Insérer en base
$db->prepare('INSERT INTO photos (event_id, filename, original_name, statut) VALUES (?,?,?,?)')
   ->execute([$eventId, $relative, basename($file['name']), $statut]);

jsonResponse([
    'success' => true,
    'message' => 'Photo envoyée avec succès.',
    'statut'  => $statut,
    'file'    => $relative,
]);
