<?php
require_once __DIR__ . '/../config.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if (!empty($_SESSION[ADMIN_SESSION_NAME])) {
    header('Location: dashboard.php'); exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = getDB()->prepare('SELECT id, username, password_hash FROM admins WHERE username = ?');
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password_hash'])) {
        $_SESSION[ADMIN_SESSION_NAME] = ['id' => $admin['id'], 'username' => $admin['username']];
        header('Location: dashboard.php'); exit;
    }
    $error = 'Identifiants incorrects.';
}
?><!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin — <?= SITE_NAME ?></title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="auth-page">
  <div class="auth-box">
    <div class="auth-logo">
      <h1>Photo<span>Booth</span></h1>
      <p>Panneau d'administration</p>
    </div>
    <?php if ($error): ?>
      <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="post">
      <div class="form-group">
        <label class="form-label">Identifiant</label>
        <input class="form-control" type="text" name="username" autocomplete="username" required>
      </div>
      <div class="form-group">
        <label class="form-label">Mot de passe</label>
        <input class="form-control" type="password" name="password" autocomplete="current-password" required>
      </div>
      <button class="btn btn-primary btn-block mt-2" type="submit">Connexion</button>
    </form>
  </div>
</div>
</body>
</html>
