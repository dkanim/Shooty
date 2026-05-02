<?php
require_once __DIR__ . '/../config.php';
if (session_status() === PHP_SESSION_NONE) session_start();

// Seul un client connecté peut modérer
if (empty($_SESSION[CLIENT_SESSION_NAME])) {
    jsonResponse(['success' => false, 'message' => 'Non autorisé.'], 401);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(['success' => false, 'message' => 'Méthode non autorisée.'], 405);
}

$client  = $_SESSION[CLIENT_SESSION_NAME];
$photoId = (int)($_POST['photo_id'] ?? 0);
$action  = $_POST['action'] ?? ''; // approve | refuse

if (!$photoId || !in_array($action, ['approve', 'refuse'], true)) {
    jsonResponse(['success' => false, 'message' => 'Paramètres invalides.'], 400);
}

$db = getDB();

// Vérifier que la photo appartient bien à un événement du client
$photo = $db->prepare('
    SELECT p.id, p.filename, p.event_id
    FROM photos p
    JOIN events e ON p.event_id = e.id
    WHERE p.id = ? AND e.client_id = ?
');
$photo->execute([$photoId, $client['id']]);
$photo = $photo->fetch();

if (!$photo) jsonResponse(['success' => false, 'message' => 'Photo introuvable.'], 404);

if ($action === 'approve') {
    $db->prepare("UPDATE photos SET statut='approuvee' WHERE id=?")->execute([$photoId]);
    jsonResponse(['success' => true, 'statut' => 'approuvee']);
}

if ($action === 'refuse') {
    // Supprimer le fichier physique
    $path = UPLOAD_DIR . $photo['filename'];
    if (file_exists($path)) unlink($path);
    $db->prepare("UPDATE photos SET statut='refusee' WHERE id=?")->execute([$photoId]);
    jsonResponse(['success' => true, 'statut' => 'refusee']);
}
