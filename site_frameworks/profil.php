<?php
session_start();
if (empty($_SESSION["user_id"])) {
  header("Location: connexion.php");
  exit;
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Profil</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-950 text-white p-8">
  <div class="max-w-xl mx-auto rounded-2xl border border-white/10 bg-white/5 p-6">
    <h1 class="text-2xl font-bold">Bienvenue, <?= htmlspecialchars($_SESSION["username"]) ?></h1>
    <p class="mt-2 text-white/70"><?= htmlspecialchars($_SESSION["email"]) ?></p>
    <a class="inline-flex mt-6 px-4 py-2 rounded-xl bg-white/10 hover:bg-white/15 transition" href="logout.php">
      Se déconnecter
    </a>
  </div>
</body>
</html>