<?php
session_start();
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.html');
    exit;
}

$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

if ($email === '' || $password === '') {
    header('Location: login.html?error=empty');
    exit;
}

$login = $conn->real_escape_string($email);
$hash = md5($password);

$sql = "SELECT id, username, email FROM admin WHERE (username = '$login' OR email = '$login') AND password = '$hash' LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows === 1) {
    $user = $result->fetch_assoc();
    $_SESSION['admin_id'] = $user['id'];
    $_SESSION['admin_username'] = $user['username'];
    $_SESSION['admin_email'] = $user['email'];
    header('Location: admin_dashboard.php');
    exit;
}

header('Location: login.html?error=invalid');
exit;
