<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: index.html");
  exit;
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Terra Project 5v5 – Profil joueur</title>
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css" />
</head>
<body>

<header class="navbar">
  <div class="header-inner">
    <a href="index.html" class="brand">
      <img src="assets/TERRA_TACTICS.png" alt="Logo Terra Project" class="brand-logo">
      <div class="brand-text">
        <span class="brand-name">TERRA</span>
        <span class="brand-sub">TACTICS</span>
      </div>
    </a>

    <nav class="nav">
      <a href="index.html">Accueil</a>
      <a href="actualites.html">Actualités</a>
      <a href="le-jeu.html">Le jeu</a>
      <a href="faq.html">FAQ</a>
      <a href="profil.html">Profil</a>
    </nav>

    <div class="auth-actions">
      <button class="btn btn-ghost-logout" >Se connecter</button>
      <a class="btn btn-primary" href="#">Télécharger</a>
    </div>
  </div>
</header>

<main class="profile-container fade-in">
  <h1 class="profile-title">Profil du joueur</h1>

  <!-- Avatar + pseudo -->
  <section class="profile-header">
    <div class="avatar-wrapper">
      <img id="avatar-display" src="assets/avatars/default.png" alt="Avatar du joueur">
      <button class="btn btn-primary" id="change-avatar">Changer d'avatar</button>
    </div>

    <div class="profile-info">
      <div>
        <label for="pseudo-input">Pseudo</label>
        <input type="text" id="pseudo-input" placeholder="Ton pseudo">
      </div>

      <div>
        <label for="rank-select">Rang</label>
        <select id="rank-select">
          <option>Bronze</option>
          <option>Argent</option>
          <option>Or</option>
          <option>Platine</option>
          <option>Diamant</option>
          <option>Maître</option>
          <option>Challenger</option>
        </select>
      </div>
    </div>
  </section>

  <!-- Statistiques -->
  <section class="stats-section">
    <h2>Statistiques</h2>

    <div class="stats-grid">
      <div class="stat-card">
        <h3>K/D</h3>
        <input type="number" step="0.01" id="kd-input" placeholder="1.25">
      </div>

      <div class="stat-card">
        <h3>Winrate (%)</h3>
        <input type="number" id="winrate-input" placeholder="54">
      </div>

      <div class="stat-card">
        <h3>Parties jouées</h3>
        <input type="number" id="games-input" placeholder="120">
      </div>

      <div class="stat-card">
        <h3>Niveau</h3>
        <input type="number" id="level-input" placeholder="32">
      </div>
    </div>
  </section>

  <!-- Sauvegarde -->
  <button class="btn btn-primary save-btn" id="save-profile">Enregistrer le profil</button>
</main>

<footer>
  <div class="inner">
    <small>© Terra Project Studios — 2025</small>
    <small><a href="#" style="color:var(--muted);text-decoration:none">Mentions légales</a></small>
  </div>
</footer>

<!-- Fenêtre de connexion (reuse de tes autres pages) -->
<div class="auth-modal" id="login-modal" aria-hidden="true">
  <div class="auth-modal-backdrop"></div>
  <div class="auth-modal-dialog" role="dialog" aria-modal="true" aria-labelledby="login-title">
    <h2 id="login-title">Connexion au compte</h2>
    <p class="auth-modal-subtitle">Connecte-toi à ton compte Terra Project 5v5.</p>

    <form class="auth-form" id="login-form">
      <div class="form-group">
        <label>Adresse e-mail</label>
        <input type="email" name="email" required placeholder="toi@exemple.com">
      </div>

      <div class="form-group">
        <label>Mot de passe</label>
        <input type="password" name="password" required placeholder="••••••••">
      </div>

      <p class="form-error" id="login-error"></p>

      <button type="submit" class="btn btn-primary auth-submit">Se connecter</button>

      <p class="auth-switch">
        Pas de compte ? <a href="#" id="open-register">Créer un compte</a>
      </p>
    </form>

    <button class="auth-close" type="button" aria-label="Fermer la fenêtre de connexion">×</button>
  </div>
</div>

<!-- Fenêtre de création de compte -->
<div class="auth-modal" id="register-modal" aria-hidden="true">
  <div class="auth-modal-backdrop"></div>
  <div class="auth-modal-dialog" role="dialog" aria-modal="true" aria-labelledby="register-title">
    <h2 id="register-title">Créer un compte</h2>
    <p class="auth-modal-subtitle">Rejoins Terra Project 5v5 en quelques secondes.</p>

    <form class="auth-form" id="register-form">
      <div class="form-group">
        <label>Adresse e-mail</label>
        <input type="email" name="email" required placeholder="toi@exemple.com">
      </div>

      <div class="form-group">
        <label>Mot de passe</label>
        <input type="password" name="password" required placeholder="••••••••">
      </div>

      <div class="form-group">
        <label>Confirmer le mot de passe</label>
        <input type="password" name="confirm" required placeholder="••••••••">
      </div>

      <p class="form-error" id="register-error"></p>

      <button type="submit" class="btn btn-primary auth-submit">Créer mon compte</button>

      <p class="auth-switch">
        Déjà un compte ? <a href="#" id="open-login">Se connecter</a>
      </p>
    </form>

    <button class="auth-close" type="button" aria-label="Fermer la fenêtre de création de compte">×</button>
  </div>
</div>

<!-- Fenêtre de choix d'avatar "à la Blizzard" -->
<div class="avatar-modal" id="avatar-modal">
  <div class="avatar-backdrop"></div>
  <div class="avatar-dialog">
    <div class="avatar-dialog-header">
      <h2>Choisir un avatar</h2>
      <button class="auth-close" id="close-avatar" aria-label="Fermer la fenêtre de choix d'avatar">×</button>
    </div>
    <p class="avatar-dialog-subtitle">Sélectionne une image de profil parmi les avatars de base.</p>

    <div class="avatar-grid">
      <img class="avatar-option" src="assets/avatars/default.png" alt="Avatar par défaut">
      <img class="avatar-option" src="assets/avatars/a1.png" alt="Avatar 1">
      <img class="avatar-option" src="assets/avatars/a2.png" alt="Avatar 2">
      <img class="avatar-option" src="assets/avatars/a3.png" alt="Avatar 3">
      <img class="avatar-option" src="assets/avatars/a4.png" alt="Avatar 4">
      <img class="avatar-option" src="assets/avatars/a5.png" alt="Avatar 5">
    </div>
  </div>
</div>
<!-- Couche de verrouillage du profil (flou + carte) -->
<div class="profile-lock-overlay" id="profile-lock">
  <div class="profile-lock-card">
    <h2>Profil verrouillé</h2>
    <p>Connecte-toi pour accéder à ton profil joueur.</p>
    <button class="btn btn-primary" id="profile-lock-login">Se connecter</button>
    <button class="btn btn-ghost" id="profile-lock-back">Retour</button>
  </div>
</div>

<script src="script.js"></script>
<script src="profil.js"></script>
</body>
</html>
