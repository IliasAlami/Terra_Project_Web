<?php
session_start();
require_once 'pdo.php';

header('Content-Type: text/plain; charset=utf-8');

if (
    !isset($_POST['email'], $_POST['username'], $_POST['password'], $_POST['confirm'])
) {
    echo "error_fields";
    exit;
}

$email    = trim($_POST['email']);
$username = trim($_POST['username']);
$password = trim($_POST['password']);
$confirm  = trim($_POST['confirm']);

// Vérifs basiques
if ($email === '' || $username === '' || $password === '' || $confirm === '') {
    echo "error_fields";
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "error_email";
    exit;
}

if (strlen($username) < 3) {
    echo "error_username";
    exit;
}

if (strlen($password) < 8) {
    echo "error_password_length";
    exit;
}

if ($password !== $confirm) {
    echo "error_password_match";
    exit;
}

// Vérifier si email ou username déjà utilisés
$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
$stmt->execute([$email, $username]);
if ($stmt->fetch()) {
    echo "error_exists";
    exit;
}

// Insérer l'utilisateur
$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("
    INSERT INTO users (username, email, password_hash, created_at, updated_at)
    VALUES (?, ?, ?, NOW(), NOW())
");

$stmt->execute([$username, $email, $hash]);

echo "success";
exit;
