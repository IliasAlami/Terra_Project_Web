<?php
session_start();
require 'pdo.php';

// sécurité simple
if (empty($_SESSION["user_id"])) {
    die("Accès refusé");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titre = trim($_POST["titre"]);
    $contenu = trim($_POST["contenu"]);
    $categorie = $_POST["categorie"];

    if (!empty($titre) && !empty($contenu)) {

        $stmt = $pdo->prepare("INSERT INTO news (titre, contenu, categorie, auteur) VALUES (?, ?, ?, ?)");
        $stmt->execute([$titre, $contenu, $categorie, "Admin"]);

        echo "<p style='color:green'>News publiée !</p>";
    } else {
        echo "<p style='color:red'>Champs manquants</p>";
    }
}
?>

<h2>Créer une patch note</h2>

<form method="POST">
    <input type="text" name="titre" placeholder="Titre" required><br><br>

    <textarea name="contenu" placeholder="Contenu" required></textarea><br><br>

    <select name="categorie">
        <option value="patch">Patch Notes</option>
        <option value="event">Événement</option>
        <option value="agent">Agent</option>
        <option value="meta">Méta</option>
    </select><br><br>

    <button type="submit">Publier</button>
</form>