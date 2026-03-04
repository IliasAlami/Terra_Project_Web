<?php
session_start();
require_once "pdo.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  header("Location: connexion.php");
  exit;
}

$login = trim($_POST["login"] ?? "");
$password = $_POST["password"] ?? "";

if ($login === "" || $password === "") {
  header("Location: connexion.php?err=1");
  exit;
}

// Cherche par username OU email
$sql = "SELECT id, username, email, password_hash
        FROM users
        WHERE username = :login OR email = :login
        LIMIT 1";

$stmt = $pdo->prepare($sql);
$stmt->execute([":login" => $login]);
$user = $stmt->fetch();

if (!$user || !password_verify($password, $user["password_hash"])) {
  header("Location: connexion.php?err=1");
  exit;
}

// Connexion OK
session_regenerate_id(true);
$_SESSION["user_id"] = (int)$user["id"];
$_SESSION["username"] = $user["username"];
$_SESSION["email"] = $user["email"];

header("Location: profil.php");
exit;