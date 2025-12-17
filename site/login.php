<?php
session_start();
require_once 'pdo.php';

$email = trim($_POST['email']);
$password = trim($_POST['password']);

$req = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$req->execute([$email]);
$user = $req->fetch(PDO::FETCH_ASSOC);

if (!$user || !password_verify($password, $user['password_hash'])) {
    echo "error";
    exit;
}

$_SESSION['user_id'] = $user['id'];
$_SESSION['email'] = $user['email'];

echo "success";
