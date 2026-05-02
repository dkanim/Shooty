<?php
require_once __DIR__ . '/../config.php';

$eventId = (int)($_GET['event_id'] ?? 0);
$lastId  = (int)($_GET['last_id']  ?? 0);

if (!$eventId) jsonResponse(['success' => false, 'photos' => []]);

$db = getDB();

// Vérifier que l'événement existe
$event = $db->prepare('SELECT id FROM events WHERE id = ? AND actif = 1');
$event->execute([$eventId]);
if (!$event->fetch()) jsonResponse(['success' => false, 'photos' => []]);

// Nouvelles photos approuvées depuis last_id
$stmt = $db->prepare("
    SELECT id, filename
    FROM photos
    WHERE event_id = ?
      AND statut = 'approuvee'
      AND id > ?
    ORDER BY id ASC
    LIMIT 50
");
$stmt->execute([$eventId, $lastId]);
$photos = $stmt->fetchAll();

jsonResponse(['success' => true, 'photos' => $photos]);
